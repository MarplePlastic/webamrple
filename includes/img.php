<?php
/**
 * Devuelve la versión WebP de una imagen si existe en disco, y si no, la
 * original. Así el sitio sirve las imágenes livianas sin tener que cambiar
 * cada referencia — y sigue funcionando con las rutas que vienen de la base
 * de datos (galería administrable), que apuntan a los .jpg originales.
 *
 * Las .webp se generan redimensionadas al tamaño en que realmente se muestran
 * (600 px los productos, 800 px las tarjetas), porque antes se descargaban
 * fotos de 1080 px para mostrarlas a 278.
 */
function img_src(?string $ruta): string
{
    $ruta = trim((string) $ruta);
    if ($ruta === '') {
        return '';
    }

    // Solo actúa sobre imágenes locales del sitio.
    if (preg_match('#^(https?:)?//#i', $ruta)) {
        return $ruta;
    }

    $webp = preg_replace('/\.(jpe?g|png)$/i', '.webp', $ruta);
    if ($webp === null || $webp === $ruta) {
        return $ruta;   // no era jpg/png
    }

    $absoluta = __DIR__ . '/../' . ltrim($webp, '/');

    return is_file($absoluta) ? $webp : $ruta;
}
