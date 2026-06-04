<?php
/**
 * Cabecera compartida + apertura del <body>.
 * Variables esperadas (opcionales) antes de incluir:
 *   $current     -> clave de nav activa (ej. 'index', 'nosotros'...)
 *   $page_title  -> título específico de la página
 *   $page_desc   -> meta description específica
 */
$config = require __DIR__ . '/config.php';
$current = $current ?? 'index';

$site_name  = $config['name'] . ' — ' . $config['tagline'];
$page_title = isset($page_title) ? $page_title . ' | ' . $config['name'] : $site_name;
$page_desc  = $page_desc ?? $config['description'];
?>
<!doctype html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
  <meta name="theme-color" content="#1c6889">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= htmlspecialchars($config['name']) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_desc) ?>">
  <meta property="og:locale" content="es_CL">
  <meta property="og:image" content="<?= $config['url'] ?>/assets/img/Banner-1520x750-1-1290x725.png">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" href="favicon.ico" sizes="any">
  <link rel="icon" type="image/svg+xml" href="assets/img/icons/icon.svg">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icons/favicon-32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icons/favicon-16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icons/apple-touch-icon.png">
  <link rel="manifest" href="site.webmanifest">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Datos estructurados para buscadores (negocio local) -->
  <script type="application/ld+json">
  <?= json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'LocalBusiness',
    'name'     => $config['name'] . ' — ' . $config['tagline'],
    'image'    => $config['url'] . '/assets/img/Logo_MARPLE-150x90.png',
    'url'      => $config['url'],
    'telephone'=> $config['contact']['phone'],
    'email'    => $config['contact']['email'],
    'address'  => [
      '@type'           => 'PostalAddress',
      'streetAddress'   => 'Sta. Marta 1051',
      'addressLocality' => 'Maipú',
      'addressRegion'   => 'Región Metropolitana',
      'addressCountry'  => 'CL',
    ],
    'openingHoursSpecification' => [
      ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday'], 'opens' => '08:00', 'closes' => '18:00'],
      ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Friday', 'opens' => '08:00', 'closes' => '16:00'],
    ],
    'sameAs'   => [$config['social']['instagram']['url']],
  ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
  </script>
</head>
<body>
<a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-lg focus:bg-brand-700 focus:px-4 focus:py-2 focus:text-white">Saltar al contenido</a>

<header id="site-header" class="sticky top-0 z-40 border-b border-transparent bg-white/80 backdrop-blur-md transition-all duration-300">
  <div class="container-page flex h-20 items-center justify-between py-4">
    <a href="index.php" class="flex items-center gap-2.5" aria-label="<?= htmlspecialchars($config['name']) ?> inicio">
      <?php include __DIR__ . '/logo.php'; ?>
    </a>

    <nav class="hidden items-center gap-6 lg:flex" aria-label="Navegación principal">
      <?php foreach ($config['nav'] as $key => $item): ?>
        <a href="<?= $item['href'] ?>" class="nav-link <?= $current === $key ? 'is-active' : '' ?>"><?= $item['label'] ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="hidden items-center gap-3 lg:flex">
      <a href="tel:+<?= $config['contact']['phone_raw'] ?>" class="btn-ghost hidden xl:inline-flex">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
        <?= $config['contact']['phone'] ?>
      </a>
      <a href="contacto.php" class="btn-primary">Cotizar</a>
    </div>

    <button id="menu-toggle" type="button" class="inline-flex items-center justify-center rounded-lg p-2 text-brand-800 hover:bg-brand-50 lg:hidden" aria-label="Abrir menú" aria-expanded="false" aria-controls="mobile-menu">
      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
    </button>
  </div>

  <!-- Menú móvil -->
  <div id="mobile-menu" class="hidden border-t border-brand-50 bg-white lg:hidden">
    <nav class="container-page flex flex-col gap-1 py-4" aria-label="Navegación móvil">
      <?php foreach ($config['nav'] as $key => $item): ?>
        <a href="<?= $item['href'] ?>" class="rounded-lg px-3 py-2.5 text-base font-medium <?= $current === $key ? 'bg-brand-50 text-brand-700' : 'text-brand-800 hover:bg-brand-50' ?>"><?= $item['label'] ?></a>
      <?php endforeach; ?>
      <a href="contacto.php" class="btn-primary mt-3">Solicitar cotización</a>
    </nav>
  </div>
</header>

<main id="main">
