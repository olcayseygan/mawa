<?php
class Model {
    static protected function db() {
        return Database::get();
    }

    protected static function query($filename) {
        $root = __ROOT__;
        if (!file_exists($path = "$root/resources/sql/$filename.sql"))
            return null;
        return file_get_contents($path);
    }

    protected static function convert($results) {
        return array_map(function ($result) {
            return (object)$result;
        }, $results);
    }
}
