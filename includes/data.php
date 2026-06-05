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
        ['title' => 'Innovación y Calidad',        'desc' => 'Estamos comprometidos con la excelencia en cada producto, garantizando envases seguros, duraderos y funcionales para la industria alimentaria.', 'icon' => 'spark'],
        ['title' => 'Inocuidad',                   'desc' => 'Priorizamos la seguridad alimentaria en todos nuestros procesos, asegurando que nuestros envases cumplan con los más altos estándares sanitarios.', 'icon' => 'shield'],
        ['title' => 'Responsabilidad Ambiental',   'desc' => 'Actuamos con conciencia ecológica, promoviendo prácticas sostenibles y el uso responsable de los recursos para proteger el entorno.', 'icon' => 'leaf'],
        ['title' => 'Transparencia',               'desc' => 'Actuamos con integridad y claridad en nuestras relaciones comerciales y laborales, generando confianza y credibilidad en nuestras partes interesadas.', 'icon' => 'eye'],
        ['title' => 'Compromiso y Orientación al Cliente', 'desc' => 'Escuchamos, transformamos ideas en soluciones y respondemos con rapidez y cercanía, porque el éxito de nuestros clientes se expande a nuestra organización.', 'icon' => 'handshake'],
        ['title' => 'Trabajo en Equipo y Especialización', 'desc' => 'Unimos talentos y compartimos conocimientos, fortaleciendo a nuestros equipos y convirtiéndolos en la energía que impulsa la innovación y el desarrollo.', 'icon' => 'users'],
        ['title' => 'Pasión por verlos en la mesa','desc' => 'Vivimos cada proyecto con orgullo y entusiasmo, al ver que nuestros productos, seguros y de calidad, forman parte de la vida diaria en cada mesa.', 'icon' => 'tray'],
    ],

    // Sectores / industrias que atiende Marple (mosaico estilo Goglio)
    'sectors' => [
        ['name' => 'Bebidas',                'img' => 'assets/img/tf_2-410x354.jpg'],
        ['name' => 'Lácteos y postres',      'img' => 'assets/img/in_1-410x354.jpg'],
        ['name' => 'Panadería',              'img' => 'assets/img/Bolsa-Pouch_logo-1080x725.jpg'],
        ['name' => 'Conservas y congelados', 'img' => 'assets/img/lam_1-410x354.jpg'],
        ['name' => 'Snacks',                 'img' => 'assets/img/Producto-1-1536x1024.jpg'],
        ['name' => 'Comida preparada',       'img' => 'assets/img/Pote-Mantequilla-Margarina_-1-1024x1024.jpg'],
    ],

    // Fila "Nuestro sistema" (columnas con íconos, estilo Goglio)
    'system' => [
        ['title' => 'Soluciones a medida',   'desc' => 'Envases diseñados según las especificaciones de cada cliente.', 'icon' => 'spark'],
        ['title' => 'Procesos productivos',  'desc' => 'Termoformado, inyección y film flexible en una sola planta.',   'icon' => 'cube'],
        ['title' => 'Calidad e inocuidad',   'desc' => 'Altos estándares de seguridad alimentaria en cada lote.',       'icon' => 'shield'],
        ['title' => 'Servicio integral',     'desc' => 'Te acompañamos del briefing a la entrega del producto.',         'icon' => 'handshake'],
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
