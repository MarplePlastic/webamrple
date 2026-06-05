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
├── admin/               # Panel de administración (login + CRUD)
├── config/              # Credenciales de BD (db.local.php, no se versiona)
├── database/schema.sql  # Esquema MySQL + datos semilla
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

## Panel de administración (CMS)

El sitio es **autoadministrable** mediante un panel en `/admin` con login. Permite
gestionar **vacantes**, **artículos del blog**, **productos de la galería** y los
**datos de contacto/horario**, con **subida de imágenes**. Usa **MySQL/MariaDB** (PDO).

### Puesta en marcha
1. **Crea la base de datos** e importa el esquema:
   ```sql
   CREATE DATABASE marple_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
   Importa `database/schema.sql` en esa base (phpMyAdmin → Importar, o por consola).
2. **Configura las credenciales**: copia `config/db.sample.php` a `config/db.local.php`
   y completa host, base, usuario y contraseña. (Este archivo no se versiona.)
   - Alternativa: definir variables de entorno `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`
     (es lo que usa el `docker-compose.yml`).
3. **Crea el primer administrador**: entra a `tusitio.cl/admin/` — la primera vez te
   llevará a `setup.php` para crear el usuario y contraseña. Luego inicia sesión.

### Secciones del panel
- **Vacantes** — alta/edición/baja de ofertas (aparecen en *Trabaja con nosotros*).
- **Blog** — artículos con categoría, fecha, extracto, contenido e imagen.
- **Productos** — imágenes y nombres de la galería del inicio.
- **Ajustes** — teléfono, correo, dirección, horario e Instagram (pie, contacto, WhatsApp).

### Seguridad
- Contraseñas con `password_hash`, sesiones con cookie `HttpOnly`, **CSRF** en todos los formularios.
- Carpetas `config/`, `database/` e `includes/` bloqueadas vía `.htaccess`.
- Subidas validadas (tipo y tamaño) y guardadas en `assets/img/uploads/` sin ejecución de código.

### Correr con Docker
```bash
docker compose up -d      # sitio: http://localhost:8080 · phpMyAdmin: http://localhost:8081
```
El esquema se carga solo la primera vez (la BD `marple` queda lista).

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
