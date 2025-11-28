# 🆘 REFERENCIA RÁPIDA - Solución de Problemas Comunes

## 🔴 Error: "Fichas no aparecen - 404 Not Found"

### ✅ Solución en 3 pasos

#### Paso 1: Resetear Permalinks (CRÍTICO)
```
1. WordPress Admin → Configuración → Enlaces permanentes
2. Click en "Guardar cambios"
3. Refresca la página de la ficha
```

#### Paso 2: Verificar .htaccess
```
Archivo: C:\xampp\htdocs\wordpress\.htaccess

Debe contener:
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

#### Paso 3: Verificar mod_rewrite en Apache
```
1. Abre: C:\xampp\apache\conf\httpd.conf
2. Busca: #LoadModule rewrite_module modules/mod_rewrite.so
3. Quita el # al inicio
4. Reinicia Apache
```

---

## 🔴 Error: "CPT Ficha Animación no aparece en Dashboard"

### ✅ Solución

```
1. ✅ Plugins → Activar "ACF Blocks Starter"
2. ✅ Plugins → Activar "Advanced Custom Fields Pro"
3. ✅ Settings → Permalinks → Guardar cambios
4. Refresca: F5
```

Si aún no aparece:
```
1. ACF → Field Groups → ¿Está "Ficha Técnica"?
   - Si está GRIS → Click en el nombre → Sincronizar
   - Si NO está → El plugin no se cargó correctamente
2. Desactiva TODOS los plugins excepto ACF Pro
3. Reactiva "ACF Blocks Starter"
```

---

## 🔴 Error: "Los estilos y JavaScript no funcionan"

### ✅ Solución

```
1. Limpia cache del navegador:
   - Ctrl + Shift + Suprime (Windows) o Cmd + Shift + Delete (Mac)
   
2. Refresca la página:
   - Ctrl + F5 (Windows) o Cmd + Shift + R (Mac)

3. Verifica en Developer Tools (F12):
   - Console: Busca errores rojos
   - Network: Verifica que ficha-styles.css y ficha-script.js cargan
```

Si aún no carga:
```
1. Crea una ficha nueva
2. Abre en navegador privado/incógnito
3. Desactiva plugins de caché (si existen)
```

---

## 🔴 Error: "Acordeones/Tabs no funcionan"

### ✅ Solución

```
1. F12 → Console
   - ¿Hay errores rojos? Nota el error
   
2. Verifica que ficha-script.js cargó:
   - F12 → Network → Busca "ficha-script.js"
   - Status debe ser 200, no 404

3. Si el script no carga:
   - Verifica que single-ficha_animacion.php tiene:
     wp_enqueue_script('ficha-tecnica', plugin_dir_url(__FILE__) . 'ficha-script.js', ...);
```

---

## 🔴 Error: "Galería no muestra imágenes"

### ✅ Solución

```
1. Verifica que subiste imágenes:
   - Dashboard → Ficha Animación → Tu ficha
   - Tab "Mini galería" → ¿Hay imágenes en el repeater?

2. Si el repeater está vacío:
   - Click en "Agregar fila"
   - Sube imagen en el sub-campo "imagen"
   - Guarda la ficha

3. Si aún no muestra:
   - F12 → Inspector → <img src="...">
   - ¿La URL es correcta?
   - ¿La imagen existe en wp-content/uploads/?
```

---

## 🔴 Error: "Los datos de los campos no se guardan"

### ✅ Solución

```
1. Verifica que ACF Pro está ACTIVO:
   - Plugins → "Advanced Custom Fields Pro" ✅

2. Verifica que el Field Group está activo:
   - ACF → Field Groups → "Ficha Técnica" debe estar visible

3. Verifica la sintaxis del campo:
   - ACF → Field Groups → "Ficha Técnica" → Editar
   - Cada campo debe tener "Field Name" (ej: "nombre", "sinopsis")
   - Estos nombres se usan en get_field() del template

4. Si los campos están grises:
   - Click en el grupo
   - Busca "Sincronizar" (botón superior derecho)
   - Click en Sincronizar
```

---

## 🔴 Error: "Campos personalizados no aparecen (formato 'otro')"

### ✅ Solución

```
El problema: Campos condicionales que muestran/ocultan según selección

