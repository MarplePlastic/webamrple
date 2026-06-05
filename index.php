<?php
$current    = 'index';
$page_title = 'Soluciones plásticas a tu medida';
$page_desc  = 'Marple Chile — tu partner de packagings plásticos a tu medida. Termoformado, inyección y film flexible para la industria alimentaria.';
$data       = require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/icons.php';
// Galería de productos administrable desde el panel (con respaldo a data.php)
require_once __DIR__ . '/includes/db.php';
try {
    $rows = db()->query('SELECT name, image AS img FROM products WHERE is_active = 1 ORDER BY sort_order, id')->fetchAll();
    if ($rows) { $data['products'] = $rows; }
} catch (Throwable $e) { /* respaldo: data.php */ }
require __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="relative overflow-hidden bg-brand-950">
  <!-- Imagen de fondo -->
  <img src="assets/img/METALICO_rollo1-1080x725.jpg" alt="" aria-hidden="true"
       class="absolute inset-0 h-full w-full object-cover">
  <!-- Capas de oscurecido para legibilidad -->
  <div class="absolute inset-0 bg-gradient-to-b from-brand-950/85 via-brand-950/60 to-brand-950/85"></div>
  <div class="absolute inset-0 bg-brand-950/35"></div>

  <div class="container-page relative flex items-center justify-center py-12 text-center lg:min-h-[calc(100vh-5rem)] lg:py-8">
    <div class="reveal mx-auto w-full max-w-3xl rounded-2xl bg-brand-950/30 p-6 ring-1 ring-white/10 backdrop-blur-sm sm:p-8">
      <span class="eyebrow bg-white/10 text-brand-100 ring-white/15">Plastic Solution · Chile</span>
      <h1 class="mt-4 font-display text-4xl font-extrabold uppercase leading-[1.03] tracking-tight text-white sm:text-5xl lg:text-[3.4rem]">
        Envases plásticos<br><span class="text-brand-300">a tu medida</span>
      </h1>
      <p class="mx-auto mt-4 max-w-xl text-base leading-relaxed text-brand-100/85 sm:text-lg">
        Desarrollamos packaging para la industria alimentaria bajo la marca de nuestros clientes,
        con altos estándares de seguridad, calidad e inocuidad.
      </p>
      <div class="mt-6 flex flex-wrap items-center justify-center gap-4">
        <a href="contacto.php" class="btn-primary">Solicitar cotización <?= marple_icon('arrow', 'h-4 w-4') ?></a>
        <a href="servicios.php" class="btn-light">Ver servicios</a>
      </div>
      <dl class="mx-auto mt-6 grid max-w-md grid-cols-3 gap-6 border-t border-white/15 pt-4">
        <div><dt class="text-2xl font-bold text-white" data-count="3">0</dt><dd class="text-sm text-brand-200/80">Procesos productivos</dd></div>
        <div><dt class="text-2xl font-bold text-white" data-count="100" data-suffix="%">0</dt><dd class="text-sm text-brand-200/80">A tu medida</dd></div>
        <div><dt class="text-2xl font-bold text-white">Food</dt><dd class="text-sm text-brand-200/80">Grado alimentario</dd></div>
      </dl>
    </div>
  </div>
  <svg class="pointer-events-none absolute inset-x-0 bottom-0 z-20 w-full" style="height:42px" viewBox="0 0 1440 42" preserveAspectRatio="none" fill="#ffffff" aria-hidden="true">
    <path d="M0,42 L1440,42 L1440,20 C1080,46 360,-6 0,22 Z"></path>
  </svg>
</section>

