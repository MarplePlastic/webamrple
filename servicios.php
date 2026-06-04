<?php
$current    = 'servicios';
$page_title = 'Servicios';
$page_desc  = 'Servicios de Marple Chile: termoformado, inyección y film flexible para packagings plásticos a medida.';
$data       = require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/header.php';
?>

<!-- PAGE HEADER -->
<?php
$ph_eyebrow  = 'Servicios';
$ph_title    = 'Procesos productivos para cada necesidad';
$ph_subtitle = 'Contamos con tres líneas de producción especializadas que cubren desde el moldeo de piezas técnicas hasta films flexibles para conservación de alimentos.';
$ph_img      = 'assets/img/servicios-1536x320.jpg';
require __DIR__ . '/includes/page-header.php';
?>

<!-- SERVICIOS DETALLE -->
<section class="container-page py-20 lg:py-24">
  <div class="space-y-6">
    <?php $i = 0; foreach ($data['services'] as $key => $s): $reverse = $i % 2 === 1; $i++; ?>
      <article id="<?= $key ?>" class="card card-hover reveal scroll-mt-28 overflow-hidden p-0">
        <div class="grid items-stretch gap-0 md:grid-cols-2">
          <!-- Visual -->
          <div class="relative min-h-[240px] overflow-hidden bg-brand-900 <?= $reverse ? 'md:order-2' : '' ?>">
            <img src="<?= $s['img'] ?>" alt="<?= $s['title'] ?> — Marple Chile" loading="lazy"
                 class="absolute inset-0 h-full w-full object-cover">
            <span class="absolute left-5 top-5 grid h-12 w-12 place-items-center rounded-2xl bg-white/90 text-brand-700 shadow-card backdrop-blur">
              <?= marple_icon($s['icon'], 'h-6 w-6') ?>
            </span>
          </div>
          <!-- Texto -->
          <div class="p-8 sm:p-10">
            <span class="text-xs font-bold uppercase tracking-wider text-brand-500">Servicio 0<?= $i ?></span>
            <h2 class="mt-2 text-2xl font-bold sm:text-3xl"><?= $s['title'] ?></h2>
            <p class="mt-4 leading-relaxed text-brand-800/75"><?= $s['desc'] ?></p>
            <ul class="mt-6 space-y-2.5">
              <?php foreach ($s['features'] as $f): ?>
                <li class="flex items-center gap-2.5 text-sm font-medium text-brand-800">
                  <span class="grid h-5 w-5 place-items-center rounded-full bg-accent-500/15 text-accent-600"><?= marple_icon('check', 'h-3.5 w-3.5') ?></span>
                  <?= $f ?>
                </li>
              <?php endforeach; ?>
            </ul>
            <a href="contacto.php" class="btn-primary mt-8">Cotizar <?= $s['title'] ?> <?= marple_icon('arrow', 'h-4 w-4') ?></a>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>

<!-- PROCESO -->
<section class="bg-brand-50/60 py-20 lg:py-24">
  <div class="container-page">
    <div class="reveal mx-auto max-w-2xl text-center">
      <span class="eyebrow">Cómo trabajamos</span>
      <h2 class="mt-4 text-3xl font-bold sm:text-4xl">De la idea al producto terminado</h2>
    </div>
    <div class="mt-14 grid gap-6 md:grid-cols-4">
      <?php
      $steps = [
        ['n' => '01', 't' => 'Briefing', 'd' => 'Conversamos tu proyecto y especificaciones técnicas.'],
        ['n' => '02', 't' => 'Desarrollo', 'd' => 'Diseñamos el envase a medida bajo tu marca.'],
        ['n' => '03', 't' => 'Producción', 'd' => 'Fabricamos con controles rigurosos de calidad.'],
        ['n' => '04', 't' => 'Entrega', 'd' => 'Despachamos cumpliendo los estándares acordados.'],
      ];
      foreach ($steps as $st): ?>
        <div class="card reveal">
          <span class="font-display text-3xl font-extrabold text-brand-200"><?= $st['n'] ?></span>
          <h3 class="mt-3 text-lg font-bold"><?= $st['t'] ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-brand-800/70"><?= $st['d'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
