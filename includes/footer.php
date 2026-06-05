<?php
/** Pie de página compartido + cierre del documento. */
$config = $config ?? require __DIR__ . '/config.php';
?>
</main>

<footer class="mt-24 border-t border-brand-100 bg-brand-950 text-brand-100">
  <div class="container-page grid gap-12 py-16 md:grid-cols-2 lg:grid-cols-4">
    <!-- Marca -->
    <div class="lg:col-span-1">
      <span class="inline-flex rounded-xl bg-white px-4 py-2.5 shadow-card">
        <img src="assets/img/Logo_MARPLE-150x90.png" alt="Marple Chile — Plastic Solution" class="h-9 w-auto" width="150" height="90">
      </span>
      <p class="mt-4 max-w-xs text-sm leading-relaxed text-brand-200/80">
        Tu partner de packagings plásticos a tu medida, con altos estándares de seguridad, calidad e inocuidad para la industria alimentaria.
      </p>
      <a href="<?= $config['social']['instagram']['url'] ?>" target="_blank" rel="noopener" class="mt-5 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/20">
        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41a3.7 3.7 0 0 1-1.38-.9 3.7 3.7 0 0 1-.9-1.38c-.16-.42-.36-1.06-.41-2.23C2.17 15.58 2.16 15.2 2.16 12s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41C8.42 2.17 8.8 2.16 12 2.16Zm0 1.62c-3.15 0-3.5.01-4.74.07-1.14.05-1.76.24-2.17.4-.55.21-.94.47-1.35.88-.41.41-.67.8-.88 1.35-.16.41-.35 1.03-.4 2.17-.06 1.24-.07 1.59-.07 4.74s.01 3.5.07 4.74c.05 1.14.24 1.76.4 2.17.21.55.47.94.88 1.35.41.41.8.67 1.35.88.41.16 1.03.35 2.17.4 1.24.06 1.59.07 4.74.07s3.5-.01 4.74-.07c1.14-.05 1.76-.24 2.17-.4.55-.21.94-.47 1.35-.88.41-.41.67-.8.88-1.35.16-.41.35-1.03.4-2.17.06-1.24.07-1.59.07-4.74s-.01-3.5-.07-4.74c-.05-1.14-.24-1.76-.4-2.17a3.6 3.6 0 0 0-.88-1.35 3.6 3.6 0 0 0-1.35-.88c-.41-.16-1.03-.35-2.17-.4-1.24-.06-1.59-.07-4.74-.07Zm0 2.76a5.3 5.3 0 1 1 0 10.6 5.3 5.3 0 0 1 0-10.6Zm0 1.62a3.68 3.68 0 1 0 0 7.36 3.68 3.68 0 0 0 0-7.36Zm5.49-2.9a1.24 1.24 0 1 1 0 2.48 1.24 1.24 0 0 1 0-2.48Z"/></svg>
        <?= $config['social']['instagram']['label'] ?>
      </a>
    </div>

    <!-- Navegación -->
    <div>
      <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Navegación</h3>
      <ul class="mt-4 space-y-3 text-sm">
        <?php foreach ($config['nav'] as $item): ?>
          <li><a href="<?= $item['href'] ?>" class="text-brand-200/80 transition hover:text-white"><?= $item['label'] ?></a></li>
        <?php endforeach; ?>
        <li><a href="nosotros.php#politica" class="text-brand-200/80 transition hover:text-white">Política de calidad</a></li>
      </ul>
    </div>

    <!-- Contacto -->
    <div>
      <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Contacto</h3>
      <ul class="mt-4 space-y-3 text-sm text-brand-200/80">
        <li><a href="https://www.google.com/maps" class="hover:text-white"><?= htmlspecialchars($config['contact']['address']) ?></a></li>
        <li><a href="mailto:<?= $config['contact']['email'] ?>" class="hover:text-white"><?= $config['contact']['email'] ?></a></li>
        <li><a href="tel:+<?= $config['contact']['phone_raw'] ?>" class="hover:text-white"><?= $config['contact']['phone'] ?></a></li>
        <li><a href="<?= $config['contact']['map_url'] ?>" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-brand-300 hover:text-white">Ver mapa →</a></li>
      </ul>
    </div>

    <!-- Horario -->
    <div>
      <h3 class="text-sm font-semibold uppercase tracking-wider text-white">Horario de atención</h3>
      <ul class="mt-4 space-y-3 text-sm text-brand-200/80">
        <?php foreach ($config['hours'] as $day => $time): ?>
          <li class="flex items-center justify-between gap-4">
            <span><?= $day ?></span>
            <span class="font-medium text-white/90"><?= $time ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="border-t border-white/10">
    <div class="container-page flex flex-col items-center justify-between gap-3 py-6 text-xs text-brand-200/70 sm:flex-row">
      <p>Marple Plastic Solution Group S.A. &copy; <?= date('Y') ?>. Todos los derechos reservados.</p>
      <p>Hecho en Chile · Plastic Solution</p>
    </div>
  </div>
</footer>

<!-- Lightbox (galería) -->
<div id="lightbox" class="lightbox" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Imagen ampliada">
  <button type="button" class="lightbox-close" aria-label="Cerrar">
    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
  </button>
  <img id="lightbox-img" src="" alt="">
</div>

<!-- Barra de progreso de lectura -->
<div id="scroll-progress" class="scroll-progress" role="presentation"></div>

<!-- Volver arriba -->
<button id="to-top" type="button" class="to-top" aria-label="Volver arriba">
  <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/></svg>
</button>

<!-- Botón flotante de WhatsApp -->
<a href="https://wa.me/<?= $config['contact']['phone_raw'] ?>?text=Hola%20Marple%2C%20quiero%20cotizar%20un%20envase"
   target="_blank" rel="noopener"
   class="group fixed bottom-5 right-5 z-50 inline-flex items-center gap-2 rounded-full bg-[#25D366] px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-black/20 transition hover:scale-105 hover:bg-[#1ebe5d]"
   aria-label="Escríbenos por WhatsApp">
  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M.057 24l1.687-6.163a11.867 11.867 0 0 1-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 0 1 8.413 3.488 11.824 11.824 0 0 1 3.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 0 1-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 0 0 1.51 5.26l-.999 3.648 3.477-.911zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
  <span class="hidden sm:inline">WhatsApp</span>
</a>

<script src="assets/js/main.js" defer></script>
</body>
</html>