Verificar:
1. Selecciona "Otro" en "Formato"
   - ¿Aparece campo "Formato Custom"?
   
2. Si NO aparece:
   - ACF → Field Groups → "Ficha Técnica" → Editar
   - Busca el campo "format_custom"
   - Verifica que tiene "Conditional Logic":
     - Show if: field "format" = "otro"

3. Si la conditional logic no existe:
   - Agrégala en la interfaz de ACF
   - Guarda el grupo
```

---

## 🔴 Error: "Después de cambios, siguen viéndose los antiguos"

### ✅ Solución

```
1. Limpia TODOS los cachés:
   - Plugin de caché de WordPress (WP Super Cache, etc.):
     - Desactiva o limpia caché
   - Navegador:
     - Ctrl + Shift + Suprime (borrar caché)
   - Cloudflare (si usas):
     - Purgar caché
   - Proxy/VPN:
     - Desactiva temporalmente

2. Refresca con Ctrl + F5

3. Si usa desarrollador:
   - F12 → Network → Desmarcar "Caché"
   - Refresca la página
```

---

## ✅ CHECKLIST DE VERIFICACIÓN RÁPIDA

```
□ Plugin "ACF Blocks Starter" → ✅ Activo
□ Plugin "Advanced Custom Fields Pro" → ✅ Activo
□ Settings → Permalinks → "Post name" → Guardado
□ .htaccess existe y tiene RewriteEngine On
□ mod_rewrite habilitado en Apache (sin # en httpd.conf)
□ Archivo single-ficha_animacion.php existe
□ Archivo register-ficha-cpt.php existe
□ Field Group "Ficha Técnica" está activo en ACF
□ Creé una ficha de prueba
□ Puedo ver la ficha sin 404
□ Los estilos CSS se cargan (F12 → Network)
□ JavaScript funciona (F12 → Console sin errores rojos)
```

Si TODO está ✅, entonces funciona correctamente.

---

## 🎓 COMANDOS ÚTILES

### PowerShell (Windows)
```powershell
# Ver si archivo existe
Test-Path "C:\xampp\htdocs\wordpress\.htaccess"

# Ver contenido de .htaccess
Get-Content "C:\xampp\htdocs\wordpress\.htaccess"

# Crear .htaccess
@"
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
"@ | Out-File -Encoding ASCII "C:\xampp\htdocs\wordpress\.htaccess"
```

### Bash (Linux/Mac)
```bash
# Ver si archivo existe
ls -la ~/.htaccess

# Ver contenido
cat ~/.htaccess

# Crear/editar
nano ~/.htaccess
```

---

## 📞 Si NADA funciona

1. **Desactiva TODOS los plugins** (excepto ACF Pro)
2. **Reactiva solo** "ACF Blocks Starter"
3. **Resetea permalinks** nuevamente
4. **Crea ficha de prueba** nuevamente
5. **Intenta acceder** nuevamente

Si aún no funciona:

1. **Activa WP_DEBUG:**
   ```php
   // En wp-config.php:
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   ```

2. **Revisa errores:**
   ```
   wp-content/debug.log
   ```

3. **Comparte:**
   - Versión de WordPress
   - Versión de ACF Pro
   - Contenido de debug.log
   - URL de la ficha

---

## 📚 Documentación Disponible

| Archivo | Para Quién | Usar Cuando |
|---------|-----------|------------|
| [ACTIVATION-GUIDE.md](./ACTIVATION-GUIDE.md) | Nuevos usuarios | Recién activas el plugin |
| [HTACCESS-SETUP.md](./HTACCESS-SETUP.md) | Developers | Necesitas configurar .htaccess |
| [TROUBLESHOOTING-FICHAS.md](./TROUBLESHOOTING-FICHAS.md) | Soporte | 404 errors específicamente |
| [FICHA-QUICKSTART.md](./FICHA-QUICKSTART.md) | Todos | Empezar rápidamente |
| [FICHA-README.md](./FICHA-README.md) | Developers | Personalizar/extender |

---

**¡Espero que esto resuelva tu problema!** 🎉

Si tienes más dudas, consulta la documentación o crea un issue en GitHub.
