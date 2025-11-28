# ⚡ SOLUCIÓN INMEDIATA: Fichas 404 Not Found

## El Problema

Creaste una Ficha Técnica y cuando haces clic en "Ver", ves:
```
404 - Página no encontrada
```

## La Causa

WordPress no encuentra el template porque los **rewrite rules no están activados**.

## La Solución (2 pasos)

### PASO 1: Resetea los Permalinks (MÁS IMPORTANTE)

```
1. Ve a: WordPress Admin
2. Click: Configuración → Enlaces permanentes
3. Click: Guardar cambios (sin cambiar nada)
4. Refresca la página de tu ficha
```

✅ Esto activa los rewrite rules de WordPress.

---

### PASO 2: Si aún ves 404, configura .htaccess

**Archivo**: `C:\xampp\htdocs\wordpress\.htaccess`

**Contenido**:
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

⚠️ **Si tu WordPress está en otra ruta (no `/wordpress/`), reemplaza `/wordpress/` con tu ruta real**.

**Cómo crear/editar el archivo**:
1. Abre Notepad (Bloc de notas)
2. Pega el contenido anterior
3. Reemplaza `/wordpress/` con tu ruta
4. **File → Save As**
5. Nombre: `.htaccess` (con el punto)
6. Tipo: All Files (importante)
7. Guardar en: `C:\xampp\htdocs\wordpress\`

---

## ¿Sigue sin funcionar?

Si aún ves 404 después de los 2 pasos anteriores:

### Paso 3: Habilita mod_rewrite en Apache

1. Abre: `C:\xampp\apache\conf\httpd.conf`
2. Busca: `#LoadModule rewrite_module modules/mod_rewrite.so`
3. **Quita el `#` al inicio** para que quede:
   ```
   LoadModule rewrite_module modules/mod_rewrite.so
   ```
4. Guarda el archivo
5. Reinicia Apache (XAMPP Control Panel → Restart Apache)
6. Intenta nuevamente

---

## Verificación Final

Después de seguir los pasos anteriores:

1. **Dashboard → Ficha Animación**
2. **Haz clic en tu ficha → "Ver"**
3. ✅ Deberías ver el contenido formateado
4. ❌ Si ves 404, ve a **QUICK-FIXES.md** para más soluciones

---

## 📊 ¿Qué Hace Cada Paso?

| Paso | Qué Hace | Por Qué |
|------|----------|--------|
| Resetar permalinks | Activa rewrite rules en WordPress | WordPress necesita saber cómo procesar URLs amigables |
| Configurar .htaccess | Indica a Apache cómo reescribir URLs | Apache reescribe `/ficha-animacion/nombre/` a `index.php?post_type=...` |
| Habilitar mod_rewrite | Permite a Apache reescribir URLs | Sin esto, Apache no puede procesar URLs amigables |

---

## 🆘 Contacto

Si los 3 pasos no funcionan:

1. Revisa **QUICK-FIXES.md** (más soluciones)
2. Revisa **TROUBLESHOOTING-FICHAS.md** (diagnóstico detallado)
3. Ejecuta el diagnóstico: `http://localhost/wordpress/wp-content/plugins/wp-plugin-gutenberg-blocks/diagnostic.php`

---

**Sigue estos 3 pasos y tu Ficha Técnica funcionará.** ✅
