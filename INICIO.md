# 🎓 INICIO - Bienvenidos Estudiantes

¡Bienvenidos al Plugin ACF Blocks Starter! Este es tu espacio para aprender a crear bloques Gutenberg profesionales.

## 🎯 ¿Qué vamos a hacer?

Crearemos bloques Gutenberg personalizados usando:
- **WordPress** 6.2+
- **ACF Pro** para gestionar campos
- **Tailwind CSS** para estilos
- **JavaScript** para interactividad

## 🚀 Empezar en 3 pasos

### 1️⃣ Configuración Inicial (10 minutos)
Lee: **[begin.md](./begin.md)**
- Setup del proyecto
- Entender la estructura
- Instalar dependencias

### 2️⃣ Crear Tu Primer Bloque (20 minutos)
Lee: **[CREAR-PRIMER-BLOQUE.md](./CREAR-PRIMER-BLOQUE.md)**
- Paso a paso detallado
- Explicación de cada línea
- Tips y buenas prácticas

### 3️⃣ Usar un Bloque Existente (5 minutos)
Lee: **[blocks/mi-bloque/README.md](./blocks/mi-bloque/README.md)**
- Bloque de ejemplo
- Cómo funciona
- Cómo personalizarlo

---

## 📚 Documentación Disponible

### Para Principiantes
- 📖 **[begin.md](./begin.md)** - Guía general del proyecto
- 📖 **[CREAR-PRIMER-BLOQUE.md](./CREAR-PRIMER-BLOQUE.md)** - Crear bloque desde cero
- 📖 **[blocks/mi-bloque/README.md](./blocks/mi-bloque/README.md)** - Bloque de ejemplo

### Para Ficha Técnica (CPT)
- 📖 **[FICHA-QUICKSTART.md](./FICHA-QUICKSTART.md)** - Empezar en 5 minutos
- 📖 **[FICHA-README.md](./FICHA-README.md)** - Documentación técnica
- 📖 **[FICHA-CHECKLIST.md](./FICHA-CHECKLIST.md)** - Testing exhaustivo

### Para Referencia
- 📋 **[INDEX.md](./INDEX.md)** - Índice completo del proyecto
- 📋 **[PROJECT-SUMMARY.md](./PROJECT-SUMMARY.md)** - Resumen ejecutivo
- 📋 **[STRUCTURE.md](./STRUCTURE.md)** - Estructura del proyecto

---

## 🎨 Bloques Disponibles

### ✅ Testimonios Carousel
Bloque carrusel para mostrar testimonios de clientes con ratings.

```
blocks/testimonials-carousel/
├── block.json
├── testimonials-carousel.js
├── styles.css
├── render.php
├── fields.php
└── README.md
```

→ Úsalo como referencia para crear bloques complejos

### ✅ Mi Bloque Personalizado
Bloque simple de ejemplo con 3 campos.

```
blocks/mi-bloque/
├── block.json
├── fields.php
├── render.php
└── README.md
```

→ Copia este y crea el tuyo modificando los campos

---

## 🛠️ Herramientas Necesarias

### Instalar
```bash
# 1. Node.js
# Descargar desde https://nodejs.org/

# 2. WordPress
# Descargar desde https://wordpress.org/

# 3. ACF Pro
# Licencia Dev en https://www.advancedcustomfields.com/
```

### Validar Instalación
```bash
# Verificar Node.js
node --version

# Verificar npm
npm --version

# Verificar WordPress
# Dashboard de WordPress debe cargar
```

---

## 💻 Comandos Útiles

```bash
# Iniciar proyecto (instala dependencias)
npm install

# Iniciar Tailwind en modo watch
npm run dev

# Build final
npm run build

# Ver solo compilación Tailwind
npm run tailwind:build
```

---

## 📊 Estructura del Proyecto

```
wp-plugin-gutenberg-blocks/
├── plugin.php                    # Archivo principal
├── package.json                  # Dependencias
├── tailwind.config.js           # Config Tailwind
├── blocks/                       # Tus bloques
│   ├── mi-bloque/               # Tu primer bloque
│   ├── testimonials-carousel/   # Bloque carrusel
│   └── example-hero/            # Bloque hero
├── includes/                     # Funciones
│   ├── register-blocks.php      # Registro automático
│   ├── register-ficha-cpt.php   # Custom Post Type
│   └── ...
├── dist/
│   └── blocks.css               # CSS compilado
└── src/styles/
    └── blocks.css               # CSS fuente
```

---

## ⚡ Inicio Rápido (30 minutos)

### 1. Setup Inicial
```bash
# Abrir terminal en la carpeta del plugin
cd c:\xampp\htdocs\wordpress\wp-content\plugins\wp-plugin-gutenberg-blocks

# Instalar dependencias
npm install

# Ver que todo funciona
npm run tailwind:build
```

