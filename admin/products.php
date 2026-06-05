<?php
require_once __DIR__ . '/../includes/admin.php';
$admin_page = 'products';
$admin_title = 'Productos';
require_login();

$action = $_GET['action'] ?? 'list';
$id = (int) ($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    if (($_POST['op'] ?? '') === 'delete') {
        db()->prepare('DELETE FROM products WHERE id = ?')->execute([(int) $_POST['id']]);
        flash('Producto eliminado.');
        redirect('products.php');
    }
    $eid = (int) ($_POST['id'] ?? 0);
    $current_img = '';
    if ($eid) {
        $st = db()->prepare('SELECT image FROM products WHERE id = ?');
        $st->execute([$eid]);
        $current_img = $st->fetchColumn() ?: '';
    }
    $data = [
        'name'       => trim($_POST['name'] ?? ''),
        'image'      => $current_img,
        'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        'is_active'  => isset($_POST['is_active']) ? 1 : 0,
    ];
    $errors = [];
    if ($data['name'] === '') $errors[] = 'El nombre es obligatorio.';
    try {
        $data['image'] = handle_image_upload('image', $current_img);
    } catch (Throwable $ex) {
        $errors[] = $ex->getMessage();
    }
    if (!$errors && $data['image'] === '') $errors[] = 'Sube una imagen del producto.';

    if (!$errors) {
        if ($eid > 0) {
            $st = db()->prepare('UPDATE products SET name=?,image=?,sort_order=?,is_active=? WHERE id=?');
            $st->execute([...array_values($data), $eid]);
            flash('Producto actualizado.');
        } else {
            $st = db()->prepare('INSERT INTO products (name,image,sort_order,is_active) VALUES (?,?,?,?)');
            $st->execute(array_values($data));
            flash('Producto creado.');
        }
        redirect('products.php');
    }
    $product = $data + ['id' => $eid];
    $action = 'form';
}

require __DIR__ . '/includes/header.php';

if ($action === 'new' || $action === 'edit' || $action === 'form') {
    if (!isset($product)) {
        if ($action === 'edit' && $id) {
            $st = db()->prepare('SELECT * FROM products WHERE id = ?');
            $st->execute([$id]);
            $product = $st->fetch() ?: null;
        }
        $product = $product ?? ['id' => 0, 'name' => '', 'image' => '', 'sort_order' => 0, 'is_active' => 1];
    }
    $inp = 'w-full rounded-xl border border-brand-100 bg-white px-4 py-2.5 text-sm focus:border-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-400';
    ?>
    <div class="mb-6 flex items-center gap-3">
      <a href="products.php" class="text-sm text-brand-600 hover:underline">← Productos</a>
      <h1 class="font-display text-2xl font-extrabold"><?= $product['id'] ? 'Editar' : 'Nuevo' ?> producto</h1>
    </div>
    <?php if (!empty($errors)): ?>
      <div class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm text-red-700 ring-1 ring-red-200"><?php foreach ($errors as $err): ?><div><?= e($err) ?></div><?php endforeach; ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" class="max-w-xl space-y-5 rounded-2xl bg-white p-6 shadow-card ring-1 ring-brand-50 sm:p-8">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Nombre *</label>
        <input name="name" type="text" value="<?= e($product['name']) ?>" class="<?= $inp ?>">
      </div>
      <div>
        <label class="mb-1.5 block text-sm font-semibold">Imagen <?= $product['id'] ? '' : '*' ?></label>
        <?php if (!empty($product['image'])): ?>
          <img src="../<?= e($product['image']) ?>" alt="" class="mb-2 h-32 w-32 rounded-lg object-cover ring-1 ring-brand-100">
        <?php endif; ?>
        <input name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm text-brand-800 file:mr-4 file:rounded-lg file:border-0 file:bg-brand-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-brand-700">
        <p class="mt-1 text-xs text-brand-800/50">JPG, PNG o WEBP (máx. 6 MB).<?= $product['id'] ? ' Deja vacío para mantener la actual.' : '' ?></p>
      </div>
      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <label class="mb-1.5 block text-sm font-semibold">Orden</label>
          <input name="sort_order" type="number" value="<?= (int) $product['sort_order'] ?>" class="<?= $inp ?>">
        </div>
        <label class="flex items-center gap-2.5 pt-7 text-sm font-medium">
          <input type="checkbox" name="is_active" <?= $product['is_active'] ? 'checked' : '' ?> class="h-4 w-4 rounded border-brand-200 text-brand-600">
          Visible en la galería
        </label>
      </div>
      <div class="flex gap-3">
        <button class="btn-primary">Guardar</button>
        <a href="products.php" class="btn-light">Cancelar</a>
      </div>
    </form>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

$products = db()->query('SELECT * FROM products ORDER BY sort_order, id')->fetchAll();
?>
<div class="mb-6 flex items-center justify-between">
  <h1 class="font-display text-2xl font-extrabold">Productos</h1>
  <a href="products.php?action=new" class="btn-primary">+ Nuevo producto</a>
</div>
<?php if (!$products): ?>
  <p class="rounded-2xl bg-white p-8 text-center text-sm text-brand-800/60 shadow-card ring-1 ring-brand-50">Aún no hay productos.</p>
<?php else: ?>
  <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
    <?php foreach ($products as $p): ?>
      <div class="overflow-hidden rounded-2xl bg-white shadow-card ring-1 ring-brand-50">
        <div class="relative aspect-square">
          <img src="../<?= e($p['image']) ?>" alt="" class="h-full w-full object-cover">
          <?php if (!$p['is_active']): ?><span class="absolute left-2 top-2 rounded-full bg-brand-950/70 px-2 py-0.5 text-xs font-semibold text-white">Oculto</span><?php endif; ?>
        </div>
        <div class="p-3">
          <p class="truncate text-sm font-semibold"><?= e($p['name']) ?></p>
          <div class="mt-2 flex gap-2">
            <a href="products.php?action=edit&id=<?= $p['id'] ?>" class="flex-1 rounded-lg bg-brand-50 px-2 py-1.5 text-center text-xs font-semibold text-brand-700 hover:bg-brand-100">Editar</a>
            <form method="post" onsubmit="return confirm('¿Eliminar este producto?')">
              <?= csrf_field() ?><input type="hidden" name="op" value="delete"><input type="hidden" name="id" value="<?= $p['id'] ?>">
              <button class="rounded-lg bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100">✕</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>
