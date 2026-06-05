<?php
require_once __DIR__ . '/../includes/admin.php';
$admin_page = 'users';
$admin_title = 'Usuarios';
require_login();

$me = current_admin();
$action = $_GET['action'] ?? 'list';
$id = (int) ($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $op = $_POST['op'] ?? '';

    // ----- Eliminar -----
    if ($op === 'delete') {
        $del = (int) $_POST['id'];
        if ($del === (int) $me['id']) {
            flash('No puedes eliminar tu propia cuenta.', 'error');
        } elseif (admins_count() <= 1) {
            flash('Debe quedar al menos un usuario.', 'error');
        } else {
            db()->prepare('DELETE FROM admins WHERE id = ?')->execute([$del]);
            flash('Usuario eliminado.');
        }
        redirect('users.php');
    }

    // ----- Crear / editar -----
    $eid      = (int) ($_POST['id'] ?? 0);
    $username = trim($_POST['username'] ?? '');
    $pass     = (string) ($_POST['password'] ?? '');
    $pass2    = (string) ($_POST['password2'] ?? '');
    $errors   = [];

    if (strlen($username) < 3) {
        $errors[] = 'El usuario debe tener al menos 3 caracteres.';
    } else {
        $st = db()->prepare('SELECT id FROM admins WHERE username = ? AND id <> ?');
        $st->execute([$username, $eid]);
        if ($st->fetch()) {
            $errors[] = 'Ya existe un usuario con ese nombre.';
        }
    }
    // Contraseña: obligatoria al crear; opcional al editar
    if ($eid === 0 || $pass !== '') {
        if (strlen($pass) < 8)      $errors[] = 'La contraseña debe tener al menos 8 caracteres.';
        elseif ($pass !== $pass2)   $errors[] = 'Las contraseñas no coinciden.';
    }

    if (!$errors) {
        if ($eid > 0) {
            if ($pass !== '') {
                $st = db()->prepare('UPDATE admins SET username = ?, password_hash = ? WHERE id = ?');
                $st->execute([$username, password_hash($pass, PASSWORD_DEFAULT), $eid]);
            } else {
                $st = db()->prepare('UPDATE admins SET username = ? WHERE id = ?');
                $st->execute([$username, $eid]);
            }
            if ($eid === (int) $me['id']) {
                $_SESSION['admin']['username'] = $username;
            }
            flash('Usuario actualizado.');
        } else {
            $st = db()->prepare('INSERT INTO admins (username, password_hash) VALUES (?, ?)');
            $st->execute([$username, password_hash($pass, PASSWORD_DEFAULT)]);
            flash('Usuario creado.');
        }
        redirect('users.php');
    }
    $user = ['id' => $eid, 'username' => $username];
    $action = 'form';
}

require __DIR__ . '/includes/header.php';

/* ====== FORMULARIO ====== */
if ($action === 'new' || $action === 'edit' || $action === 'form') {
    if (!isset($user)) {
        if ($action === 'edit' && $id) {
            $st = db()->prepare('SELECT id, username FROM admins WHERE id = ?');
            $st->execute([$id]);
            $user = $st->fetch() ?: null;
        }
        $user = $user ?? ['id' => 0, 'username' => ''];
    }
    $editing = $user['id'] > 0;
    $inp = 'w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400';
    ?>
    <div class="mb-6 flex items-center gap-3">
      <a href="users.php" class="text-sm text-brand-600 hover:underline">← Usuarios</a>
      <h1 class="font-display text-2xl font-extrabold"><?= $editing ? 'Editar' : 'Nuevo' ?> usuario</h1>
    </div>
    <?php if (!empty($errors)): ?>
      <div class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700 ring-1 ring-red-200"><?php foreach ($errors as $err): ?><div><?= e($err) ?></div><?php endforeach; ?></div>
    <?php endif; ?>
    <form method="post" autocomplete="off" class="max-w-md space-y-5 rounded-2xl bg-white p-6 shadow-card ring-1 ring-brand-50 sm:p-8">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int) $user['id'] ?>">
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Usuario *</label>
        <input name="username" type="text" value="<?= e($user['username']) ?>" class="<?= $inp ?>" placeholder="ej. juan.perez">
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Contraseña <?= $editing ? '<span class="font-normal text-brand-800/50">(deja vacío para no cambiarla)</span>' : '<span class="font-normal text-brand-800/50">(mín. 8)</span>' ?></label>
        <input name="password" type="password" class="<?= $inp ?>">
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Repetir contraseña</label>
        <input name="password2" type="password" class="<?= $inp ?>">
      </div>
      <div class="flex gap-3">
        <button class="btn-primary">Guardar</button>
        <a href="users.php" class="btn-light">Cancelar</a>
      </div>
    </form>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

/* ====== LISTADO ====== */
$users = db()->query('SELECT id, username, created_at FROM admins ORDER BY id')->fetchAll();
?>
<div class="mb-6 flex items-center justify-between">
  <div>
    <h1 class="font-display text-2xl font-extrabold">Usuarios</h1>
    <p class="mt-1 text-sm text-brand-800/70">Personas con acceso al panel para administrar el contenido.</p>
  </div>
  <a href="users.php?action=new" class="btn-primary">+ Nuevo usuario</a>
</div>

<div class="overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-brand-50">
  <table class="w-full text-left text-sm">
    <thead class="border-b border-brand-50 text-xs uppercase tracking-wide text-brand-800/50">
      <tr><th class="px-5 py-3">Usuario</th><th class="px-5 py-3">Creado</th><th class="px-5 py-3 text-right">Acciones</th></tr>
    </thead>
    <tbody class="divide-y divide-brand-50">
      <?php foreach ($users as $u): ?>
        <tr class="hover:bg-brand-50/40">
          <td class="px-5 py-3 font-semibold">
            <?= e($u['username']) ?>
            <?php if ((int) $u['id'] === (int) $me['id']): ?><span class="ml-2 rounded-full bg-brand-50 px-2 py-0.5 text-xs font-semibold text-brand-600">tú</span><?php endif; ?>
          </td>
          <td class="px-5 py-3 text-brand-800/60"><?= e(substr((string) $u['created_at'], 0, 10)) ?></td>
          <td class="px-5 py-3">
            <div class="flex justify-end gap-2">
              <a href="users.php?action=edit&id=<?= $u['id'] ?>" class="rounded-lg bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-700 hover:bg-brand-100">Editar</a>
              <?php if ((int) $u['id'] !== (int) $me['id']): ?>
                <form method="post" onsubmit="return confirm('¿Eliminar este usuario?')">
                  <?= csrf_field() ?><input type="hidden" name="op" value="delete"><input type="hidden" name="id" value="<?= $u['id'] ?>">
                  <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">Eliminar</button>
                </form>
              <?php endif; ?>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
