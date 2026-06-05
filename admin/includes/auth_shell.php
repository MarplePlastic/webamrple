<?php
/** Shell visual para páginas de login/setup (sin sesión iniciada). */
$flash = get_flash();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e($auth_title ?? 'Acceso') ?> · Marple Admin</title>
  <link rel="icon" href="../favicon.ico" sizes="any">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="grid min-h-screen place-items-center bg-brand-950 px-5">
  <div class="w-full max-w-sm">
    <div class="mb-6 text-center">
      <img src="../assets/img/icons/icon-192.png" alt="Marple" class="mx-auto h-14 w-14 rounded-2xl shadow-card">
      <h1 class="mt-4 font-display text-xl font-extrabold text-white"><?= e($auth_title ?? 'Acceso') ?></h1>
      <?php if (!empty($auth_sub)): ?><p class="mt-1 text-sm text-brand-200/70"><?= e($auth_sub) ?></p><?php endif; ?>
    </div>
    <div class="rounded-2xl bg-white p-6 shadow-card sm:p-8">
      <?php if ($flash): ?>
        <p class="mb-4 rounded-lg bg-accent-500/10 px-3 py-2 text-sm text-accent-700 ring-1 ring-accent-500/30"><?= e($flash['msg']) ?></p>
      <?php endif; ?>
