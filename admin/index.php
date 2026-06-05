<?php
require_once __DIR__ . '/../includes/admin.php';
$admin_page = 'index';
$admin_title = 'Panel';
require_login();

$counts = [
    'jobs'     => (int) db()->query('SELECT COUNT(*) c FROM jobs')->fetch()['c'],
    'posts'    => (int) db()->query('SELECT COUNT(*) c FROM posts')->fetch()['c'],
    'products' => (int) db()->query('SELECT COUNT(*) c FROM products')->fetch()['c'],
];
$cards = [
    ['Vacantes', $counts['jobs'], 'jobs.php', 'Ofertas de empleo publicadas'],
    ['Artículos del blog', $counts['posts'], 'posts.php', 'Publicaciones del blog'],
    ['Productos', $counts['products'], 'products.php', 'Imágenes de la galería'],
];
require __DIR__ . '/includes/header.php';
?>
<div class="mb-8">
  <h1 class="font-display text-2xl font-extrabold">Bienvenido al panel</h1>
  <p class="mt-1 text-sm text-brand-800/70">Administra el contenido del sitio: vacantes, blog, productos y datos de contacto.</p>
</div>

<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
  <?php foreach ($cards as [$label, $count, $href, $desc]): ?>
    <a href="<?= $href ?>" class="group rounded-2xl bg-white p-6 shadow-card ring-1 ring-brand-50 transition hover:-translate-y-0.5 hover:shadow-card-hover">
      <div class="flex items-baseline justify-between">
        <span class="text-sm font-semibold uppercase tracking-wide text-brand-500"><?= e($label) ?></span>
        <span class="font-display text-3xl font-extrabold text-brand-700"><?= $count ?></span>
      </div>
      <p class="mt-2 text-sm text-brand-800/60"><?= e($desc) ?></p>
      <span class="mt-4 inline-block text-sm font-semibold text-brand-600 group-hover:text-brand-800">Administrar →</span>
    </a>
  <?php endforeach; ?>

  <a href="settings.php" class="group rounded-2xl bg-brand-700 p-6 text-white shadow-card transition hover:-translate-y-0.5">
    <span class="text-sm font-semibold uppercase tracking-wide text-brand-100">Ajustes</span>
    <p class="mt-2 text-sm text-brand-100/80">Teléfono, correo, dirección y horario de atención.</p>
    <span class="mt-4 inline-block text-sm font-semibold text-white">Editar datos →</span>
  </a>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
