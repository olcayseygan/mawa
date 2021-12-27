<?php
class Model {
    /**
     * @return PDO
     */
    static protected function db() {
        return Database::get();
    }

    /**
     * @param string
     * @return string
     */
    protected static function query($filename) {
        $root = __ROOT__;
        if (!file_exists($path = "$root/resources/sql/$filename.sql"))
            return null;
        return file_get_contents($path);
    }
}
