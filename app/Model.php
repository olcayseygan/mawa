<?php
class Model {
    /**
     * Veritabanına erişim için çağırılır.
     * 
     * @return PDO
     */
    static protected function db() {
        return Database::get();
    }

    /**
     * Dosyada kaydedilen sorguyu kullanmak için erişim sağlar.
     * 
     * @param string Kullanılacak sorgunun bulundugu dosya adı.
     * @return string Dosyada bununan sorgu.
     */
    protected static function query($filename) {
        $root = __ROOT__;
        if (!file_exists($path = "$root/resources/sql/$filename.sql"))
            return null;
        return file_get_contents($path);
    }
}
