<?php
require_once __DIR__ . '/../includes/admin.php';
$admin_page = 'jobs';
$admin_title = 'Vacantes';
require_login();

$action = $_GET['action'] ?? 'list';
$id = (int) ($_GET['id'] ?? 0);

/* ----- Guardar / eliminar ----- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    if (($_POST['op'] ?? '') === 'delete') {
        $st = db()->prepare('DELETE FROM jobs WHERE id = ?');
        $st->execute([(int) $_POST['id']]);
        flash('Vacante eliminada.');
        redirect('jobs.php');
    }
    $data = [
        'title'       => trim($_POST['title'] ?? ''),
        'type'        => trim($_POST['type'] ?? ''),
        'place'       => trim($_POST['place'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'sort_order'  => (int) ($_POST['sort_order'] ?? 0),
        'is_active'   => isset($_POST['is_active']) ? 1 : 0,
    ];
    $errors = [];
    if ($data['title'] === '')       $errors[] = 'El título es obligatorio.';
    if ($data['description'] === '') $errors[] = 'La descripción es obligatoria.';

    if (!$errors) {
        $eid = (int) ($_POST['id'] ?? 0);
        if ($eid > 0) {
            $st = db()->prepare('UPDATE jobs SET title=?,type=?,place=?,description=?,sort_order=?,is_active=? WHERE id=?');
            $st->execute([...array_values($data), $eid]);
            flash('Vacante actualizada.');
        } else {
            $st = db()->prepare('INSERT INTO jobs (title,type,place,description,sort_order,is_active) VALUES (?,?,?,?,?,?)');
            $st->execute(array_values($data));
            flash('Vacante creada.');
        }
        redirect('jobs.php');
    }
    // si hay errores, volvemos al formulario con los datos
    $job = $data + ['id' => (int) ($_POST['id'] ?? 0)];
    $action = 'form';
}

require __DIR__ . '/includes/header.php';

/* ====== FORMULARIO ====== */
if ($action === 'new' || $action === 'edit' || $action === 'form') {
    if (!isset($job)) {
        if ($action === 'edit' && $id) {
            $st = db()->prepare('SELECT * FROM jobs WHERE id = ?');
            $st->execute([$id]);
            $job = $st->fetch() ?: null;
        }
        $job = $job ?? ['id' => 0, 'title' => '', 'type' => 'Jornada completa', 'place' => 'Maipú, RM', 'description' => '', 'sort_order' => 0, 'is_active' => 1];
    }
    $inp = 'w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400';
    ?>
    <div class="mb-6 flex items-center gap-3">
      <a href="jobs.php" class="text-sm text-brand-600 hover:underline">← Vacantes</a>
      <h1 class="font-display text-2xl font-extrabold"><?= $job['id'] ? 'Editar' : 'Nueva' ?> vacante</h1>
    </div>
    <?php if (!empty($errors)): ?>
      <div class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700 ring-1 ring-red-200">
        <?php foreach ($errors as $err): ?><div><?= e($err) ?></div><?php endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="post" class="max-w-2xl space-y-5 rounded-2xl bg-white p-6 shadow-card ring-1 ring-brand-50 sm:p-8">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int) $job['id'] ?>">
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Título *</label>
        <input name="title" type="text" value="<?= e($job['title']) ?>" class="<?= $inp ?>">
      </div>
      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <label class="mb-1.5 block text-sm font-semibold">Jornada</label>
          <input name="type" type="text" value="<?= e($job['type']) ?>" class="<?= $inp ?>" placeholder="Jornada completa">
        </div>
        <div>
          <label class="mb-1.5 block text-sm font-semibold">Ubicación</label>
          <input name="place" type="text" value="<?= e($job['place']) ?>" class="<?= $inp ?>" placeholder="Maipú, RM">
        </div>
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Descripción *</label>
        <textarea name="description" rows="4" class="<?= $inp ?>"><?= e($job['description']) ?></textarea>
      </div>
      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <label class="mb-1.5 block text-sm font-semibold">Orden</label>
          <input name="sort_order" type="number" value="<?= (int) $job['sort_order'] ?>" class="<?= $inp ?>">
        </div>
        <label class="flex items-center gap-2.5 pt-7 text-sm font-medium">
          <input type="checkbox" name="is_active" <?= $job['is_active'] ? 'checked' : '' ?> class="h-4 w-4 rounded border-brand-200 text-brand-600">
          Visible en el sitio
        </label>
      </div>
      <div class="flex gap-3">
        <button class="btn-primary">Guardar</button>
        <a href="jobs.php" class="btn-light">Cancelar</a>
      </div>
    </form>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

/* ====== LISTADO ====== */
$jobs = db()->query('SELECT * FROM jobs ORDER BY sort_order, id')->fetchAll();
?>
<div class="mb-6 flex items-center justify-between">
  <h1 class="font-display text-2xl font-extrabold">Vacantes</h1>
  <a href="jobs.php?action=new" class="btn-primary">+ Nueva vacante</a>
</div>

<?php if (!$jobs): ?>
  <p class="rounded-2xl bg-white p-8 text-center text-sm text-brand-800/60 shadow-card ring-1 ring-brand-50">Aún no hay vacantes. Crea la primera.</p>
<?php else: ?>
  <div class="overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-brand-50">
    <table class="w-full text-left text-sm">
      <thead class="border-b border-brand-50 text-xs uppercase tracking-wide text-brand-800/50">
        <tr><th class="px-5 py-3">Título</th><th class="px-5 py-3">Jornada</th><th class="px-5 py-3">Estado</th><th class="px-5 py-3 text-right">Acciones</th></tr>
      </thead>
      <tbody class="divide-y divide-brand-50">
        <?php foreach ($jobs as $j): ?>
          <tr class="hover:bg-brand-50/40">
            <td class="px-5 py-3 font-semibold"><?= e($j['title']) ?><div class="text-xs font-normal text-brand-800/50"><?= e($j['place']) ?></div></td>
            <td class="px-5 py-3 text-brand-800/70"><?= e($j['type']) ?></td>
            <td class="px-5 py-3">
              <?php if ($j['is_active']): ?><span class="rounded-full bg-accent-500/10 px-2.5 py-1 text-xs font-semibold text-accent-700">Visible</span>
              <?php else: ?><span class="rounded-full bg-brand-100 px-2.5 py-1 text-xs font-semibold text-brand-800/60">Oculta</span><?php endif; ?>
            </td>
            <td class="px-5 py-3">
              <div class="flex justify-end gap-2">
                <a href="jobs.php?action=edit&id=<?= $j['id'] ?>" class="rounded-lg bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-700 hover:bg-brand-100">Editar</a>
                <form method="post" onsubmit="return confirm('¿Eliminar esta vacante?')">
                  <?= csrf_field() ?>
                  <input type="hidden" name="op" value="delete"><input type="hidden" name="id" value="<?= $j['id'] ?>">
                  <button class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">Eliminar</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
