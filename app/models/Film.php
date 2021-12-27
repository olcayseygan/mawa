<?php
class Film extends Model {
    public static function all() {
        // $query = self::db()->query("SELECT film as  FROM films INNER JOIN film_media ON films.id=film_media.film_id");
        $films = self::db()->query("SELECT * FROM films")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($films as &$film) {
            $stmt = self::db()->prepare("SELECT filename FROM media WHERE id=(SELECT media_id FROM film_media WHERE film_id=:film_id AND place_at='poster' LIMIT 1)");
            $stmt->execute(["film_id" => $film["id"]]);
            $film["poster"] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $films;
    }
}