<!-- CINTA DE PRODUCTOS -->
<section class="border-y border-brand-100 bg-white py-5" aria-hidden="true">
  <div class="marquee-mask overflow-hidden">
    <div class="flex w-max animate-marquee items-center gap-8 pr-8">
      <?php
      $kw = ['Termoformado','Inyección','Film Flexible','Potes','Bolsas Doypack','Pouch','Tapas','Cucharas dosificadoras','Bandejas','Rollos','Grado alimentario'];
      for ($r = 0; $r < 2; $r++):
        foreach ($kw as $w): ?>
          <span class="flex shrink-0 items-center gap-8 text-lg font-semibold">
            <span class="text-brand-700"><?= $w ?></span>
            <svg class="h-2 w-2 text-accent-500" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
          </span>
      <?php endforeach; endfor; ?>
    </div>
  </div>
</section>

<!-- NUESTRO SISTEMA (fila de íconos) -->
<section class="container-page py-16 lg:py-20">
  <div class="reveal mx-auto max-w-2xl text-center">
    <span class="eyebrow">Nuestro sistema</span>
    <h2 class="mt-4 text-2xl font-bold uppercase tracking-tight sm:text-3xl">Todo en un solo lugar</h2>
  </div>
  <div class="mt-12 grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4">
    <?php foreach ($data['system'] as $s): ?>
      <div class="reveal text-center">
        <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-brand-50 text-brand-600"><?= marple_icon($s['icon'], 'h-8 w-8') ?></span>
        <h3 class="mt-5 text-base font-bold uppercase tracking-wide"><?= $s['title'] ?></h3>
        <p class="mt-2 text-sm leading-relaxed text-brand-800/70"><?= $s['desc'] ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- SECTORES / INDUSTRIAS -->
<section class="bg-brand-50 py-20 lg:py-24">
  <div class="container-page">
    <div class="reveal mx-auto max-w-2xl text-center">
      <span class="eyebrow">Sectores</span>
      <h2 class="mt-4 text-3xl font-bold uppercase tracking-tight sm:text-4xl">Industrias que atendemos</h2>
      <p class="mt-4 text-brand-800/70">Soluciones de packaging para cada segmento de la industria alimentaria.</p>
    </div>
    <div class="mt-14 grid grid-cols-2 gap-4 md:grid-cols-3">
      <?php foreach ($data['sectors'] as $s): ?>
        <article class="reveal group relative aspect-[4/3] overflow-hidden rounded-2xl shadow-card">
          <img src="<?= $s['img'] ?>" alt="Packaging para <?= htmlspecialchars($s['name']) ?>" loading="lazy"
               class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
          <div class="absolute inset-0 bg-gradient-to-t from-brand-950/85 via-brand-950/25 to-transparent"></div>
          <h3 class="absolute inset-x-0 bottom-0 p-5 text-base font-bold uppercase tracking-wide text-white sm:text-lg"><?= htmlspecialchars($s['name']) ?></h3>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SERVICIOS -->
<section class="container-page py-20 lg:py-28">
  <div class="reveal mx-auto max-w-2xl text-center">
    <span class="eyebrow">Nuestros servicios</span>
    <h2 class="mt-4 text-3xl font-bold uppercase tracking-tight sm:text-4xl">Procesos que dan forma a tus ideas</h2>
    <p class="mt-4 text-brand-800/70">Tecnología y control de calidad en cada etapa, desde la lámina hasta el producto terminado.</p>
  </div>

  <div class="mt-14 grid gap-6 md:grid-cols-3">
    <?php foreach ($data['services'] as $key => $s): ?>
      <article class="card card-hover reveal group flex flex-col overflow-hidden p-0">
        <div class="relative h-44 overflow-hidden">
          <img src="<?= $s['img'] ?>" alt="<?= $s['title'] ?> — Marple Chile" loading="lazy"
               class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
          <span class="absolute left-4 top-4 grid h-11 w-11 place-items-center rounded-xl bg-white/95 text-brand-600 shadow-card backdrop-blur">
            <?= marple_icon($s['icon'], 'h-6 w-6') ?>
          </span>
        </div>
        <div class="flex flex-1 flex-col p-7">
          <h3 class="text-xl font-bold"><?= $s['title'] ?></h3>
          <p class="mt-3 flex-1 text-sm leading-relaxed text-brand-800/70"><?= $s['desc'] ?></p>
          <a href="servicios.php#<?= $key ?>" class="mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 hover:text-brand-800">
            Ver más <?= marple_icon('arrow', 'h-4 w-4') ?>
          </a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<!-- GALERÍA DE PRODUCTOS -->
