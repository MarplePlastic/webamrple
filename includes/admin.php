<?php
/**
 * Helpers del panel de administración: sesión, autenticación, CSRF,
 * mensajes flash y subida de imágenes.
 */
require_once __DIR__ . '/db.php';

function admin_boot(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
        session_start();
    }
}

function e($s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

function redirect(string $to): void
{
    header('Location: ' . $to);
    exit;
}

function current_admin(): ?array
{
    admin_boot();
    return $_SESSION['admin'] ?? null;
}

function require_login(): void
{
    admin_boot();
    if (!current_admin()) {
        redirect('login.php');
    }
}

/* ----- CSRF ----- */
function csrf_token(): string
{
    admin_boot();
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . csrf_token() . '">';
}
function csrf_check(): void
{
    admin_boot();
    $ok = isset($_POST['_csrf']) && is_string($_POST['_csrf'])
        && hash_equals($_SESSION['csrf'] ?? '', $_POST['_csrf']);
    if (!$ok) {
        http_response_code(419);
        exit('Token de seguridad inválido. Vuelve atrás y recarga la página.');
    }
}

/* ----- Mensajes flash ----- */
function flash(string $msg, string $type = 'success'): void
{
    admin_boot();
    $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}
function get_flash(): ?array
{
    admin_boot();
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}

/* ----- Administradores ----- */
function admins_count(): int
{
    return (int) db()->query('SELECT COUNT(*) c FROM admins')->fetch()['c'];
}

/* ----- Subida de imágenes ----- */
function handle_image_upload(string $field, string $current = ''): string
{
    if (empty($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return $current; // sin cambios
    }
    $f = $_FILES[$field];
    if ($f['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('Hubo un problema al subir la imagen.');
    }
    $allowed = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'];
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!isset($allowed[$ext])) {
        throw new RuntimeException('Formato no permitido. Usa JPG, PNG o WEBP.');
    }
    if ($f['size'] > 6 * 1024 * 1024) {
        throw new RuntimeException('La imagen supera los 6 MB.');
    }
    if (function_exists('finfo_open')) {
        $mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $f['tmp_name']);
        if (!in_array($mime, $allowed, true)) {
            throw new RuntimeException('El archivo no es una imagen válida.');
        }
    }
    $dir = __DIR__ . '/../assets/img/uploads';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $base  = preg_replace('/[^a-zA-Z0-9_-]/', '_', pathinfo($f['name'], PATHINFO_FILENAME));
    $fname = substr($base, 0, 40) . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    if (!move_uploaded_file($f['tmp_name'], $dir . '/' . $fname)) {
        throw new RuntimeException('No se pudo guardar la imagen.');
    }
    return 'assets/img/uploads/' . $fname;
}
