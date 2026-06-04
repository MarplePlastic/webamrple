<?php
/**
 * Encabezado de páginas interiores, con imagen de fondo opcional y overlay.
 * Variables esperadas antes de incluir:
 *   $ph_eyebrow, $ph_title, $ph_subtitle, $ph_img (ruta de imagen de fondo)
 */
?>
<section class="relative overflow-hidden bg-brand-950">
  <?php if (!empty($ph_img)): ?>
    <img src="<?= $ph_img ?>" alt="" aria-hidden="true" class="absolute inset-0 h-full w-full object-cover opacity-40">
    <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/85 to-brand-900/50"></div>
  <?php endif; ?>
  <div class="container-page relative py-16 lg:py-24">
    <?php if (!empty($ph_eyebrow)): ?>
      <span class="eyebrow bg-white/10 text-brand-100 ring-white/15"><?= $ph_eyebrow ?></span>
    <?php endif; ?>
    <h1 class="reveal mt-5 max-w-3xl font-display text-4xl font-extrabold leading-tight text-white sm:text-5xl"><?= $ph_title ?></h1>
    <?php if (!empty($ph_subtitle)): ?>
      <p class="reveal mt-5 max-w-2xl text-lg text-brand-100/80"><?= $ph_subtitle ?></p>
    <?php endif; ?>
  </div>
</section>
