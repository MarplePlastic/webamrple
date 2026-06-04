<?php
$current    = 'contacto';
$page_title = 'Contacto';
$page_desc  = 'Contáctanos para cotizar tu envase plástico a medida. Marple Chile, Maipú, Región Metropolitana.';
$config     = require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/icons.php';

/* --- Procesamiento del formulario (POST al mismo archivo) --- */
$errors = [];
$sent   = false;
$old    = ['nombre' => '', 'email' => '', 'telefono' => '', 'mensaje' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim($_POST[$k] ?? '');
    }
    // Honeypot anti-spam (campo oculto que los bots rellenan)
    $honeypot = trim($_POST['website'] ?? '');

    if ($old['nombre'] === '')                                   $errors['nombre']   = 'Indícanos tu nombre.';
    if ($old['email'] === '')                                    $errors['email']    = 'Indícanos tu correo.';
    elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL))   $errors['email']    = 'El correo no es válido.';
    if (strlen($old['mensaje']) < 10)                            $errors['mensaje']  = 'Cuéntanos un poco más (mín. 10 caracteres).';

    if (empty($errors) && $honeypot === '') {
        $to      = $config['contact']['email'];
        $subject = 'Nueva solicitud de contacto — ' . $old['nombre'];
        $body    = "Nombre: {$old['nombre']}\n"
                 . "Email: {$old['email']}\n"
                 . "Teléfono: {$old['telefono']}\n\n"
                 . "Mensaje:\n{$old['mensaje']}\n";
        $headers = "From: Web Marple <no-reply@marplechile.cl>\r\n"
                 . "Reply-To: {$old['email']}\r\n"
                 . "Content-Type: text/plain; charset=UTF-8\r\n";

        // @ evita warnings si el servidor de correo no está configurado en local.
        @mail($to, $subject, $body, $headers);
        $sent = true;
        $old  = ['nombre' => '', 'email' => '', 'telefono' => '', 'mensaje' => ''];
    }
}

require __DIR__ . '/includes/header.php';

/** Pequeño helper para clases de input con/ sin error. */
function field_class(array $errors, string $name): string
{
    $base = 'w-full rounded-xl border bg-white px-4 py-3 text-sm text-brand-950 placeholder:text-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400';
    return $base . (isset($errors[$name]) ? ' border-red-400' : ' border-brand-100 focus:border-brand-400');
}
?>

<!-- PAGE HEADER -->
<?php
$ph_eyebrow  = 'Contacto';
$ph_title    = 'Conversemos sobre tu proyecto';
$ph_subtitle = 'Cuéntanos qué necesitas y nuestro equipo te responderá con una propuesta a tu medida.';
$ph_img      = 'assets/img/Banner-Contacto-1536x320.jpg';
require __DIR__ . '/includes/page-header.php';
?>

