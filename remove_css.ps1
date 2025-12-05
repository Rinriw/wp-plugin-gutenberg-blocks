$p = 'c:\xampp\htdocs\wordpress\wp-content\plugins\wp-plugin-gutenberg-blocks\ficha-styles.css';
$c = Get-Content -Path $p -Raw;

# Remove .plataforma-btn block in desktop media query
# We use (?s) for dotall mode to match across newlines
$c = $c -replace '(?s)\s*\.plataforma-btn\s*\{\s*width:\s*auto;\s*padding:\s*10px\s+15px\s+10px\s+45px;\s*font-size:\s*14px;\s*\}', '';

Set-Content -Path $p -Value $c;
Write-Host "CSS updated successfully";
