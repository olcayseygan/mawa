<?php
class Model {
    static private $db = null;
    static protected function db() {
        if (!self::$db) {
            $keys = [env("DB_CONNECTION"), env("DB_HOST"), env("DB_PORT"), env("DB_NAME"), env("DB_CHARSET")];
            $dsn = sprintf("%s:host=%s:%s;dbname=%s;charset=%s", ...$keys);
            try {
                self::$db = new PDO($dsn, env("DB_USER"), env("DB_PASS"));
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$db;
    }
}
