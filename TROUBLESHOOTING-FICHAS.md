# 🔧 SOLUCIÓN: Fichas No Aparecen (404 Not Found)

## ❌ Problema
Al crear una Ficha Técnica y hacer clic en "Ver", aparece:
```
404 - Página no encontrada
```

---

## ✅ SOLUCIÓN (Probada)

### Paso 1: Resetear los Permalinks

1. Ve a **WordPress Admin → Configuración → Enlaces permanentes**
2. **Importante**: Aunque ya esté configurado, cambia temporalmente:
   - Selecciona: **"Nombre de la entrada"**
   - Click en: **"Guardar cambios"**

3. Luego vuelve a:
   - Selecciona nuevamente: **"Nombre de la entrada"** (o tu formato preferido)
   - Click en: **"Guardar cambios"**

⚠️ **Esto es crucial**: Activa el rewrite rules de WordPress.

---

### Paso 2: Verificar Archivo .htaccess

**Si usas XAMPP en Windows:**

1. Ve a: `C:\xampp\htdocs\wordpress\`
2. Edita el archivo `.htaccess` (si no existe, créalo)
3. Pega este contenido:

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

⚠️ **Ajusta `/wordpress/` a tu ruta real si es diferente.**

---

### Paso 3: Verificar Módulo mod_rewrite en Apache

1. Abre: `C:\xampp\apache\conf\httpd.conf`
2. Busca: `#LoadModule rewrite_module`
3. Si tiene `#` al inicio, quítalo:
   ```
   LoadModule rewrite_module modules/mod_rewrite.so
   ```
4. Guarda el archivo
5. Reinicia Apache (XAMPP Control Panel → Restart Apache)

---

### Paso 4: Verificar CPT Está Registrado

1. Ve a **Dashboard → Ficha Animación**
   - ¿Aparece el post type?
   - ¿Puedes ver las fichas creadas?

2. Si **NO** aparece:
   - Ve a **Plugins** → Verifica que **"ACF Blocks Starter"** está ✅ Activo
   - Ve a **ACF → Field Groups** → Verifica que el grupo "Ficha Técnica" está ✅ Activo

---

### Paso 5: Crear Ficha de Prueba

1. **Dashboard → Ficha Animación → Agregar Nueva**
2. Llena los campos:
   - **Nombre**: "Test Ficha"
   - **Afiche**: Sube una imagen
   - **Sinopsis**: "Descripción de prueba"
3. **Publicar**
4. Haz clic en **"Ver" o "Ver ficha"**

---

### Paso 6: Verificar URL

Cuando haces clic en "Ver", la URL debe ser:
```
http://localhost/wordpress/ficha-animacion/test-ficha/
```

Si en lugar de eso ves:
```
http://localhost/wordpress/?post_type=ficha_animacion&p=123
```

**El problema es que los permalinks no se aplicaron correctamente.**

---

## 🔍 DIAGNÓSTICO: ¿Cuál es el problema?

### Escenario 1: Template no se carga (404)
```
El archivo single-ficha_animacion.php existe pero WordPress no lo encuentra
→ SOLUCIÓN: Resetear permalinks (Paso 1-2)
```

### Escenario 2: CPT no aparece en Dashboard
```
El CPT no está registrado o ACF no está activo
→ SOLUCIÓN: Activar plugin + ACF (Paso 4)
```

### Escenario 3: URL incorrecta
```
Usa ?post_type= en lugar de slug amigable
→ SOLUCIÓN: Resetear permalinks (Paso 1-3)
```

### Escenario 4: Módulo rewrite desactivado
```
Apache no puede procesar URLs amigables
→ SOLUCIÓN: Activar mod_rewrite (Paso 3)
```

---

## ⚡ CHECKLIST RÁPIDO

- [ ] Apache mod_rewrite está ✅ **ACTIVADO**
- [ ] .htaccess existe y tiene contenido correcto
- [ ] Plugin "ACF Blocks Starter" está ✅ **ACTIVO**
- [ ] ACF Pro está ✅ **ACTIVO**
- [ ] Field Group "Ficha Técnica" está ✅ **ACTIVO**
- [ ] Archivo `single-ficha_animacion.php` existe en raíz del plugin
- [ ] Permalinks están configurados en **"Nombre de la entrada"**
- [ ] Después de cambiar permalinks, guardaste cambios **DOS VECES**

---

## 🧪 PRUEBA FINAL

```bash
# 1. Verifica que el archivo template existe
ls -la /path/to/plugin/single-ficha_animacion.php

# 2. Verifica que el CPT está registrado
wp post-type list --field=name

# 3. Verifica que hay fichas creadas
wp post list --post_type=ficha_animacion
```

---

## 📝 Si nada funciona:

1. **Desactiva TODOS los plugins excepto ACF Pro**
   - A veces otro plugin interfiere con los rewrite rules

2. **Crea una ficha nueva**
   - Intenta nuevamente

3. **Activa WP_DEBUG**
   - Edita `wp-config.php`:
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   define('WP_DEBUG_DISPLAY', false);
   ```
   - Ve a: `wp-content/debug.log` para ver errores

4. **Contacta soporte**
   - Comparte:
     - Versión de WordPress
     - Versión de ACF Pro
     - URL que intenta acceder
     - Contenido de debug.log

---

## ✅ DESPUÉS DE ARREGLARLO

Una vez que funcione:

1. **La URL será correcta**: `/ficha-animacion/nombre-ficha/`
2. **El template cargará**: Verás el diseño responsive
3. **Los datos aparecerán**: Título, sinopsis, galería, etc.

---

## 🎓 APRENDIZAJE

El problema ocurre porque:
1. WordPress necesita **rewrite rules** activos (mod_rewrite)
2. El CPT necesita ser **registrado** en `register-ficha-cpt.php`
3. El template necesita estar en **la ubicación correcta**: `single-ficha_animacion.php`
4. Después de registrar un nuevo CPT, **SIEMPRE resetea permalinks**

---

**Sigue estos pasos y tu Ficha Técnica funcionará correctamente.** ✅
