<?php
$current    = 'trabaja';
$page_title = 'Trabaja con nosotros';
$page_desc  = 'Únete al equipo de Marple Chile. Postula a nuestras vacantes o envíanos tu CV para futuras oportunidades en packaging plástico.';
$config     = require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/icons.php';

/* ---------------------------------------------------------------------------
 * Vacantes disponibles. Edita este arreglo para publicar o quitar cargos.
 * Si lo dejas vacío ([]), la página invita igualmente a enviar el CV.
 * ------------------------------------------------------------------------- */
$jobs = [
    ['title' => 'Operario/a de Producción', 'type' => 'Jornada completa', 'place' => 'Maipú, RM',
     'desc' => 'Operación de líneas de termoformado e inyección, cumpliendo estándares de calidad e inocuidad.'],
    ['title' => 'Técnico/a de Mantención',  'type' => 'Jornada completa', 'place' => 'Maipú, RM',
     'desc' => 'Mantención preventiva y correctiva de maquinaria industrial de la planta.'],
    ['title' => 'Analista de Calidad e Inocuidad', 'type' => 'Jornada completa', 'place' => 'Maipú, RM',
     'desc' => 'Control de procesos y aseguramiento de los estándares de seguridad alimentaria.'],
];

$benefits = [
    ['title' => 'Capacitación constante', 'desc' => 'Te formamos en mejora continua y buenas prácticas de manufactura.', 'icon' => 'spark'],
    ['title' => 'Ambiente seguro',        'desc' => 'Trabajamos en un entorno que prioriza la seguridad laboral.', 'icon' => 'shield'],
    ['title' => 'Estabilidad y crecimiento', 'desc' => 'Proyéctate en una empresa en constante desarrollo.', 'icon' => 'target'],
    ['title' => 'Buen equipo humano',     'desc' => 'Súmate a un equipo colaborativo con comunicación abierta.', 'icon' => 'users'],
];

/* ---------------------------------------------------------------------------
 * Procesamiento del formulario de postulación (POST + carga de CV).
 * ------------------------------------------------------------------------- */
$errors = [];
$sent   = false;
$old    = ['nombre' => '', 'email' => '', 'telefono' => '', 'cargo' => '', 'mensaje' => ''];

