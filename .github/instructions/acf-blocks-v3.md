# ACF Blocks V3

## Configuración Obligatoria

En `block.json` usar **`blockVersion: 3`** dentro de la clave `acf`:

```json
{
  "apiVersion": 3,
  "name": "acf/mi-bloque",
  "acf": {
    "mode": "preview",
    "renderTemplate": "render.php",
    "blockVersion": 3
  }
}
```

## ⚠️ NO Confundir

- `"apiVersion": 3` → API de WordPress (block.json estándar)
- `"acf": { "blockVersion": 3 }` → Versión de ACF Blocks

**Ambos son necesarios y diferentes.**

## Ventajas V3
- Panel expandido para editar campos
- Preview visible mientras editas
- Preparado para inline editing futuro
- Alineado con WordPress 7.0+

## Migración desde V2
Agregar `"blockVersion": 3` en bloque existente. Sin más cambios requeridos.

## Referencia
- [ACF 6.6 Release](https://www.advancedcustomfields.com/blog/acf-6-6-released/)
- [Docs V3](https://www.advancedcustomfields.com/resources/acf-blocks-v3/)
