<?php
require_once __DIR__ . '/../includes/admin.php';
$admin_page = 'posts';
$admin_title = 'Blog';
require_login();

$action = $_GET['action'] ?? 'list';
$id = (int) ($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    if (($_POST['op'] ?? '') === 'delete') {
        db()->prepare('DELETE FROM posts WHERE id = ?')->execute([(int) $_POST['id']]);
        flash('Artículo eliminado.');
        redirect('posts.php');
    }
    $eid = (int) ($_POST['id'] ?? 0);
    $current_img = '';
    if ($eid) {
        $st = db()->prepare('SELECT image FROM posts WHERE id = ?');
        $st->execute([$eid]);
        $current_img = $st->fetchColumn() ?: '';
    }
    $data = [
        'title'        => trim($_POST['title'] ?? ''),
        'category'     => trim($_POST['category'] ?? ''),
        'excerpt'      => trim($_POST['excerpt'] ?? ''),
        'content'      => trim($_POST['content'] ?? ''),
        'image'        => $current_img,
        'published_at' => ($_POST['published_at'] ?? '') ?: null,
        'is_active'    => isset($_POST['is_active']) ? 1 : 0,
    ];
    $errors = [];
    if ($data['title'] === '') $errors[] = 'El título es obligatorio.';
    try {
        $data['image'] = handle_image_upload('image', $current_img);
    } catch (Throwable $ex) {
        $errors[] = $ex->getMessage();
    }
    if (!$errors) {
        if ($eid > 0) {
            $st = db()->prepare('UPDATE posts SET title=?,category=?,excerpt=?,content=?,image=?,published_at=?,is_active=? WHERE id=?');
            $st->execute([...array_values($data), $eid]);
            flash('Artículo actualizado.');
        } else {
            $st = db()->prepare('INSERT INTO posts (title,category,excerpt,content,image,published_at,is_active) VALUES (?,?,?,?,?,?,?)');
            $st->execute(array_values($data));
            flash('Artículo creado.');
        }
        redirect('posts.php');
    }
    $post = $data + ['id' => $eid];
    $action = 'form';
}

require __DIR__ . '/includes/header.php';

if ($action === 'new' || $action === 'edit' || $action === 'form') {
    if (!isset($post)) {
        if ($action === 'edit' && $id) {
            $st = db()->prepare('SELECT * FROM posts WHERE id = ?');
            $st->execute([$id]);
            $post = $st->fetch() ?: null;
        }
        $post = $post ?? ['id' => 0, 'title' => '', 'category' => '', 'excerpt' => '', 'content' => '', 'image' => '', 'published_at' => date('Y-m-d'), 'is_active' => 1];
    }
    $inp = 'w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400';
    ?>
    <div class="mb-6 flex items-center gap-3">
      <a href="posts.php" class="text-sm text-brand-600 hover:underline">← Blog</a>
      <h1 class="font-display text-2xl font-extrabold"><?= $post['id'] ? 'Editar' : 'Nuevo' ?> artículo</h1>
    </div>
    <?php if (!empty($errors)): ?>
      <div class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700 ring-1 ring-red-200"><?php foreach ($errors as $err): ?><div><?= e($err) ?></div><?php endforeach; ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" class="max-w-2xl space-y-5 rounded-2xl bg-white p-6 shadow-card ring-1 ring-brand-50 sm:p-8">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int) $post['id'] ?>">
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Título *</label>
        <input name="title" type="text" value="<?= e($post['title']) ?>" class="<?= $inp ?>">
      </div>
      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <label class="mb-1.5 block text-sm font-semibold">Categoría</label>
          <input name="category" type="text" value="<?= e($post['category']) ?>" class="<?= $inp ?>" placeholder="Procesos, Inocuidad…">
        </div>
        <div>
          <label class="mb-1.5 block text-sm font-semibold">Fecha</label>
          <input name="published_at" type="date" value="<?= e($post['published_at']) ?>" class="<?= $inp ?>">
        </div>
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Extracto</label>
        <textarea name="excerpt" rows="2" class="<?= $inp ?>" placeholder="Resumen corto que aparece en la tarjeta"><?= e($post['excerpt']) ?></textarea>
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Contenido</label>
        <textarea name="content" rows="6" class="<?= $inp ?>"><?= e($post['content']) ?></textarea>
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Imagen</label>
        <?php if (!empty($post['image'])): ?>
          <img src="../<?= e($post['image']) ?>" alt="" class="mb-2 h-28 w-44 rounded-lg object-cover ring-1 ring-brand-100">
        <?php endif; ?>
        <input name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm text-brand-800 file:mr-4 file:rounded-lg file:border-0 file:bg-brand-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-brand-700">
        <p class="mt-1 text-xs text-brand-800/50">JPG, PNG o WEBP (máx. 6 MB).<?= $post['id'] ? ' Deja vacío para mantener la actual.' : '' ?></p>
      </div>
      <label class="flex items-center gap-2.5 text-sm font-medium">
        <input type="checkbox" name="is_active" <?= $post['is_active'] ? 'checked' : '' ?> class="h-4 w-4 rounded border-brand-200 text-brand-600">
        Publicado
      </label>
      <div class="flex gap-3">
        <button class="btn-primary">Guardar</button>
        <a href="posts.php" class="btn-light">Cancelar</a>
      </div>
    </form>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

