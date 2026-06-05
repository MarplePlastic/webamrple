<?php
$current    = 'blog';
$page_title = 'Blog';
$page_desc  = 'Noticias y artículos de Marple Chile sobre packaging plástico, inocuidad y procesos productivos.';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/header.php';

/**
 * Artículos del blog: se administran desde el panel (/admin/posts.php).
 */
require_once __DIR__ . '/includes/db.php';
try {
    $posts = db()->query('SELECT category AS cat, title, excerpt, image AS img, published_at AS date FROM posts WHERE is_active = 1 ORDER BY published_at DESC, id DESC')->fetchAll();
} catch (Throwable $e) {
    $posts = [];
}

$meses = [1=>'ene',2=>'feb',3=>'mar',4=>'abr',5=>'may',6=>'jun',7=>'jul',8=>'ago',9=>'sep',10=>'oct',11=>'nov',12=>'dic'];
?>

<!-- PAGE HEADER -->
<?php
$ph_eyebrow  = 'Blog';
$ph_title    = 'Ideas, procesos e inocuidad';
$ph_subtitle = 'Compartimos contenido sobre packaging plástico y nuestras buenas prácticas productivas.';
$ph_img      = 'assets/img/Banner-blog-890x400.jpg';
require __DIR__ . '/includes/page-header.php';
?>

<section class="container-page py-20 lg:py-24">
  <?php if (!$posts): ?>
    <div class="reveal mx-auto max-w-lg rounded-2xl border border-dashed border-brand-200 bg-brand-50/40 p-10 text-center">
      <p class="text-sm text-brand-800/70">Aún no hay artículos publicados. ¡Vuelve pronto!</p>
    </div>
  <?php else: ?>
  <div class="grid gap-7 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($posts as $p):
      $ts = !empty($p['date']) ? strtotime($p['date']) : 0; ?>
      <article class="card card-hover reveal group flex flex-col overflow-hidden p-0">
        <div class="relative h-44 overflow-hidden">
          <?php if (!empty($p['img'])): ?>
            <img src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy"
                 class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
          <?php else: ?>
            <div class="flex h-full items-center justify-center bg-gradient-to-br from-brand-600 to-brand-900"><?= marple_icon('spark', 'h-10 w-10 text-white/90') ?></div>
          <?php endif; ?>
        </div>
        <div class="flex flex-1 flex-col p-6">
          <div class="flex items-center gap-3 text-xs">
            <?php if (!empty($p['cat'])): ?><span class="rounded-full bg-brand-50 px-2.5 py-1 font-semibold text-brand-600"><?= htmlspecialchars($p['cat']) ?></span><?php endif; ?>
            <?php if ($ts): ?><time class="text-brand-800/60"><?= (int)date('j', $ts) . ' ' . $meses[(int)date('n', $ts)] . ' ' . date('Y', $ts) ?></time><?php endif; ?>
          </div>
          <h2 class="mt-4 text-lg font-bold leading-snug transition group-hover:text-brand-700"><?= htmlspecialchars($p['title']) ?></h2>
          <p class="mt-2 flex-1 text-sm leading-relaxed text-brand-800/70"><?= htmlspecialchars($p['excerpt']) ?></p>
          <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600">Leer artículo <?= marple_icon('arrow', 'h-4 w-4') ?></span>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
