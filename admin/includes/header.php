<?php
/**
 * Layout del panel admin. Variables esperadas:
 *   $admin_title (título de la página), $admin_page (clave de nav activa).
 */
require_once __DIR__ . '/../../includes/admin.php';
require_login();
$admin = current_admin();
$admin_page = $admin_page ?? '';
$nav = [
    'index'    => ['Panel', 'index.php'],
    'jobs'     => ['Vacantes', 'jobs.php'],
    'posts'    => ['Blog', 'posts.php'],
    'products' => ['Productos', 'products.php'],
    'settings' => ['Ajustes', 'settings.php'],
    'users'    => ['Usuarios', 'users.php'],
];
$flash = get_flash();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e($admin_title ?? 'Panel') ?> · Marple Admin</title>
  <link rel="icon" href="../favicon.ico" sizes="any">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="min-h-screen bg-brand-50/50 font-sans text-brand-950">

<header class="sticky top-0 z-30 border-b border-brand-100 bg-white">
  <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-3">
    <a href="index.php" class="flex items-center gap-2.5">
      <img src="../assets/img/icons/icon-192.png" alt="" class="h-8 w-8 rounded-lg">
      <span class="font-display text-base font-extrabold">Marple <span class="text-brand-500">· Panel</span></span>
    </a>
    <div class="flex items-center gap-3 text-sm">
      <a href="../index.php" target="_blank" class="hidden text-brand-700 hover:underline sm:inline">Ver sitio ↗</a>
      <span class="hidden text-brand-800/60 sm:inline">Hola, <strong class="font-semibold text-brand-900"><?= e($admin['username']) ?></strong></span>
      <a href="logout.php" class="rounded-lg bg-brand-50 px-3 py-1.5 font-medium text-brand-700 hover:bg-brand-100">Cerrar sesión</a>
    </div>
  </div>
  <nav class="border-t border-brand-50">
    <div class="mx-auto flex max-w-6xl gap-1 overflow-x-auto px-3">
      <?php foreach ($nav as $key => [$label, $href]): $active = $admin_page === $key; ?>
        <a href="<?= $href ?>" class="whitespace-nowrap border-b-2 px-4 py-3 text-sm font-medium transition <?= $active ? 'border-brand-600 text-brand-700' : 'border-transparent text-brand-800/70 hover:text-brand-900' ?>"><?= $label ?></a>
      <?php endforeach; ?>
    </div>
  </nav>
</header>

<main class="mx-auto max-w-6xl px-5 py-8">
  <?php if ($flash): ?>
    <div class="mb-6 flex items-start gap-3 rounded-xl px-4 py-3 text-sm ring-1 <?= $flash['type'] === 'error' ? 'bg-red-50 text-red-700 ring-red-200' : 'bg-accent-500/10 text-accent-700 ring-accent-500/30' ?>">
      <span><?= e($flash['msg']) ?></span>
    </div>
  <?php endif; ?>