<section class="relative overflow-hidden bg-brand-950 py-20 lg:py-28">
  <svg class="pointer-events-none absolute inset-x-0 top-0 z-10 w-full" style="height:46px" viewBox="0 0 1440 46" preserveAspectRatio="none" fill="#ffffff" aria-hidden="true">
    <path d="M0,0 L1440,0 L1440,24 C1080,50 360,-4 0,24 Z"></path>
  </svg>
  <div class="container-page relative z-10">
    <div class="reveal mx-auto max-w-2xl text-center">
      <span class="eyebrow bg-white/10 text-brand-100 ring-white/15">Productos</span>
      <h2 class="mt-4 text-3xl font-bold uppercase tracking-tight text-white sm:text-4xl">Envases que ya fabricamos</h2>
      <p class="mt-4 text-brand-100/70">Potes, bolsas, tapas, cucharas y films flexibles desarrollados a la medida de cada cliente.</p>
    </div>

    <div class="mt-14 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
      <?php foreach ($data['products'] as $p): ?>
        <figure tabindex="0" role="button" aria-label="Ampliar imagen: <?= htmlspecialchars($p['name']) ?>"
                data-lightbox="<?= $p['img'] ?>" data-alt="<?= htmlspecialchars($p['name']) ?>"
                class="reveal group relative aspect-square cursor-pointer overflow-hidden rounded-2xl bg-white ring-1 ring-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent-400">
          <img src="<?= $p['img'] ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy"
               class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
          <span class="absolute right-3 top-3 grid h-9 w-9 place-items-center rounded-full bg-white/85 text-brand-700 opacity-0 shadow-card backdrop-blur transition group-hover:opacity-100">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14ZM11 8v6M8 11h6"/></svg>
          </span>
          <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-brand-950/90 to-transparent p-4 pt-10">
            <span class="text-sm font-semibold text-white"><?= htmlspecialchars($p['name']) ?></span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>

    <div class="reveal mt-10 text-center">
      <a href="contacto.php" class="btn-primary">Quiero un envase como estos <?= marple_icon('arrow', 'h-4 w-4') ?></a>
    </div>
  </div>
  <svg class="pointer-events-none absolute inset-x-0 bottom-0 z-10 w-full" style="height:46px" viewBox="0 0 1440 46" preserveAspectRatio="none" fill="#eff8fb" aria-hidden="true">
    <path d="M0,46 L1440,46 L1440,22 C1080,-4 360,50 0,22 Z"></path>
  </svg>
</section>

<!-- VALORES / POR QUÉ NOSOTROS -->
<section class="bg-brand-50 py-20 lg:py-28">
  <div class="container-page">
    <div class="grid gap-12 lg:grid-cols-[1fr_1.5fr] lg:items-start">
      <div class="reveal lg:sticky lg:top-28">
        <span class="eyebrow">Por qué Marple</span>
        <h2 class="mt-4 text-3xl font-bold uppercase tracking-tight sm:text-4xl">Comprometidos con crear soluciones de calidad</h2>
        <p class="mt-4 text-brand-800/70">
          Desarrollamos una mejora continua en todos nuestros productos, manteniendo altos estándares
          de seguridad, calidad, inocuidad y legalidad.
        </p>
        <a href="nosotros.php" class="btn-primary mt-8">Conoce más sobre nosotros <?= marple_icon('arrow', 'h-4 w-4') ?></a>
      </div>

      <div class="grid gap-5 sm:grid-cols-2">
        <?php foreach ($data['values'] as $v): ?>
          <div class="card reveal">
            <span class="grid h-11 w-11 place-items-center rounded-xl bg-accent-500/10 text-accent-600"><?= marple_icon($v['icon'], 'h-6 w-6') ?></span>
            <h3 class="mt-4 text-base font-bold"><?= $v['title'] ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-brand-800/70"><?= $v['desc'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<?php
