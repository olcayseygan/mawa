<?php
class Media extends Model {
    public static function film_media($film_id) {
        $stmt = self::db()->prepare(query("film_media"));
        $stmt->execute(["film_id" => $film_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
