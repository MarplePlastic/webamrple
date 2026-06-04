# Marple Chile — Sitio web

Rediseño del sitio de **Marple Chile · Plastic Solution** construido con **PHP** (páginas + includes), **Tailwind CSS** y **JavaScript** vanilla. Pensado para desplegarse en hosting compartido tipo cPanel/Apache con PHP.

## Estructura

```
.
├── index.php            # Inicio (hero, servicios, valores, CTA)
├── nosotros.php         # Misión, visión y valores
├── servicios.php        # Termoformado, inyección, flexible + proceso
├── blog.php             # Listado de artículos (editable)
├── trabaja.php          # Trabaja con nosotros: vacantes + postulación con CV
├── contacto.php         # Formulario (valida y envía por mail()) + mapa
├── uploads/cv/          # CVs recibidos (protegida, no se versiona)
├── includes/
│   ├── config.php       # Datos de contacto, horario, redes, navegación
│   ├── data.php         # Contenido de servicios y valores
│   ├── header.php       # <head>, navbar y menú móvil
│   ├── footer.php       # Pie de página y cierre
│   ├── logo.php         # Logo SVG
│   └── icons.php        # Helper de íconos SVG
├── assets/
│   ├── css/input.css    # Fuente Tailwind (directivas + componentes)
│   ├── css/style.css    # CSS COMPILADO (se sube al hosting)
│   ├── js/main.js       # Menú móvil, scroll, animaciones
│   └── img/favicon.svg
├── tailwind.config.js   # Paleta de marca y configuración
├── package.json
└── .htaccess            # URLs limpias, caché, seguridad
```

## Desarrollo

Requiere [Node.js](https://nodejs.org) y, para previsualizar, PHP.

```bash
npm install          # instala Tailwind
npm run dev          # recompila el CSS al vuelo mientras editas
```

En otra terminal, levanta el servidor PHP:

```bash
php -S localhost:8080
# abre http://localhost:8080
```

## Compilar para producción

```bash
npm run build        # genera assets/css/style.css minificado
```

Luego sube **todos los archivos** (incluido `assets/css/style.css`) al hosting.
**No necesitas subir** `node_modules/` ni ejecutar Node en el servidor: solo PHP.

## Editar contenido

- **Datos de contacto / horario / redes:** `includes/config.php`
- **Servicios y valores:** `includes/data.php`
- **Artículos del blog:** arreglo `$posts` en `blog.php`
- **Colores de marca:** `tailwind.config.js` (recompila con `npm run build`)

## Formulario de contacto

`contacto.php` valida en el servidor y envía con la función `mail()` de PHP al correo
definido en `config.php`. Incluye un *honeypot* anti-spam. Si tu hosting no entrega
correos con `mail()`, conéctalo a SMTP (p. ej. PHPMailer) en el bloque de envío.

## SEO incluido

- **JSON-LD `LocalBusiness`** (dirección, teléfono, horario) en el `<head>` → `includes/header.php`.
- **`sitemap.xml`** y **`robots.txt`** en la raíz.
- Meta `description`, Open Graph y `og:image` por página.

## Optimización de imágenes

Los banners de foto se optimizaron con [sharp](https://sharp.pixelplumbing.com) (PNG → JPG / PNG comprimido),
reduciendo ~1,6 MB. Para reoptimizar nuevas imágenes pesadas:

```bash
npm install --no-save sharp
# luego un script Node con sharp(src).jpeg({quality:82, mozjpeg:true}).toFile(dst)
```

## Notas

- Contenido y datos basados en el sitio original https://www.marplechile.cl/.
- Las fotos reales de productos/servicios están en `assets/img/` y se referencian desde
  `includes/data.php` (servicios y galería) y el arreglo `$posts` de `blog.php`.
- Botón flotante de WhatsApp configurable desde el teléfono en `includes/config.php`.