<section class="container-page py-20 lg:py-24">
  <div class="grid gap-12 lg:grid-cols-[1.2fr_1fr]">
    <!-- FORMULARIO -->
    <div class="reveal">
      <?php if ($sent): ?>
        <div class="flex items-start gap-3 rounded-2xl bg-accent-500/10 p-6 ring-1 ring-accent-500/30">
          <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-accent-500 text-white"><?= marple_icon('check', 'h-6 w-6') ?></span>
          <div>
            <h2 class="text-lg font-bold text-brand-950">¡Mensaje enviado!</h2>
            <p class="mt-1 text-sm text-brand-800/75">Gracias por escribirnos. Te responderemos a la brevedad.</p>
          </div>
        </div>
      <?php endif; ?>

      <form method="post" action="contacto.php#form" id="form" class="<?= $sent ? 'mt-8' : '' ?> card space-y-5" novalidate>
        <h2 class="text-xl font-bold">Solicita tu cotización</h2>

        <!-- Honeypot (oculto para humanos) -->
        <div class="hidden" aria-hidden="true">
          <label>No rellenar <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
          <div>
            <label for="nombre" class="mb-1.5 block text-sm font-semibold">Nombre *</label>
            <input id="nombre" name="nombre" type="text" value="<?= htmlspecialchars($old['nombre']) ?>" class="<?= field_class($errors, 'nombre') ?>" placeholder="Tu nombre">
            <?php if (isset($errors['nombre'])): ?><p class="mt-1 text-xs text-red-500"><?= $errors['nombre'] ?></p><?php endif; ?>
          </div>
          <div>
            <label for="telefono" class="mb-1.5 block text-sm font-semibold">Teléfono</label>
            <input id="telefono" name="telefono" type="tel" value="<?= htmlspecialchars($old['telefono']) ?>" class="<?= field_class($errors, 'telefono') ?>" placeholder="+56 9 ...">
          </div>
        </div>

        <div>
          <label for="email" class="mb-1.5 block text-sm font-semibold">Correo electrónico *</label>
          <input id="email" name="email" type="email" value="<?= htmlspecialchars($old['email']) ?>" class="<?= field_class($errors, 'email') ?>" placeholder="tucorreo@empresa.cl">
          <?php if (isset($errors['email'])): ?><p class="mt-1 text-xs text-red-500"><?= $errors['email'] ?></p><?php endif; ?>
        </div>

        <div>
          <label for="mensaje" class="mb-1.5 block text-sm font-semibold">Mensaje *</label>
          <textarea id="mensaje" name="mensaje" rows="5" class="<?= field_class($errors, 'mensaje') ?>" placeholder="Cuéntanos sobre tu proyecto: tipo de envase, volumen estimado, plazos..."><?= htmlspecialchars($old['mensaje']) ?></textarea>
          <?php if (isset($errors['mensaje'])): ?><p class="mt-1 text-xs text-red-500"><?= $errors['mensaje'] ?></p><?php endif; ?>
        </div>

        <button type="submit" class="btn-primary w-full sm:w-auto">Enviar mensaje <?= marple_icon('arrow', 'h-4 w-4') ?></button>
        <p class="text-xs text-brand-800/60">* Campos obligatorios. Tus datos se usan únicamente para responder tu consulta.</p>
      </form>
    </div>

    <!-- INFO -->
    <aside class="reveal space-y-4">
      <div class="card">
        <h2 class="text-lg font-bold">Datos de contacto</h2>
        <ul class="mt-5 space-y-4 text-sm">
          <li class="flex gap-3">
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600"><?= marple_icon('pin', 'h-5 w-5') ?></span>
            <span><span class="block font-semibold">Oficinas</span><span class="text-brand-800/70"><?= htmlspecialchars($config['contact']['address']) ?></span></span>
          </li>
          <li class="flex gap-3">
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600"><?= marple_icon('mail', 'h-5 w-5') ?></span>
            <span><span class="block font-semibold">Correo</span><a href="mailto:<?= $config['contact']['email'] ?>" class="text-brand-600 hover:underline"><?= $config['contact']['email'] ?></a></span>
          </li>
          <li class="flex gap-3">
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600"><?= marple_icon('phone', 'h-5 w-5') ?></span>
            <span><span class="block font-semibold">Teléfono</span><a href="tel:+<?= $config['contact']['phone_raw'] ?>" class="text-brand-600 hover:underline"><?= $config['contact']['phone'] ?></a></span>
          </li>
          <li class="flex gap-3">
            <span class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600"><?= marple_icon('clock', 'h-5 w-5') ?></span>
            <span>
              <span class="block font-semibold">Horario</span>
              <span class="text-brand-800/70">
                <?php foreach ($config['hours'] as $day => $time): ?>
                  <span class="block"><?= $day ?>: <?= $time ?></span>
                <?php endforeach; ?>
              </span>
            </span>
          </li>
        </ul>
      </div>

      <div class="overflow-hidden rounded-2xl shadow-card ring-1 ring-brand-50">
        <iframe
          title="Ubicación de Marple Chile"
          src="<?= $config['contact']['map_embed'] ?>"
          width="100%" height="260" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </aside>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
