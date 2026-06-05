<?php
/**
 * Conexión a la base de datos (PDO/MySQL).
 *
 * Credenciales por orden de prioridad:
 *   1) Archivo local config/db.local.php (hosting / desarrollo nativo)
 *   2) Variables de entorno DB_HOST/DB_NAME/DB_USER/DB_PASS (Docker)
 *   3) Valores por defecto
 */
function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $cfg = [
        'host' => getenv('DB_HOST') ?: '127.0.0.1',
        'name' => getenv('DB_NAME') ?: 'marple',
        'user' => getenv('DB_USER') ?: 'root',
        'pass' => getenv('DB_PASS') ?: '',
        'port' => getenv('DB_PORT') ?: '3306',
    ];

    $local = __DIR__ . '/../config/db.local.php';
    if (is_file($local)) {
        $cfg = array_merge($cfg, require $local);
    }

    $dsn = "mysql:host={$cfg['host']};port={$cfg['port']};dbname={$cfg['name']};charset=utf8mb4";
    $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    return $pdo;
}

/**
 * Devuelve todos los ajustes (settings) como arreglo clave => valor.
 * Cachea el resultado en memoria por petición.
 */
function settings(): array
{
    static $cache = null;
    if ($cache !== null) {
        return $cache;
    }
    try {
        $rows = db()->query('SELECT name, value FROM settings')->fetchAll();
        $cache = array_column($rows, 'value', 'name');
    } catch (Throwable $e) {
        $cache = [];
    }
    return $cache;
}
