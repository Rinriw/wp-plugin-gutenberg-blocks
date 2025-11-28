# 🔧 Configuración .htaccess para Fichas Técnicas

## Problema Típico: Error 404

Cuando creas una Ficha Técnica y haces clic en "Ver", ves:
```
404 - Página no encontrada
```

Esto ocurre porque Apache no está reescribiendo correctamente las URLs amigables.

---

## ✅ SOLUCIÓN

### Archivo: `.htaccess` (en la raíz de WordPress)

**Ubicación**: `C:\xampp\htdocs\wordpress\.htaccess`

**Contenido a usar**:

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /wordpress/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /wordpress/index.php [L]
</IfModule>
# END WordPress
```

### ⚠️ IMPORTANTE: Ajusta la ruta

Si tu WordPress está en:
- **Local**: `http://localhost/wordpress/` → Usa `/wordpress/`
- **Raíz**: `http://localhost/` → Usa `/`
- **Subdirectorio**: `http://localhost/blog/` → Usa `/blog/`

Reemplaza `/wordpress/` en TODAS las líneas con tu ruta real.

---

## 📝 Pasos para Crear/Editar .htaccess

### Opción 1: Con Notepad (Windows)

1. Abre: **Notepad** (Bloc de notas)
2. Ve a: **File → Open**
3. Navega a: `C:\xampp\htdocs\wordpress\`
4. **Cambiar "Text Documents" a "All Files"** (importante!)
5. Si `.htaccess` existe, selecciónalo
6. Si no existe, abre un archivo vacío
7. Copia el contenido anterior
8. **Reemplaza `/wordpress/` con tu ruta**
9. **File → Save As**
10. Nombre: `.htaccess` (con el punto al inicio)
11. Formato: **All Files**
12. **Guardar**

### Opción 2: Con PowerShell (Windows)

```powershell
# Navega a la carpeta WordPress
cd C:\xampp\htdocs\wordpress

# Crea el archivo .htaccess
@'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /wordpress/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /wordpress/index.php [L]
</IfModule>
# END WordPress
'@ | Out-File -Encoding ASCII ".htaccess"

# Verifica que se creó
Get-Content .\.htaccess
```

### Opción 3: WordPress Admin

Si WordPress puede editar archivos:

1. **WordPress Admin → Apariencia → Editor de archivos** (si está habilitado)
2. Busca: `.htaccess`
3. Edita el contenido
4. Guarda

---

## 🔍 Verificar que Funciona

### Prueba 1: Crear Ficha y Ver

1. **Dashboard → Ficha Animación → Agregar Nueva**
2. Llena campos básicos
3. **Publicar**
4. Haz clic en **"Ver"**
5. ✅ Si ves la ficha formateada → **FUNCIONANDO**
6. ❌ Si ves 404 → Continúa con las pruebas

### Prueba 2: Revisar Logs de Apache

1. Abre: **C:\xampp\apache\logs\error.log**
2. Busca errores relacionados con `RewriteRule` o `mod_rewrite`

### Prueba 3: Verificar mod_rewrite

1. Abre: **C:\xampp\apache\conf\httpd.conf**
2. Busca: `LoadModule rewrite_module`
3. ✅ Si NO tiene `#` al inicio → Está habilitado
4. ❌ Si tiene `#` al inicio:
   - Quita el `#`
   - Guarda el archivo
   - Reinicia Apache en **XAMPP Control Panel**

---

## ❌ Si Nada Funciona

### Paso Adicional: Configuración WordPress

1. **WordPress Admin → Configuración → Enlaces permanentes**
2. Cambiar a: **"Nombre de la entrada"** (si no está)
3. **Guardar cambios** (esto fuerza el recálculo de rewrite rules)
4. Intenta acceder a la ficha nuevamente

### Paso Final: Desactivar Caché

Si tienes plugins de caché (WP Super Cache, W3 Total Cache, etc.):

1. **Plugins → Desactiva temporalmente el plugin de caché**
2. **Limpiar toda la caché del navegador** (Ctrl+Shift+Del)
3. Intenta acceder nuevamente

---

## 📋 Checklist Completo

- [ ] `.htaccess` existe en `C:\xampp\htdocs\wordpress\`
- [ ] Contiene `RewriteEngine On`
- [ ] RewriteBase es correcto (`/wordpress/`, `/`, etc.)
- [ ] Apache mod_rewrite está ✅ **HABILITADO** (sin `#` en httpd.conf)
- [ ] Apache se reinició después de cambiar httpd.conf
- [ ] WordPress permalinks están en **"Nombre de la entrada"**
- [ ] Guardé cambios de permalinks **DOS VECES**
- [ ] Plugin "ACF Blocks Starter" está ✅ **ACTIVO**
- [ ] Creé una ficha de prueba
- [ ] Puedo acceder a la ficha sin 404

---

## 🎓 Aprendizaje

Los pasos anteriores solucionan:

1. **URLs amigables** - Permiten `/ficha-animacion/nombre/` en lugar de `?p=123`
2. **Rewrite rules** - Apache reescribe las URLs a `index.php`
3. **Template loading** - WordPress carga `single-ficha_animacion.php`
4. **Contenido dinámico** - Se recuperan datos con `get_field()`

Sin esto, WordPress no puede encontrar el template y devuelve 404.

---

**Sigue estos pasos y tu Ficha Técnica funcionará correctamente.** ✅
