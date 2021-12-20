<?php
class Database {
    static private $db;
    static public function connect() {
        $dsn = sprintf("%s:host=%s:%s;dbname=%s;charset=%s", ...[
            env("DB_CONNECTION"),
            env("DB_HOST"),
            env("DB_PORT"),
            env("DB_NAME"),
            env("DB_CHARSET")
        ]);
        try {
            self::$db = new PDO($dsn, env("DB_USER"), env("DB_PASS"));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    static public function call() {
        return self::$db;
    }
}
