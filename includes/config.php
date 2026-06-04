<?php
/**
 * Configuración global del sitio Marple Chile.
 * Datos de contacto y metadatos centralizados para reutilizar en todas las páginas.
 */

return [
    'name'        => 'Marple Chile',
    'tagline'     => 'Plastic Solution',
    'description' => 'Marple Chile — Tu partner de packagings plásticos a tu medida. Termoformado, inyección y film flexible con altos estándares de seguridad, calidad e inocuidad alimentaria.',
    'url'         => 'https://www.marplechile.cl',

    'contact' => [
        'email'        => 'contacto@marplechile.cl',
        'phone'        => '+56 9 9504 2803',
        'phone_raw'    => '56995042803',
        'address'      => 'Sta. Marta 1051, Maipú, Región Metropolitana',
        'map_url'      => 'https://www.google.com/maps/search/?api=1&query=Sta.+Marta+1051,+Maip%C3%BA,+Regi%C3%B3n+Metropolitana',
        'map_embed'    => 'https://www.google.com/maps?q=Sta.%20Marta%201051,%20Maip%C3%BA,%20Regi%C3%B3n%20Metropolitana&output=embed',
    ],

    'hours' => [
        'Lunes a Jueves' => '8:00 — 18:00',
        'Viernes'        => '8:00 — 16:00',
        'Sábado y Domingo' => 'Cerrado',
    ],

    'social' => [
        'instagram' => [
            'label' => '@marpleplasticsolutiongroup',
            'url'   => 'https://www.instagram.com/marpleplasticsolutiongroup/',
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
