<?php
$db = null;
try {
    function db() {
        if (!isset($db)) {
            $dsn = sprintf("%s:host=%s:%s;dbname=%s;charset=%s", ...[
                env("DB_CONNECTION"),
                env("DB_HOST"),
                env("DB_PORT"),
                env("DB_NAME"),
                env("DB_CHARSET")
            ]);
            $db = new PDO($dsn, env("DB_USER"), env("DB_PASS"));
        }
        return $db;
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
