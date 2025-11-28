/**
 * Ficha Técnica - Datos de Ejemplo
 * 
 * Este archivo contiene estructura de datos de ejemplo para poblamiento
 * de una Ficha Técnica completa con datos de ejemplo de una obra chilena
 */

// ========== EJEMPLO 1: "El Viaje de Chihiro" (Anime Classic) ==========
const ficha_ejemplo_1 = {
    // Tab 1: Mini Galería
    gallery: [
        {
            imagen: "URL_IMAGEN_1.jpg",
            descripcion: "Escena 1"
        },
        {
            imagen: "URL_IMAGEN_2.jpg",
            descripcion: "Escena 2"
        },
        {
            imagen: "URL_IMAGEN_3.jpg",
            descripcion: "Escena 3"
        },
        {
            imagen: "URL_IMAGEN_4.jpg",
            descripcion: "Escena 4"
        },
        {
            imagen: "URL_IMAGEN_5.jpg",
            descripcion: "Escena 5"
        }
    ],
    
    // Tab 2: Ficha Técnica
    afiche: "URL_AFICHE.jpg",
    nombre: "El Viaje de Chihiro",
    year: "2001",
    duration: "125 min",
    format: "Largometraje",
    format_custom: null,  // No es "otro"
    animation_technique: "Animación 2D Tradicional",
    animation_technique_custom: null,
    genre: "Fantasía, Aventura",
    idioma: "Japonés",
    pais: "Japón",
    sinopsis: "Chihiro es una niña de 10 años que se pierde en el mundo de los espíritus. Con la ayuda de Haku, debe encontrar la manera de regresar a casa mientras trabaja en una casa de baños para recuperar sus recuerdos y su nombre.",
    imdb_link: "https://www.imdb.com/title/tt0245429/",
    
    // Tab 3: Equipo y Reparto
    direccion: "Hayao Miyazaki",
    guion: "Hayao Miyazaki",
    productora: "Studio Ghibli",
    produccion: "Toshio Suzuki",
    animacion: "Masashi Ando, Yoji Takeshige",
    reparto: "Rumi Hiiragi (voz), Hiroki Narimiya (voz), Bunta Sugawara (voz)",
    fotografia: "Atsushi Okui",
    musica: "Joe Hisaishi",
    sonido: "Kazuhiro Iwagaki",
    direccion_arte: "Kazuo Ogawara",
    montaje: "Takeshi Seyama",
    edicion: "Takeshi Seyama",
    
    // Tab 4: Financiamiento y Premios
    financiamiento: "Financiado por Studio Ghibli con presupuesto de $15 millones USD. Producción colaborativa entre Japón y otros países.",
    premios: [
        {
            nombre: "Oso de Oro",
            festival: "Festival de Cine de Berlín",
            year: "2002"
        },
        {
            nombre: "Óscar a la Mejor Película Animada",
            festival: "Academia de Artes y Ciencias Cinematográficas",
            year: "2003"
        },
        {
            nombre: "Mejor Película Asiática",
            festival: "Festival de Cine de Estambul",
            year: "2002"
        }
    ],
    
    // Tab 5: Disponible en
    plataformas: [
        {
            servicio: "Netflix",
            link: "https://www.netflix.com/"
        },
        {
            servicio: "Prime Video",
            link: "https://www.primevideo.com/"
        },
        {
            servicio: "Disney+",
            link: "https://www.disneyplus.com/"
        }
    ]
};

// ========== EJEMPLO 2: Obra Chilena Ficticia (Con formato "otro") ==========
const ficha_ejemplo_2 = {
    // Tab 1: Mini Galería
    gallery: [
        { imagen: "URL_1.jpg" },
        { imagen: "URL_2.jpg" },
        { imagen: "URL_3.jpg" },
        { imagen: "URL_4.jpg" }
    ],
    
    // Tab 2: Ficha Técnica
    afiche: "URL_AFICHE_CHILENA.jpg",
    nombre: "Los Andes Despiertan",
    year: "2023",
    duration: "45 min",
    format: "otro",  // Formato custom
    format_custom: "Cortometraje + documental",  // Valor custom mostrado
    animation_technique: "otro",  // Técnica custom
    animation_technique_custom: "Stop-motion con materiales reciclados",  // Valor custom
    genre: "Documental, Experimental",
    idioma: "Español",
    pais: "Chile",
    sinopsis: "Un viaje visual por los Andes chilenos usando técnicas mixtas de animación y documentación real. Explora la biodiversidad y la cultura andina.",
    imdb_link: "https://www.imdb.com/",
    
    // Tab 3: Equipo y Reparto
    direccion: "María Gonzáles",
    guion: "Carlos Rodríguez",
    productora: "Estudio Creativo Chileno",
    produccion: "Francisca López",
    animacion: "Daniel Martínez",
    reparto: "Narración de Claudio Reyes",
    fotografia: "Roberto Silva",
    musica: "Pablo Urrutia",
    sonido: "Alejandra Fuentes",
    direccion_arte: "Isidora González",
    montaje: "Javier Cortés",
    edicion: "Ana Karina Soto",
    
    // Tab 4: Financiamiento y Premios
    financiamiento: "Financiado por CORFO y fondos locales de la región de Antofagasta. Colaboración con comunidades indígenas.",
    premios: [
        {
            nombre: "Mejor Cortometraje Nacional",
            festival: "Festival de Cine de Valdivia",
            year: "2023"
        },
        {
            nombre: "Mención Especial",
            festival: "DocPeru 2023",
            year: "2023"
        }
    ],
    
    // Tab 5: Disponible en
    plataformas: [
        {
            servicio: "YouTube",
            link: "https://www.youtube.com/"
        },
        {
            servicio: "Vimeo",
            link: "https://vimeo.com/"
        }
    ]
};