$faqs = [
  ['q' => '¿Fabrican envases a medida?', 'a' => 'Sí. Desarrollamos packaging plástico bajo la marca de nuestros clientes, según sus especificaciones técnicas.'],
  ['q' => '¿Qué procesos de fabricación manejan?', 'a' => 'Trabajamos termoformado, inyección y film flexible, cubriendo desde bandejas y potes hasta bolsas y láminas con barrera.'],
  ['q' => '¿Sus envases son aptos para alimentos?', 'a' => 'Sí. Mantenemos altos estándares de seguridad, calidad, inocuidad y legalidad para la industria alimentaria.'],
  ['q' => '¿Dónde están ubicados?', 'a' => 'En Sta. Marta 1051, Maipú, Región Metropolitana. Atendemos de lunes a viernes.'],
  ['q' => '¿Cómo solicito una cotización?', 'a' => 'Completa el formulario de contacto o escríbenos por WhatsApp con los detalles de tu proyecto y te responderemos con una propuesta.'],
];
?>
<section class="container-page py-20 lg:py-24">
  <div class="grid gap-12 lg:grid-cols-[1fr_1.4fr] lg:items-start">
    <div class="reveal lg:sticky lg:top-28">
      <span class="eyebrow">Preguntas frecuentes</span>
      <h2 class="mt-4 text-3xl font-bold uppercase tracking-tight sm:text-4xl">Resolvemos tus dudas</h2>
      <p class="mt-4 text-brand-800/70">¿Tienes otra consulta? Escríbenos y te respondemos a la brevedad.</p>
      <a href="contacto.php" class="btn-primary mt-6">Contáctanos <?= marple_icon('arrow', 'h-4 w-4') ?></a>
    </div>

    <div class="space-y-3">
      <?php foreach ($faqs as $f): ?>
        <div class="faq-item card reveal overflow-hidden !p-0">
          <button type="button" class="faq-trigger flex w-full items-center justify-between gap-4 p-6 text-left" aria-expanded="false">
            <span class="text-base font-semibold"><?= $f['q'] ?></span>
            <svg class="faq-chevron h-5 w-5 shrink-0 text-brand-500 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
          </button>
          <div class="faq-panel">
            <div class="min-h-0 overflow-hidden px-6 pb-6 text-sm leading-relaxed text-brand-800/75"><?= $f['a'] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script type="application/ld+json">
<?= json_encode([
  '@context' => 'https://schema.org',
  '@type'    => 'FAQPage',
  'mainEntity' => array_map(function ($f) {
    return [
      '@type' => 'Question',
      'name'  => $f['q'],
      'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ];
  }, $faqs),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
</script>

<!-- CTA -->
<section class="container-page py-20 lg:py-24">
  <div class="reveal relative overflow-hidden rounded-3xl bg-brand-900 px-8 py-14 text-center sm:px-16">
    <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-brand-500/30 blur-3xl" aria-hidden="true"></div>
    <div class="absolute -bottom-16 -left-16 h-64 w-64 rounded-full bg-accent-500/20 blur-3xl" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-2xl">
      <h2 class="text-3xl font-bold text-white sm:text-4xl">¿Listo para crear tu envase a medida?</h2>
      <p class="mt-4 text-brand-100/80">Cuéntanos tu proyecto y te ayudamos a desarrollar la solución plástica ideal para tu marca.</p>
      <div class="mt-8 flex flex-wrap justify-center gap-4">
        <a href="contacto.php" class="btn-primary">Contáctanos</a>
        <a href="https://wa.me/<?php $c = require __DIR__ . '/includes/config.php'; echo $c['contact']['phone_raw']; ?>" target="_blank" rel="noopener" class="btn-light">Escríbenos por WhatsApp</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
