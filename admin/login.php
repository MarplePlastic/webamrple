<?php
require_once __DIR__ . '/../includes/admin.php';
admin_boot();
if (current_admin()) {
    redirect('index.php');
}
if (admins_count() === 0) {
    redirect('setup.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    // Límite simple de intentos por sesión
    $_SESSION['login_tries'] = ($_SESSION['login_tries'] ?? 0) + 1;
    if ($_SESSION['login_tries'] > 8) {
        $error = 'Demasiados intentos. Espera un momento y recarga la página.';
    } else {
        $u = trim($_POST['username'] ?? '');
        $p = (string) ($_POST['password'] ?? '');
        $st = db()->prepare('SELECT * FROM admins WHERE username = ? LIMIT 1');
        $st->execute([$u]);
        $row = $st->fetch();
        if ($row && password_verify($p, $row['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin'] = ['id' => (int) $row['id'], 'username' => $row['username']];
            unset($_SESSION['login_tries']);
            redirect('index.php');
        }
        $error = 'Usuario o contraseña incorrectos.';
    }
}

$auth_title = 'Iniciar sesión';
$auth_sub   = 'Panel de administración de Marple';
require __DIR__ . '/includes/auth_shell.php';
?>
<form method="post" class="space-y-4">
  <?= csrf_field() ?>
  <?php if ($error): ?><p class="rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700 ring-1 ring-red-200"><?= e($error) ?></p><?php endif; ?>
  <div>
    <label class="mb-1.5 block text-sm font-semibold">Usuario</label>
    <input name="username" type="text" required autofocus value="<?= e($_POST['username'] ?? '') ?>" class="w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400">
  </div>
  <div>
    <label class="mb-1.5 block text-sm font-semibold">Contraseña</label>
    <input name="password" type="password" required class="w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400">
  </div>
  <button class="btn-primary w-full">Entrar</button>
</form>
<?php require __DIR__ . '/includes/auth_shell_end.php'; ?>