// ========== ESTRUCTURA VACÍA PARA LLENAR ==========
const ficha_template_vacia = {
    // Tab 1: Mini Galería
    gallery: [],
    
    // Tab 2: Ficha Técnica
    afiche: "",
    nombre: "",
    year: "",
    duration: "",
    format: "",
    format_custom: "",
    animation_technique: "",
    animation_technique_custom: "",
    genre: "",
    idioma: "",
    pais: "",
    sinopsis: "",
    imdb_link: "",
    
    // Tab 3: Equipo y Reparto
    direccion: "",
    guion: "",
    productora: "",
    produccion: "",
    animacion: "",
    reparto: "",
    fotografia: "",
    musica: "",
    sonido: "",
    direccion_arte: "",
    montaje: "",
    edicion: "",
    
    // Tab 4: Financiamiento y Premios
    financiamiento: "",
    premios: [],
    
    // Tab 5: Disponible en
    plataformas: []
};

// ========== INSTRUCCIONES PARA INGRESAR DATOS ==========
/*

PASO 1: CREAR LA FICHA EN WORDPRESS ADMIN
========================================
1. Ve a Dashboard → Ficha Animación → Agregar Nueva
2. Completa el formulario con los datos del ejemplo


PASO 2: ESTRUCTURA DE DATOS
===========================

CAMPOS REQUERIDOS:
- nombre (string)
- afiche (image URL)
- año (string/number)

CAMPOS OPCIONALES:
- gallery (array de objetos)
- format (string)
- animation_technique (string)
- Cualquier otro campo


CAMPOS CON VALORES ESPECIALES:
=============================

Format:
  - "Largometraje"
  - "Cortometraje"
  - "Serie"
  - "otro" → Entonces mostrar format_custom

Animation Technique:
  - "Animación 2D Tradicional"
  - "CGI / 3D"
  - "Stop-motion"
  - "Motion Graphics"
  - "otro" → Entonces mostrar animation_technique_custom

Plataformas (servicio select):
  - "Netflix"
  - "Disney+"
  - "Prime Video"
  - "YouTube"
  - "Vimeo"
  - Otros servicios...


PASO 3: VALIDACIÓN EN TEMPLATE
==============================
En single-ficha_animacion.php se valida:
- if (!empty($galeria)) → Mostrar galería
- if ($formato === 'otro') → Mostrar formato_custom
- if (!empty($premios)) → Mostrar sección premios


PASO 4: VERIFICAR EN FRONTEND
=============================
1. Dashboard → Ficha Animación → Editar la que creaste
2. Ver permalink (URL de la ficha)
3. Hacer click en "Ver" o ir a la URL
4. Verificar:
   - Responsive mobile/desktop
   - Acordeones funcionan
   - Gallery carousel navega
   - Tabs cambian contenido (desktop)

*/

// ========== VALORES COMUNES PARA SELECT FIELDS ==========
const valores_select = {
    formats: [
        "Largometraje",
        "Cortometraje",
        "Serie",
        "Miniserie",
        "Especial TV",
        "Videoclip",
        "otro"
    ],
    
    animation_techniques: [
        "Animación 2D Tradicional",
        "CGI / 3D",
        "Stop-motion",
        "Motion Graphics",
        "Rotoscopia",
        "Animación digital",
        "Mixta (2D + 3D)",
        "otro"
    ],
    
    idiomas: [
        "Español",
        "Inglés",
        "Portugués",
        "Francés",
        "Alemán",
        "Japonés",
        "Coreano",
        "Mandarín",
        "Otros"
    ],
    
    plataformas: [
        "Netflix",
        "Disney+",
        "Prime Video",
        "Apple TV+",
        "HBO Max",
        "Hulu",
        "YouTube",
        "Vimeo",
        "Mubi",
        "Otro"
    ]
};

// ========== NOTAS ==========
/*

TIPS DE USO:

1. Para galería: Mínimo 4 imágenes para que aparezcan dots de paginación
   → Si < 4 imágenes: se muestra todo sin navegación
   → Si >= 4 imágenes: muestra 4 a la vez + dots

2. Para premios: Cada premio es un objeto con nombre, festival, year
   → Dejar vacío si la obra no tiene premios
   → Template verifica if (!empty($premios)) antes de mostrar

3. Para plataformas: Cada plataforma es un objeto con servicio (select) y link (URL)
   → El link debe ser URL completa (https://...)
   → En desktop: botones apilados verticales
   → En mobile: botones apilados verticales

4. Campos condicionales (format_custom, animation_technique_custom):
   → Solo mostrar si format/animation_technique es "otro"
   → ACF Pro maneja esto automáticamente en el formulario
   → Template también valida: $formato_display = $formato === 'otro' ? $formato_custom : $formato;

5. Imágenes:
   → Afiche: Proporción 9:12 ideal (carátula de DVD)
   → Galería: Cualquier tamaño, se ajusta con object-fit: cover
   → WordPress lazy-loading aplica automáticamente

6. Sinopsis:
   → Máximo recomendado: 500-700 caracteres
   → Se permite HTML simple (p, br, strong, em)
   → Se sanitiza con wp_kses_post() en template

*/

export {
    ficha_ejemplo_1,
    ficha_ejemplo_2,
    ficha_template_vacia,
    valores_select
};