$posts = db()->query('SELECT * FROM posts ORDER BY published_at DESC, id DESC')->fetchAll();
?>
<div class="mb-6 flex items-center justify-between">
  <h1 class="font-display text-2xl font-extrabold">Blog</h1>
  <a href="posts.php?action=new" class="btn-primary">+ Nuevo artículo</a>
</div>
<?php if (!$posts): ?>
  <p class="rounded-2xl bg-white p-8 text-center text-sm text-brand-800/60 shadow-card ring-1 ring-brand-50">Aún no hay artículos.</p>
<?php else: ?>
  <div class="overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-brand-50">
    <table class="w-full text-left text-sm">
      <thead class="border-b border-brand-50 text-xs uppercase tracking-wide text-brand-800/50">
        <tr><th class="px-5 py-3">Artículo</th><th class="px-5 py-3">Categoría</th><th class="px-5 py-3">Fecha</th><th class="px-5 py-3">Estado</th><th class="px-5 py-3 text-right">Acciones</th></tr>
      </thead>
      <tbody class="divide-y divide-brand-50">
        <?php foreach ($posts as $p): ?>
          <tr class="hover:bg-brand-50/40">
            <td class="px-5 py-3">
              <div class="flex items-center gap-3">
                <?php if (!empty($p['image'])): ?><img src="../<?= e($p['image']) ?>" alt="" class="h-10 w-14 shrink-0 rounded object-cover ring-1 ring-brand-100"><?php endif; ?>
                <span class="font-semibold"><?= e($p['title']) ?></span>
              </div>
            </td>
            <td class="px-5 py-3 text-brand-800/70"><?= e($p['category']) ?></td>
            <td class="px-5 py-3 text-brand-800/70"><?= e($p['published_at']) ?></td>
            <td class="px-5 py-3"><?= $p['is_active'] ? '<span class="rounded-full bg-accent-500/10 px-2.5 py-1 text-xs font-semibold text-accent-700">Publicado</span>' : '<span class="rounded-full bg-brand-100 px-2.5 py-1 text-xs font-semibold text-brand-800/60">Borrador</span>' ?></td>
            <td class="px-5 py-3">
              <div class="flex justify-end gap-2">
                <a href="posts.php?action=edit&id=<?= $p['id'] ?>" class="rounded-lg bg-brand-50 px-3 py-1.5 text-xs font-semibold text-brand-700 hover:bg-brand-100">Editar</a>
                <form method="post" onsubmit="return confirm('¿Eliminar este artículo?')">
                  <?= csrf_field() ?><input type="hidden" name="op" value="delete"><input type="hidden" name="id" value="<?= $p['id'] ?>">
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
