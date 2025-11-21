# Setup Inicial

## Requisitos Previos
- Node.js 18+ instalado
- WordPress 6.2+ local
- ACF Pro 6.6+ con licencia activa

## Instalación

```bash
# 1. Clonar repositorio
git clone https://github.com/sil7en/wp-plugin-gutenberg-blocks.git
cd wp-plugin-gutenberg-blocks

# 2. Instalar dependencias
npm install

# 3. Compilar CSS
npm run tailwind:build
```

## Opciones de Entorno

### Opción A: WordPress Local (Recomendado para Windows)

```bash
# 1. Copiar plugin a WordPress local
cp -r . /ruta/wordpress/wp-content/plugins/acf-blocks-starter

# 2. Watch mode para desarrollo
npm run tailwind:watch

# 3. Activar plugin en WordPress Admin
```

### Opción B: WordPress Playground (Linux/Mac)

⚠️ **Nota**: WordPress Playground tiene problemas en Windows. Usar Opción A en Windows.

```bash
# Editar server.js línea 26:
# Reemplazar YOUR_ACF_LICENSE_KEY con tu clave

npm run dev:playground
```

**Acceso**:
- Sitio: http://localhost:8888
- Admin: http://localhost:8888/wp-admin
- Usuario: admin | Contraseña: password

## Scripts Disponibles
- `npm run dev` - Tailwind watch (desarrollo local)
- `npm run dev:playground` - WordPress Playground + Tailwind (Linux/Mac)
- `npm run tailwind:build` - Compilar CSS producción
- `npm run build:plugin` - Generar ZIP instalable

## Verificación
✅ Plugin "ACF Blocks Starter" activado
✅ ACF Pro activo en WordPress
✅ Bloques visibles en editor (categoría "Bloques Personalizados")
✅ Archivo `dist/blocks.css` generado

## Troubleshooting

### Windows: Error WordPress Playground
```
Error: ENOENT: no such file or directory, open 'C:\C:\projects\...'
```
**Solución**: Usar Opción A (WordPress Local) en Windows.

### CSS no carga
Ejecutar `npm run tailwind:build` y verificar archivo `dist/blocks.css`.

### Puerto 8888 ocupado
Cambiar en `server.js` línea con `--port=8888`.
