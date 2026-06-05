<?php
/**
 * Configuración global del sitio Marple.
 * Los datos de contacto/horario/redes se leen de la base de datos (tabla settings)
 * si está disponible; si no, se usan los valores por defecto de abajo.
 */
require_once __DIR__ . '/db.php';

$s = settings(); // [] si la BD no está disponible

$address = $s['contact_address'] ?? 'Sta. Marta 1051, Maipú, Región Metropolitana';

return [
    'name'        => 'Marple Chile',
    'tagline'     => 'Plastic Solution',
    'description' => 'Marple Chile — Tu partner de packagings plásticos a tu medida. Termoformado, inyección y film flexible con altos estándares de seguridad, calidad e inocuidad alimentaria.',
    'url'         => 'https://www.marplechile.cl',

    'contact' => [
        'email'     => $s['contact_email'] ?? 'contacto@marplechile.cl',
        'phone'     => $s['contact_phone'] ?? '+56 9 9504 2803',
        'phone_raw' => $s['contact_phone_raw'] ?? '56995042803',
        'address'   => $address,
        'map_url'   => 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($address),
        'map_embed' => 'https://www.google.com/maps?q=' . rawurlencode($address) . '&output=embed',
    ],

    'hours' => [
        'Lunes a Jueves'   => $s['hours_weekday'] ?? '8:00 — 18:00',
        'Viernes'          => $s['hours_friday'] ?? '8:00 — 16:00',
        'Sábado y Domingo' => $s['hours_weekend'] ?? 'Cerrado',
    ],

    'social' => [
        'instagram' => [
            'label' => $s['instagram_label'] ?? '@marpleplasticsolutiongroup',
            'url'   => $s['instagram_url'] ?? 'https://www.instagram.com/marpleplasticsolutiongroup/',
        ],
    ],

    'nav' => [
        'index'     => ['label' => 'Inicio',    'href' => 'index.php'],
        'nosotros'  => ['label' => 'Nosotros',  'href' => 'nosotros.php'],
        'servicios' => ['label' => 'Servicios', 'href' => 'servicios.php'],
        'blog'      => ['label' => 'Blog',       'href' => 'blog.php'],
        'trabaja'   => ['label' => 'Trabaja con nosotros', 'href' => 'trabaja.php'],
        'contacto'  => ['label' => 'Contacto',  'href' => 'contacto.php'],
    ],
];
