<?php

namespace App\Database;

use App\Config\Env;
use PDO;
use PDOException;

class Connection
{
    private static ?PDO $instance = null;

    public static function get(): PDO
    {
        if (self::$instance === null) {
            $host = Env::get('DB_HOST', '127.0.0.1');
            $port = Env::get('DB_PORT', '3306');
            $database = Env::get('DB_DATABASE', 'perpustakaan');
            $username = Env::get('DB_USERNAME', 'root');
            $password = Env::get('DB_PASSWORD', '');

            $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";

            try {
                self::$instance = new PDO($dsn, $username, $password);

                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$instance->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );
            } catch (PDOException $e) {
                throw new PDOException(
                    "Koneksi database gagal: " . $e->getMessage()
                );
            }
        }

        return self::$instance;
    }
}