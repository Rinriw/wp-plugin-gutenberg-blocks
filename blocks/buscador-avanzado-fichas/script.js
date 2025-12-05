document.addEventListener('DOMContentLoaded', function () {
    const block = document.querySelector('.buscador-avanzado-block');
    if (!block) return;

    const searchInput = block.querySelector('#ficha-search-input');
    const searchBtn = block.querySelector('#ficha-search-btn');
    const filterFormat = block.querySelector('#filter-format');
    const filterTechnique = block.querySelector('#filter-technique');
    const filterYear = block.querySelector('#filter-year');
    const sortOrder = block.querySelector('#sort-order');
    const resetBtn = block.querySelector('#reset-filters');
    const resultsGrid = block.querySelector('#ficha-results-grid');
    const noResults = block.querySelector('#ficha-no-results');

    let debounceTimer;

    // Initial Load
    fetchResults();

    // Event Listeners
    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchResults, 500);
    });

    searchBtn.addEventListener('click', fetchResults);

    // Enter key on search input
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            fetchResults();
        }
    });

    filterFormat.addEventListener('change', fetchResults);
    filterTechnique.addEventListener('change', fetchResults);
    filterYear.addEventListener('change', fetchResults);
    sortOrder.addEventListener('change', fetchResults);

    resetBtn.addEventListener('click', () => {
        searchInput.value = '';
        filterFormat.value = '';
        filterTechnique.value = '';
        filterYear.value = '';
        sortOrder.value = 'title_asc';
        fetchResults();
    });

    function fetchResults() {
        // Show loading
        resultsGrid.innerHTML = '<div class="ficha-loading">Cargando...</div>';
        noResults.style.display = 'none';

        // Build URL
        const params = new URLSearchParams({
            s: searchInput.value,
            format: filterFormat.value,
            technique: filterTechnique.value,
            year: filterYear.value,
            orderby: sortOrder.value
        });

        const apiRoot = (typeof acf_blocks_data !== 'undefined' && acf_blocks_data.root)
            ? acf_blocks_data.root
            : '/wp-json/';

        fetch(`${apiRoot}acf-blocks/v1/search-fichas?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                renderResults(data);
            })
            .catch(error => {
                console.error('Error fetching fichas:', error);
                resultsGrid.innerHTML = '<div class="ficha-loading">Error al cargar resultados.</div>';
            });
    }

    function renderResults(data) {
        resultsGrid.innerHTML = '';

        if (!data || data.length === 0) {
            noResults.style.display = 'block';
            return;
        }

        data.forEach(item => {
            const card = document.createElement('a');
            card.href = item.link;
            card.className = 'ficha-card-result';

            const posterHtml = item.poster
                ? `<div class="ficha-card-poster"><img src="${item.poster}" alt="${item.title}"></div>`
                : `<div class="ficha-card-poster" style="display:flex;align-items:center;justify-content:center;color:#ccc;"><span>Sin imagen</span></div>`;

            const yearHtml = item.year ? `<span class="meta-year">${item.year}</span>` : '';
            const formatHtml = item.format ? `<span class="meta-format">• ${item.format}</span>` : '';
            const directorHtml = item.director ? `<div class="ficha-card-director">Dir: ${item.director}</div>` : '';

            card.innerHTML = `
                ${posterHtml}
                <div class="ficha-card-info">
                    <h3 class="ficha-card-title">${item.title}</h3>
                    <div class="ficha-card-meta">
                        ${yearHtml}
                        ${formatHtml}
                    </div>
                    ${directorHtml}
                </div>
            `;

            resultsGrid.appendChild(card);
        });
    }
});
