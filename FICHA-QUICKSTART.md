# Ficha Técnica - QUICKSTART

Guía rápida (5 minutos) para crear y visualizar tu primera Ficha Técnica.

## 1️⃣ PRERREQUISITOS (30 segundos)

Asegúrate que tengas:
- ✅ WordPress 6.2+
- ✅ ACF Pro 6.0+ instalado y activo
- ✅ Plugin "ACF Blocks Starter" activo
- ✅ XAMPP corriendo en `localhost`

**Verificar**: Dashboard → Ficha Animación (debe aparecer en el menú)

---

## 2️⃣ CREAR FICHA DE PRUEBA (2 minutos)

### 2.1 Ir a Nueva Ficha
1. Dashboard → **Ficha Animación** (en menu izquierdo)
2. Click en **+ Agregar Nueva**

### 2.2 Llenar Campos Requeridos
Página abierta → Tab "Ficha técnica":

**Necesario:**
- **Nombre**: `Mi Primera Animación`
- **Afiche**: Click en campo → Seleccionar imagen
- **Sinopsis**: Escribe algo (ej: "Una obra sobre...")

**Recomendado:**
- **Año**: `2023`
- **Duración**: `15 min`
- **Formato**: `Cortometraje` (select)
- **Idioma**: `Español`
- **País**: `Chile`

### 2.3 Agregar Contenido Extra (Opcional)

#### Galería (Tab 1)
1. Click en **Agregar fila** bajo "Mini galería"
2. Click en icono de imagen
3. Seleccionar 4-5 imágenes
4. Repetir 4 veces

#### Equipo y Reparto (Tab 3)
1. Llenar: Dirección, Guión, Productora (mínimo)
2. Los demás campos son opcionales

#### Premios (Tab 4)
1. Click en **Agregar fila** bajo "Premios"
2. Llenar: Nombre del premio, Festival, Año
3. Repetir para cada premio

#### Plataformas (Tab 5)
1. Click en **Agregar fila** bajo "Plataformas"
2. **Servicio**: Seleccionar (Netflix, Disney+, etc.)
3. **Link**: Pegar URL (https://www.netflix.com/)

### 2.4 Publicar
1. Click en botón **Publicar**
2. Esperar a que diga "Publicada"

---

## 3️⃣ VER LA FICHA (1 minuto)

### Opción A: Desde Dashboard
1. Dashboard → Ficha Animación
2. Encontrar tu ficha en la lista
3. Click en **Ver** (azul, debajo del título)

### Opción B: URL Manual
1. Copiar el permalink que aparece debajo del título
2. Ejemplo: `http://localhost/wordpress/ficha-animacion/mi-primera-animacion/`
3. Pegar en navegador

---

## 4️⃣ PROBAR RESPONSIVIDAD (1 minuto)

### Mobile (Chrome DevTools)
1. En la página de la ficha, presionar **F12**
2. Presionar **Ctrl+Shift+M** (o click en icono mobile)
3. Seleccionar **iPhone SE** (375px)
4. Verificar:
   - ✅ Afiche visible
   - ✅ Acordeones funcionan (click)
   - ✅ Galería navega (dots o swipe)
   - ✅ Botones plataformas full-width

### Desktop
1. Redimensionar ventana a 1920px
2. Verificar:
   - ✅ Grid 2 columnas
   - ✅ Tabs funcionan (Info, Equipo, Financiamiento)
   - ✅ Galería visible en columna derecha

---

## 5️⃣ EDITAR DESPUÉS (Si necesitas cambios)

1. Dashboard → Ficha Animación
2. Click en tu ficha
3. Editar los campos que necesites
4. Click **Actualizar**
5. Refrescar la página frontend (Ctrl+F5)

---

## 🎯 CHECKLIST RÁPIDO

```
Antes de irte:
□ Ficha "Ficha Animación" aparece en Dashboard
□ Creé mi primera ficha con nombre y afiche
□ Publicada correctamente
□ Puedo ver la URL amigable
□ Probé que funcione en mobile
□ Probé que funcione en desktop
□ Los acordeones abiertos/cerrados funcionan
□ La galería carousel navega
□ Los tabs (desktop) cambian contenido
```

---

## ⚠️ SI ALGO NO FUNCIONA

### Problema: "Ficha Animación" no aparece en Dashboard
**Solución:**
1. Verificar que ACF Pro esté activo (Dashboard → Plugins)
2. Verificar que el plugin esté activo
3. Refrescar página (F5)
4. Si persiste: Desactivar y reactivar plugin

### Problema: Formulario no muestra campos
**Solución:**
1. Dashboard → ACF → Field Groups
2. Verificar que grupo "Ficha Técnica" esté activo
3. Si no: Click en grupo → Click "Activate" 

### Problema: Template no se carga / Error 404
**Solución:**
1. Verificar archivo `single-ficha_animacion.php` existe en raíz del plugin
2. Verificar ruta es correcta: `/wp-content/plugins/wp-plugin-gutenberg-blocks/single-ficha_animacion.php`
3. Ir a: Settings → Permalinks → Click "Guardar cambios"

### Problema: Estilos CSS no se ven
**Solución:**
1. Limpiar cache: Ctrl+Shift+Delete (en navegador)
2. Ctrl+F5 en la página de ficha
3. Verificar `ficha-styles.css` existe en raíz del plugin
4. Inspeccionar (F12 → Network) si CSS se carga

### Problema: JavaScript no funciona (acordeones, tabs no responden)
**Solución:**
1. Limpiar cache del navegador
2. Ctrl+F5 en página de ficha
3. Abrir F12 → Console → Buscar errores (rojo)
4. Verificar `ficha-script.js` existe en raíz del plugin

---

## 📚 SIGUIENTE PASO

- Leer **FICHA-README.md** para documentación completa
- Usar **FICHA-CHECKLIST.md** para testing exhaustivo
- Ver **FICHA-EXAMPLE.js** para estructura de datos

---

## 💡 TIPS

### Para Galería
- Mínimo 4 imágenes para que aparezcan dots
- Si subes 5-8 imágenes: carousel automático

### Para Premios
- Máximo recomendado: 5-10 premios
- Deja vacío si no tiene premios (no mostrar sección)

### Para Plataformas
- Agregar al menos 1 para que sea útil
- URLs deben ser completas: `https://...`

### Para Campos "Otro"
- Si seleccionas "otro" en Formato → aparece campo de texto
- Escribe tu valor custom (ej: "Instalación interactiva")
- Mismo para Técnica de Animación

---

**¿Necesitas ayuda?**
Consulta FICHA-README.md o FICHA-CHECKLIST.md

¡Listo! Tu Ficha Técnica está funcionando ✅
