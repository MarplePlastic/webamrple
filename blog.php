<?php
$current    = 'blog';
$page_title = 'Blog';
$page_desc  = 'Noticias y artículos de Marple Chile sobre packaging plástico, inocuidad y procesos productivos.';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/header.php';

/**
 * Artículos de ejemplo. Reemplaza este arreglo por tus publicaciones reales
 * (o conéctalo más adelante a una base de datos / CMS).
 */
$posts = [
    ['cat' => 'Procesos',   'title' => 'Termoformado vs. inyección: ¿qué proceso conviene a tu producto?', 'excerpt' => 'Comparamos ambos procesos para ayudarte a elegir la solución más eficiente según tu tipo de envase.', 'date' => '2026-05-20', 'img' => 'assets/img/BLOG-1-600x572.jpg'],
    ['cat' => 'Inocuidad',  'title' => 'Estándares de inocuidad alimentaria en envases plásticos', 'excerpt' => 'Cómo aseguramos seguridad, calidad y legalidad en cada lote que producimos.', 'date' => '2026-04-12', 'img' => 'assets/img/BLOG-2-600x572.jpg'],
    ['cat' => 'Sostenibilidad', 'title' => 'Hacia un packaging con menor impacto ambiental', 'excerpt' => 'Nuestras prácticas para minimizar el impacto en cada etapa del proceso productivo.', 'date' => '2026-03-03', 'img' => 'assets/img/BLOG-3-600x572.jpg'],
];

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
  <div class="grid gap-7 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($posts as $p):
      $ts = strtotime($p['date']); ?>
      <article class="card card-hover reveal group flex flex-col overflow-hidden p-0">
        <div class="relative h-44 overflow-hidden">
          <img src="<?= $p['img'] ?>" alt="<?= htmlspecialchars($p['title']) ?>" loading="lazy"
               class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        </div>
        <div class="flex flex-1 flex-col p-6">
          <div class="flex items-center gap-3 text-xs">
            <span class="rounded-full bg-brand-50 px-2.5 py-1 font-semibold text-brand-600"><?= $p['cat'] ?></span>
            <time class="text-brand-800/60"><?= (int)date('j', $ts) . ' ' . $meses[(int)date('n', $ts)] . ' ' . date('Y', $ts) ?></time>
          </div>
          <h2 class="mt-4 text-lg font-bold leading-snug transition group-hover:text-brand-700"><?= $p['title'] ?></h2>
          <p class="mt-2 flex-1 text-sm leading-relaxed text-brand-800/70"><?= $p['excerpt'] ?></p>
          <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600">Leer artículo <?= marple_icon('arrow', 'h-4 w-4') ?></span>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

  <div class="reveal mt-16 rounded-2xl border border-dashed border-brand-200 bg-brand-50/40 p-8 text-center">
    <p class="text-sm text-brand-800/70">
      <strong class="text-brand-900">Nota:</strong> estos son artículos de ejemplo. Reemplázalos por tus publicaciones reales editando el arreglo <code class="rounded bg-white px-1.5 py-0.5 text-brand-700">$posts</code> en <code class="rounded bg-white px-1.5 py-0.5 text-brand-700">blog.php</code> o conectándolo a un CMS.
    </p>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