### 2. Crear Tu Primer Bloque
Sigue [CREAR-PRIMER-BLOQUE.md](./CREAR-PRIMER-BLOQUE.md)

### 3. Probar en WordPress
- Dashboard → Editor Gutenberg
- Buscar "Mi Tarjeta"
- ¡Debería aparecer!

---

## 🎓 Plan de Aprendizaje

### Semana 1: Conceptos Básicos
- [ ] Leer [begin.md](./begin.md)
- [ ] Entender estructura del proyecto
- [ ] Instalar herramientas
- [ ] Probar que todo funciona

### Semana 2: Tu Primer Bloque
- [ ] Seguir [CREAR-PRIMER-BLOQUE.md](./CREAR-PRIMER-BLOQUE.md)
- [ ] Crear bloque "Mi Tarjeta"
- [ ] Personalizar estilos
- [ ] Agregar campos nuevos

### Semana 3: Bloques Avanzados
- [ ] Analizar [blocks/testimonials-carousel/](./blocks/testimonials-carousel/)
- [ ] Crear bloque con JavaScript
- [ ] Agregar interactividad
- [ ] Usar Tailwind CSS avanzado

### Semana 4: Proyecto Final
- [ ] Crear tu propio bloque completo
- [ ] Documentar tu código
- [ ] Presentar al equipo
- [ ] Code review con instructores

---

## 🔥 Lo que Aprenderás

✅ Cómo crear bloques Gutenberg profesionales  
✅ Usar ACF Pro para gestionar campos  
✅ Estilos responsive con Tailwind CSS  
✅ Mejores prácticas de seguridad (sanitización)  
✅ Código limpio y documentado  
✅ Estructurar proyectos WordPress  
✅ Control de versiones con Git  
✅ Trabajar en equipo

---

## 💡 Tips Importantes

### Siempre Usa el Prefijo `acfb-`
```html
<!-- ❌ Malo -->
<div class="flex items-center">

<!-- ✅ Bueno -->
<div class="acfb-flex acfb-items-center">
```

### Sanitiza Todo
```php
// ❌ Malo
<?php echo $titulo; ?>

// ✅ Bueno
<?php echo esc_html($titulo); ?>
```

### Sigue la Estructura
```
blocks/tu-bloque/
├── block.json        # Configuración
├── fields.php        # Campos ACF
├── render.php        # Template
└── README.md         # Documentación
```

---

## ⚠️ Si Algo no Funciona

### El bloque no aparece
1. Verifica que ACF Pro está activo
2. Verifica que el plugin está activo
3. Actualiza la página (Ctrl+F5)
4. Revisa la consola del navegador (F12)

### Los estilos no se ven
1. Compila Tailwind: `npm run tailwind:build`
2. Limpiar cache: Ctrl+Shift+Delete
3. Ctrl+F5 en la página

### Los campos no aparecen
1. Verifica que `fields.php` existe
2. Ve a ACF → Field Groups
3. Activa el grupo si está inactivo

---

## 📞 Ayuda

Consulta estos archivos en este orden:
1. **[CREAR-PRIMER-BLOQUE.md](./CREAR-PRIMER-BLOQUE.md)** - Para crear bloques
2. **[blocks/mi-bloque/README.md](./blocks/mi-bloque/README.md)** - Para ejemplos
3. **[FICHA-README.md](./FICHA-README.md)** - Para troubleshooting
4. **[begin.md](./begin.md)** - Para conceptos generales

---

## 🎉 ¡Estás Listo!

Elige por dónde empezar:

### 👶 Soy completamente nuevo
→ Empieza con **[begin.md](./begin.md)**

### 🧑‍💻 Quiero crear mi primer bloque
→ Lee **[CREAR-PRIMER-BLOQUE.md](./CREAR-PRIMER-BLOQUE.md)**

### 🔍 Quiero ver un ejemplo
→ Revisa **[blocks/mi-bloque/README.md](./blocks/mi-bloque/README.md)**

### 📚 Quiero toda la referencia
→ Abre **[INDEX.md](./INDEX.md)**

---

## 📝 Notas

- Todos los archivos tienen comentarios explicativos
- La documentación está en español
- El código sigue mejores prácticas WordPress
- Se recomienda VS Code como editor

---

**¡Vamos a crear bloques impresionantes!** 🚀

Para cualquier duda, revisa la documentación o consulta a tu instructor.

---

**Versión**: 1.0.0  
**Última actualización**: 2024  
**Compatible con**: WordPress 6.2+, ACF Pro 6.0+, Node.js 14+
