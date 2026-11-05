<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config\Env;
use App\Database\Connection;

try {
    Env::load(__DIR__ . '/.env');

    $pdo = Connection::get();

    echo "Koneksi database berhasil!";
} catch (Exception $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}