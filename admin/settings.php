<?php
require_once __DIR__ . '/../includes/admin.php';
$admin_page = 'settings';
$admin_title = 'Ajustes';
require_login();

$fields = [
    'contact_phone'     => ['Teléfono (visible)', '+56 9 ...'],
    'contact_phone_raw' => ['Teléfono para WhatsApp/llamada (solo números)', '56995042803'],
    'contact_email'     => ['Correo de contacto', 'contacto@marplechile.cl'],
    'contact_address'   => ['Dirección', 'Sta. Marta 1051, Maipú, Región Metropolitana'],
    'hours_weekday'     => ['Horario lunes a jueves', '8:00 — 18:00'],
    'hours_friday'      => ['Horario viernes', '8:00 — 16:00'],
    'hours_weekend'     => ['Horario sábado y domingo', 'Cerrado'],
    'instagram_url'     => ['URL de Instagram', 'https://www.instagram.com/...'],
    'instagram_label'   => ['Usuario de Instagram', '@marpleplasticsolutiongroup'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $st = db()->prepare('INSERT INTO settings (name, value) VALUES (?, ?) ON DUPLICATE KEY UPDATE value = VALUES(value)');
    foreach (array_keys($fields) as $key) {
        $st->execute([$key, trim($_POST[$key] ?? '')]);
    }
    flash('Datos de contacto actualizados.');
    redirect('settings.php');
}

$current = settings();
$inp = 'w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400';
require __DIR__ . '/includes/header.php';
?>
<div class="mb-6">
  <h1 class="font-display text-2xl font-extrabold">Datos de contacto y horario</h1>
  <p class="mt-1 text-sm text-brand-800/70">Estos datos aparecen en el pie de página, la página de contacto y el botón de WhatsApp.</p>
</div>

<form method="post" class="max-w-2xl space-y-5 rounded-2xl bg-white p-6 shadow-card ring-1 ring-brand-50 sm:p-8">
  <?= csrf_field() ?>
  <?php foreach ($fields as $key => [$label, $ph]): ?>
    <div>
      <label class="mb-1.5 block text-sm font-semibold"><?= e($label) ?></label>
      <input name="<?= e($key) ?>" type="text" value="<?= e($current[$key] ?? '') ?>" placeholder="<?= e($ph) ?>" class="<?= $inp ?>">
    </div>
  <?php endforeach; ?>
  <button class="btn-primary">Guardar cambios</button>
</form>
<?php require __DIR__ . '/includes/footer.php'; ?>
