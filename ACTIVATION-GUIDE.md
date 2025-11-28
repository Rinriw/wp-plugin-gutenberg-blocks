# 🚀 GUÍA DE ACTIVACIÓN - Plugin ACF Blocks Starter

## ⚠️ IMPORTANTE: Después de Activar el Plugin

Una vez que actives el plugin "ACF Blocks Starter", **DEBES hacer esto inmediatamente:**

### Paso 1: Resetear Permalinks (CRÍTICO)

1. Ve a **WordPress Admin**
2. **Configuración → Enlaces permanentes**
3. Observa la configuración actual (normalmente "Nombre de la entrada")
4. **Haz clic en "Guardar cambios"** (incluso si no cambias nada)

⚠️ **Esto es MUY IMPORTANTE**: WordPress recalcula los rewrite rules.

---

### Paso 2: Verificar que Todo Funciona

#### Verificar CPT Visible
- Ve a **Dashboard (lado izquierdo)**
- ¿Ves **"Ficha Animación"**?
- Si **NO** la ves:
  - Plugins → Verifica que **"ACF Blocks Starter"** está ✅ **Activo**
  - Plugins → Verifica que **"Advanced Custom Fields Pro"** está ✅ **Activo**

#### Verificar ACF Field Group
- Ve a **ACF → Field Groups**
- ¿Ves **"Ficha Técnica"**?
- Si **NO** la ves o está **gris**:
  - Haz clic en el grupo
  - En la esquina superior derecha, haz clic en **"Sincronizar"** (si aparece)

#### Crear Ficha de Prueba
1. **Dashboard → Ficha Animación → Agregar Nueva**
2. Llena los campos básicos:
   - **Nombre**: "Mi Primera Ficha"
   - **Afiche**: Sube una imagen
   - **Sinopsis**: "Descripción de prueba"
3. **Publicar**

#### Ver la Ficha Publicada
1. Haz clic en **"Ver"** o **"Ver ficha"**
2. ✅ Si ves el contenido formateado → **¡FUNCIONANDO!**
3. ❌ Si ves "404 Not Found" → Ve a **SOLUCIÓN DE PROBLEMAS**

---

### Paso 3: Verificar Apache mod_rewrite (si en XAMPP)

Si ves errores 404:

1. Abre: **C:\xampp\apache\conf\httpd.conf**
2. Busca: `#LoadModule rewrite_module`
3. Si está comentado (tiene `#`), descomenta la línea:
   ```
   LoadModule rewrite_module modules/mod_rewrite.so
   ```
4. Guarda el archivo
5. **XAMPP Control Panel → Restart Apache**
6. Intenta nuevamente

---

### Paso 4: Verificar .htaccess (si en XAMPP)

Si aún ves 404:

1. Ve a: **C:\xampp\htdocs\wordpress\**
2. Abre o crea `.htaccess`
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
4. **⚠️ Reemplaza `/wordpress/` con tu ruta real** (si es diferente)
5. Guarda

---

## 📋 CHECKLIST POST-ACTIVACIÓN

- [ ] Plugin "ACF Blocks Starter" está ✅ **ACTIVO**
- [ ] Plugin "Advanced Custom Fields Pro" está ✅ **ACTIVO**
- [ ] Ejecuté **Configuración → Enlaces permanentes → Guardar cambios**
- [ ] "Ficha Animación" aparece en el Dashboard
- [ ] ACF Field Group "Ficha Técnica" está activo
- [ ] Creé una ficha de prueba
- [ ] Puedo ver la ficha sin error 404
- [ ] Los estilos y contenido se ven correctamente

---

## 🆘 SOLUCIÓN RÁPIDA DE PROBLEMAS

| Problema | Solución |
|----------|----------|
| "Ficha Animación" no aparece en Dashboard | Activar plugin + ACF, luego Settings → Permalinks → Save |
| Campo "Ficha Técnica" está gris en ACF | Ir a ACF → Field Groups → Sincronizar |
| Error 404 al ver ficha | Resetear permalinks (Settings → Links) + verificar .htaccess |
| Los estilos no se ven | Limpiar cache (Ctrl+Shift+Del en navegador) + Ctrl+F5 |
| Los acordeones no funcionan | F12 → Console, ver si hay errores. Verificar ficha-script.js cargó |

---

## ✅ SIGUIENTE PASO

Una vez que todo funcione:

1. **Leer**: [FICHA-QUICKSTART.md](./FICHA-QUICKSTART.md)
2. **Crear**: Tu primera ficha con todos los campos
3. **Probar**: En mobile y desktop
4. **Personalizar**: Cambiar colores, añadir campos, etc.

---

**¡Ya está listo para usar!** 🎉
