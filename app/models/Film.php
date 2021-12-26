<?php
class Film extends Model {
    public static function all() {
        $query = self::db()->query(self::query("films"));
        $results = $query->fetchAll();
        return self::convert($results);
    }
}
