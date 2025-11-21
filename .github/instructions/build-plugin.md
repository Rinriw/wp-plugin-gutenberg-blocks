# Build y Distribución

## Generar Plugin Instalable

```bash
npm run build:plugin
```

### Proceso
1. Compila Tailwind CSS (`dist/blocks.css`)
2. Genera ZIP con nombre versionado
3. Excluye archivos de desarrollo

### Archivo Generado
```
acf-blocks-starter-v1.0.0.zip
```

## Contenido del ZIP
✅ **Incluido**:
- `plugin.php`
- `/blocks/` completo
- `/includes/` completo
- `/dist/` (CSS compilado)
- `/acf-json/`
- `.github/instructions/` (para referencia)
- `README.md`

❌ **Excluido**:
- `node_modules/`
- `src/`
- Archivos Node.js (`server.js`, `build-plugin.js`)
- Configs (`package.json`, `tailwind.config.js`, etc.)
- `.git/`

## Instalación en WordPress

### Opción 1: Admin WP
1. WordPress Admin → Plugins → Añadir nuevo
2. Subir archivo ZIP
3. Activar plugin

### Opción 2: Manual
```bash
# En servidor WordPress
cd wp-content/plugins/
unzip acf-blocks-starter-v1.0.0.zip
```

## Verificación Post-Instalación
- [ ] Plugin visible en lista
- [ ] ACF Pro activo
- [ ] Estilos cargan correctamente
- [ ] Bloques disponibles en editor
- [ ] JavaScript funciona (Gallery carousel)

## Actualizar Versión
1. Editar `package.json` → `version: "1.1.0"`
2. Editar `plugin.php` → `Version: 1.1.0`
3. Ejecutar `npm run build:plugin`
4. Genera `acf-blocks-starter-v1.1.0.zip`

## Distribución
El ZIP es instalable en cualquier WordPress con:
- WordPress 6.2+
- PHP 7.4+
- ACF Pro 6.6+
