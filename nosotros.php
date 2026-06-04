<?php
$current    = 'nosotros';
$page_title = 'Nosotros';
$page_desc  = 'Conoce a Marple Chile: misión, visión y valores. Tu partner de packagings plásticos a tu medida para la industria alimentaria.';
$data       = require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/icons.php';
require __DIR__ . '/includes/header.php';
?>

<!-- PAGE HEADER -->
<?php
$ph_eyebrow  = 'Nosotros';
$ph_title    = 'Comprometidos con crear soluciones de calidad';
$ph_subtitle = 'En Marple somos tu partner de packagings plásticos a tu medida. Trabajamos cada proyecto bajo la marca de nuestros clientes, con foco en la calidad y la eficiencia operacional.';
$ph_img      = 'assets/img/Banner-nosotros-1536x320.jpg';
require __DIR__ . '/includes/page-header.php';
?>

<!-- MISIÓN / VISIÓN -->
<section class="container-page py-20 lg:py-24">
  <div class="grid gap-6 lg:grid-cols-2">
    <article class="card reveal border-t-4 border-brand-500">
      <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-50 text-brand-600"><?= marple_icon('target', 'h-6 w-6') ?></span>
      <h2 class="mt-5 text-2xl font-bold">Misión</h2>
      <p class="mt-3 leading-relaxed text-brand-800/75">
        Constantemente desarrollamos una mejora continua en todos nuestros productos bajo las marcas
        de nuestros clientes, manteniendo altos estándares de seguridad, calidad, inocuidad y legalidad,
        enfocándonos en optimizar la calidad y la eficiencia operacional.
      </p>
    </article>
    <article class="card reveal border-t-4 border-accent-500">
      <span class="grid h-12 w-12 place-items-center rounded-2xl bg-accent-500/10 text-accent-600"><?= marple_icon('eye', 'h-6 w-6') ?></span>
      <h2 class="mt-5 text-2xl font-bold">Visión</h2>
      <p class="mt-3 leading-relaxed text-brand-800/75">
        Ser reconocida nacionalmente como una empresa competitiva que cumple las normativas vigentes
        e implementa altos estándares internacionales de seguridad, calidad, inocuidad y legalidad
        en sus productos para la industria alimentaria.
      </p>
    </article>
  </div>
</section>

<!-- VALORES -->
<section class="bg-brand-50/60 py-20 lg:py-24">
  <div class="container-page">
    <div class="reveal mx-auto max-w-2xl text-center">
      <span class="eyebrow">Nuestros compromisos</span>
      <h2 class="mt-4 text-3xl font-bold sm:text-4xl">Los valores que nos definen</h2>
      <p class="mt-4 text-brand-800/70">Cada decisión que tomamos parte desde estos pilares.</p>
    </div>
    <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php foreach ($data['values'] as $v): ?>
        <div class="card card-hover reveal">
          <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-50 text-brand-600"><?= marple_icon($v['icon'], 'h-6 w-6') ?></span>
          <h3 class="mt-5 text-lg font-bold"><?= $v['title'] ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-brand-800/70"><?= $v['desc'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="container-page py-20 lg:py-24">
  <div class="reveal flex flex-col items-center justify-between gap-6 rounded-3xl bg-brand-900 px-8 py-12 text-center sm:flex-row sm:text-left">
    <div>
      <h2 class="text-2xl font-bold text-white">Trabajemos juntos en tu próximo envase</h2>
      <p class="mt-2 text-brand-100/80">Desarrollamos la solución plástica ideal para tu marca.</p>
    </div>
    <a href="contacto.php" class="btn-primary shrink-0">Solicitar cotización <?= marple_icon('arrow', 'h-4 w-4') ?></a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