$allowed_ext = ['pdf', 'doc', 'docx'];
$max_size    = 5 * 1024 * 1024; // 5 MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim($_POST[$k] ?? '');
    }
    $honeypot = trim($_POST['website'] ?? '');

    if ($old['nombre'] === '')                                 $errors['nombre'] = 'Indícanos tu nombre.';
    if ($old['email'] === '')                                  $errors['email']  = 'Indícanos tu correo.';
    elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) $errors['email']  = 'El correo no es válido.';

    // Validación del CV (obligatorio)
    $cv = $_FILES['cv'] ?? null;
    if (!$cv || $cv['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['cv'] = 'Adjunta tu CV (PDF o Word).';
    } elseif ($cv['error'] !== UPLOAD_ERR_OK) {
        $errors['cv'] = 'Hubo un problema al subir el archivo. Intenta nuevamente.';
    } else {
        $ext = strtolower(pathinfo($cv['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_ext, true)) $errors['cv'] = 'Formato no permitido. Usa PDF, DOC o DOCX.';
        elseif ($cv['size'] > $max_size)         $errors['cv'] = 'El archivo supera los 5 MB.';
    }

    if (empty($errors) && $honeypot === '') {
        // Guarda el CV en uploads/cv con un nombre seguro
        $dir = __DIR__ . '/uploads/cv';
        if (!is_dir($dir)) { @mkdir($dir, 0755, true); }
        $safe = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($cv['name'], PATHINFO_FILENAME));
        $fname = $safe . '_' . substr(md5($cv['name'] . $cv['size']), 0, 8) . '.' . $ext;
        $dest = $dir . '/' . $fname;
        @move_uploaded_file($cv['tmp_name'], $dest);

        // Notificación por correo
        $to      = $config['contact']['email'];
        $subject = 'Nueva postulación — ' . $old['nombre'] . ($old['cargo'] ? ' (' . $old['cargo'] . ')' : '');
        $body    = "Nombre: {$old['nombre']}\nEmail: {$old['email']}\nTeléfono: {$old['telefono']}\n"
                 . "Cargo de interés: {$old['cargo']}\n\nMensaje:\n{$old['mensaje']}\n\nCV: uploads/cv/{$fname}\n";
        $headers = "From: Web Marple <no-reply@marplechile.cl>\r\nReply-To: {$old['email']}\r\n"
                 . "Content-Type: text/plain; charset=UTF-8\r\n";
        @mail($to, $subject, $body, $headers);

        $sent = true;
        $old  = ['nombre' => '', 'email' => '', 'telefono' => '', 'cargo' => '', 'mensaje' => ''];
    }
}

require __DIR__ . '/includes/header.php';

if (!function_exists('field_class')) {
    function field_class(array $errors, string $name): string
    {
        $base = 'w-full rounded-xl border bg-white px-4 py-3 text-sm text-brand-950 placeholder:text-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400';
        return $base . (isset($errors[$name]) ? ' border-red-400' : ' border-brand-100 focus:border-brand-400');
    }
}

/* Encabezado con imagen */
$ph_eyebrow  = 'Trabaja con nosotros';
$ph_title    = 'Construyamos juntos las soluciones del futuro';
$ph_subtitle = 'En Marple valoramos a nuestro talento humano. Súmate a un equipo que crece, capacita y cuida cada detalle de lo que fabrica.';
$ph_img      = 'assets/img/Banner-nosotros-1536x320.jpg';
require __DIR__ . '/includes/page-header.php';
?>

<!-- POR QUÉ TRABAJAR EN MARPLE -->
<section class="container-page py-20 lg:py-24">
  <div class="reveal mx-auto max-w-2xl text-center">
    <span class="eyebrow">Por qué Marple</span>
    <h2 class="mt-4 text-3xl font-bold sm:text-4xl">Un buen lugar para crecer</h2>
    <p class="mt-4 text-brand-800/70">Creemos que las mejores soluciones nacen de un equipo motivado y bien preparado.</p>
  </div>
  <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <?php foreach ($benefits as $b): ?>
      <div class="card card-hover reveal">
        <span class="grid h-12 w-12 place-items-center rounded-2xl bg-brand-50 text-brand-600"><?= marple_icon($b['icon'], 'h-6 w-6') ?></span>
        <h3 class="mt-5 text-lg font-bold"><?= $b['title'] ?></h3>
        <p class="mt-2 text-sm leading-relaxed text-brand-800/70"><?= $b['desc'] ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- VACANTES -->
<section class="bg-brand-50/60 py-20 lg:py-24">
  <div class="container-page">
    <div class="reveal mx-auto max-w-2xl text-center">
      <span class="eyebrow">Vacantes</span>
      <h2 class="mt-4 text-3xl font-bold sm:text-4xl">Posiciones abiertas</h2>
    </div>

    <div class="mx-auto mt-12 max-w-3xl space-y-4">
      <?php if (empty($jobs)): ?>
        <div class="card reveal text-center">
          <p class="text-brand-800/75">Por ahora no tenemos vacantes publicadas, pero siempre estamos atentos a nuevo talento.
          Envíanos tu CV con el formulario de abajo y te contactaremos cuando surja una oportunidad.</p>
        </div>
      <?php else: ?>
        <?php foreach ($jobs as $j): ?>
          <article class="card card-hover reveal flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
              <h3 class="text-lg font-bold"><?= htmlspecialchars($j['title']) ?></h3>
              <p class="mt-1 text-sm text-brand-800/70"><?= htmlspecialchars($j['desc']) ?></p>
              <div class="mt-3 flex flex-wrap gap-2 text-xs">
                <span class="inline-flex items-center gap-1 rounded-full bg-brand-50 px-2.5 py-1 font-semibold text-brand-600"><?= marple_icon('clock', 'h-3.5 w-3.5') ?> <?= htmlspecialchars($j['type']) ?></span>
                <span class="inline-flex items-center gap-1 rounded-full bg-brand-50 px-2.5 py-1 font-semibold text-brand-600"><?= marple_icon('pin', 'h-3.5 w-3.5') ?> <?= htmlspecialchars($j['place']) ?></span>
              </div>
            </div>
            <a href="#postular" data-cargo="<?= htmlspecialchars($j['title']) ?>" class="btn-primary shrink-0 js-apply">Postular <?= marple_icon('arrow', 'h-4 w-4') ?></a>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- FORMULARIO DE POSTULACIÓN -->
<section id="postular" class="container-page py-20 lg:py-24">
  <div class="mx-auto max-w-2xl">
    <div class="reveal text-center">
      <span class="eyebrow">Postula</span>
      <h2 class="mt-4 text-3xl font-bold sm:text-4xl">Envíanos tu CV</h2>
      <p class="mt-4 text-brand-800/70">Completa el formulario y adjunta tu currículum. Te contactaremos si tu perfil calza con nuestras necesidades.</p>
    </div>

    <?php if ($sent): ?>
      <div class="reveal mt-8 flex items-start gap-3 rounded-2xl bg-accent-500/10 p-6 ring-1 ring-accent-500/30">
        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-accent-500 text-white"><?= marple_icon('check', 'h-6 w-6') ?></span>
        <div>
          <h3 class="text-lg font-bold text-brand-950">¡Postulación recibida!</h3>
          <p class="mt-1 text-sm text-brand-800/75">Gracias por tu interés en Marple. Revisaremos tu CV y te contactaremos si avanzas en el proceso.</p>
        </div>
      </div>
    <?php endif; ?>

    <form method="post" action="trabaja.php#postular" enctype="multipart/form-data" class="reveal mt-8 card space-y-5" novalidate>
      <div class="hidden" aria-hidden="true">
        <label>No rellenar <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
      </div>

      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <label for="nombre" class="mb-1.5 block text-sm font-semibold">Nombre completo *</label>
          <input id="nombre" name="nombre" type="text" value="<?= htmlspecialchars($old['nombre']) ?>" class="<?= field_class($errors, 'nombre') ?>" placeholder="Tu nombre">
          <?php if (isset($errors['nombre'])): ?><p class="mt-1 text-xs text-red-500"><?= $errors['nombre'] ?></p><?php endif; ?>
        </div>
        <div>
          <label for="telefono" class="mb-1.5 block text-sm font-semibold">Teléfono</label>
          <input id="telefono" name="telefono" type="tel" value="<?= htmlspecialchars($old['telefono']) ?>" class="<?= field_class($errors, 'telefono') ?>" placeholder="+56 9 ...">
        </div>
      </div>

      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <label for="email" class="mb-1.5 block text-sm font-semibold">Correo electrónico *</label>
          <input id="email" name="email" type="email" value="<?= htmlspecialchars($old['email']) ?>" class="<?= field_class($errors, 'email') ?>" placeholder="tucorreo@ejemplo.cl">
          <?php if (isset($errors['email'])): ?><p class="mt-1 text-xs text-red-500"><?= $errors['email'] ?></p><?php endif; ?>
        </div>
        <div>
          <label for="cargo" class="mb-1.5 block text-sm font-semibold">Cargo de interés</label>
          <select id="cargo" name="cargo" class="<?= field_class($errors, 'cargo') ?>">
            <option value="">Selecciona…</option>
            <?php foreach ($jobs as $j): ?>
              <option value="<?= htmlspecialchars($j['title']) ?>" <?= $old['cargo'] === $j['title'] ? 'selected' : '' ?>><?= htmlspecialchars($j['title']) ?></option>
            <?php endforeach; ?>
            <option value="Postulación espontánea" <?= $old['cargo'] === 'Postulación espontánea' ? 'selected' : '' ?>>Postulación espontánea</option>
          </select>
        </div>
      </div>

      <div>
        <label for="cv" class="mb-1.5 block text-sm font-semibold">Currículum (PDF o Word) *</label>
        <input id="cv" name="cv" type="file" accept=".pdf,.doc,.docx"
               class="w-full rounded-xl border <?= isset($errors['cv']) ? 'border-red-400' : 'border-brand-100' ?> bg-white px-4 py-2.5 text-sm text-brand-800 file:mr-4 file:rounded-lg file:border-0 file:bg-brand-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-brand-700">
        <?php if (isset($errors['cv'])): ?><p class="mt-1 text-xs text-red-500"><?= $errors['cv'] ?></p><?php else: ?><p class="mt-1 text-xs text-brand-800/50">Máximo 5 MB.</p><?php endif; ?>
      </div>

      <div>
        <label for="mensaje" class="mb-1.5 block text-sm font-semibold">Mensaje (opcional)</label>
        <textarea id="mensaje" name="mensaje" rows="4" class="<?= field_class($errors, 'mensaje') ?>" placeholder="Cuéntanos brevemente sobre ti y tu experiencia…"><?= htmlspecialchars($old['mensaje']) ?></textarea>
      </div>

      <button type="submit" class="btn-primary w-full sm:w-auto">Enviar postulación <?= marple_icon('arrow', 'h-4 w-4') ?></button>
      <p class="text-xs text-brand-800/60">* Campos obligatorios. Tus datos se usan únicamente para procesos de selección de Marple Chile.</p>
    </form>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
