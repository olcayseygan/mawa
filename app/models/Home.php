<?php
class Home extends Model {
    public static function getHomes() {
        $query = self::db()->query("SELECT * FROM test");
        $results = $query->fetchAll();
        return $results;
    }
}
