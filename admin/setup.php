<?php
/** Crea el primer administrador. Sólo funciona si aún no existe ninguno. */
require_once __DIR__ . '/../includes/admin.php';
admin_boot();

if (admins_count() > 0) {
    redirect('login.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $u  = trim($_POST['username'] ?? '');
    $p  = (string) ($_POST['password'] ?? '');
    $p2 = (string) ($_POST['password2'] ?? '');

    if (strlen($u) < 3)            $error = 'El usuario debe tener al menos 3 caracteres.';
    elseif (strlen($p) < 8)        $error = 'La contraseña debe tener al menos 8 caracteres.';
    elseif ($p !== $p2)            $error = 'Las contraseñas no coinciden.';

    if ($error === '') {
        $st = db()->prepare('INSERT INTO admins (username, password_hash) VALUES (?, ?)');
        $st->execute([$u, password_hash($p, PASSWORD_DEFAULT)]);
        flash('Administrador creado. Ya puedes iniciar sesión.');
        redirect('login.php');
    }
}

$auth_title = 'Crear administrador';
$auth_sub   = 'Primer acceso: crea la cuenta de administrador del panel.';
require __DIR__ . '/includes/auth_shell.php';
?>
<form method="post" class="space-y-4" autocomplete="off">
  <?= csrf_field() ?>
  <?php if ($error): ?><p class="rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700 ring-1 ring-red-200"><?= e($error) ?></p><?php endif; ?>
  <div>
    <label class="mb-1.5 block text-sm font-semibold">Usuario</label>
    <input name="username" type="text" value="<?= e($_POST['username'] ?? '') ?>" required class="w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400">
  </div>
  <div>
    <label class="mb-1.5 block text-sm font-semibold">Contraseña <span class="font-normal text-brand-800/50">(mín. 8)</span></label>
    <input name="password" type="password" required class="w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400">
  </div>
  <div>
    <label class="mb-1.5 block text-sm font-semibold">Repetir contraseña</label>
    <input name="password2" type="password" required class="w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400">
  </div>
  <button class="btn-primary w-full">Crear y continuar</button>
</form>
<?php require __DIR__ . '/includes/auth_shell_end.php'; ?>
