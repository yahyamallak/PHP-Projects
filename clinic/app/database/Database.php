<?php

namespace Clinic\Database;

use PDO;
use PDOException;

class Database {
    private static $host = 'localhost';
    private static $dbname = 'clinic';
    private static $username = 'root';
    private static $password = '';
    private static $pdo;

    public static function connect() {
        if (self::$pdo === null) {
            try {
                $dsn = "mysql:host=".self::$host.";dbname=".self::$dbname.";charset=utf8mb4";
                self::$pdo = new PDO($dsn, self::$username, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

