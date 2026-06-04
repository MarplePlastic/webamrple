<?php
/**
 * Datos de contenido reutilizables (servicios, valores).
 * Textos tomados del sitio actual marplechile.cl.
 */

return [
    'services' => [
        'termoformado' => [
            'title' => 'Termoformado',
            'short' => 'Lámina de plástico moldeada con calor.',
            'desc'  => 'Es un proceso mediante el cual a una lámina de plástico se le da forma con aplicación de calor para que pueda adaptarse a la forma de un molde por acción de presión, vacío o un contramolde.',
            'features' => ['Bandejas y blísters', 'Envases a medida', 'Alta repetibilidad'],
            'icon'  => 'tray',
            'img'   => 'assets/img/tf_2-410x354.jpg',
        ],
        'inyeccion' => [
            'title' => 'Inyección',
            'short' => 'Moldeo de piezas a presión.',
            'desc'  => 'El moldeo por inyección es un proceso que radica en transferir material plastificado a presión a una cavidad con un molde respectivo, para después enfriarlo y expulsarlo.',
            'features' => ['Piezas técnicas', 'Tapas y contenedores', 'Producción en serie'],
            'icon'  => 'cube',
            'img'   => 'assets/img/in_1-410x354.jpg',
        ],
        'flexible' => [
            'title' => 'Flexible',
            'short' => 'Films y láminas compuestas.',
            'desc'  => 'Proceso por el cual se forma una o varias láminas compuestas por material plástico, generando ventajas como resistencia, conservación de alimentos y barreras.',
            'features' => ['Barreras protectoras', 'Conservación de alimentos', 'Alta resistencia'],
            'icon'  => 'layers',
            'img'   => 'assets/img/lam_1-410x354.jpg',
        ],
    ],

    'values' => [
        ['title' => 'Clientes',          'desc' => 'Mantenemos una comunicación abierta y colaboramos en el desarrollo de envases según especificaciones técnicas.', 'icon' => 'handshake'],
        ['title' => 'Seguridad laboral', 'desc' => 'Proporcionamos un ambiente seguro e identificamos los riesgos en producción.', 'icon' => 'shield'],
        ['title' => 'Medio ambiente',    'desc' => 'Operamos minimizando nuestro impacto ambiental en cada etapa del proceso.', 'icon' => 'leaf'],
        ['title' => 'Calidad',           'desc' => 'Utilizamos materias primas de alta calidad con controles rigurosos.', 'icon' => 'check'],
        ['title' => 'Talento humano',    'desc' => 'Capacitamos constantemente a nuestros colaboradores en mejora continua y buenas prácticas.', 'icon' => 'users'],
        ['title' => 'Proveedores',       'desc' => 'Los seleccionamos por su capacidad de cumplir requisitos de seguridad alimentaria.', 'icon' => 'truck'],
    ],

    // Galería de productos (fotos reales en assets/img)
    'products' => [
        ['name' => 'Potes transparentes',     'img' => 'assets/img/Pote-transparente-1080x725.jpg'],
        ['name' => 'Potes con etiqueta IML',  'img' => 'assets/img/Pote-Mantequilla-Margarina_-1-1024x1024.jpg'],
        ['name' => 'Bolsas Doypack flexibles','img' => 'assets/img/Bolsa-Doypack-Flexible_-1080x725.jpg'],
        ['name' => 'Bolsas Pouch',            'img' => 'assets/img/Bolsa-Pouch-1-1080x725.jpg'],
        ['name' => 'Cucharas dosificadoras',  'img' => 'assets/img/Cucharas-Dosificadora-25g_roja-1080x725.jpg'],
        ['name' => 'Tapas a medida',          'img' => 'assets/img/Tapa-Vinagre_-1-1080x725.jpg'],
        ['name' => 'Bandejas termoformadas',  'img' => 'assets/img/bandeja_galletas_-1080x725.jpg'],
        ['name' => 'Rollos y film flexible',  'img' => 'assets/img/rollo-1080x725.jpg'],
    ],
];
