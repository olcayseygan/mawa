<?php
class Film extends Model {
    public static function all() {
        $films = self::db()->query("SELECT * FROM films")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($films as &$film) {
            $stmt = self::db()->prepare("SELECT filename FROM media WHERE id=(SELECT media_id FROM film_media WHERE film_id=:film_id AND place_at='poster' LIMIT 1)");
            $stmt->execute(["film_id" => $film["id"]]);
            $film["poster"] = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $films;
    }

    public static function most_watcheds() {
        $films = self::db()->query(query("most_watched_films"))->fetchAll(PDO::FETCH_ASSOC);
        return $films;
    }

    public static function in_categories() {
        $categories = self::db()->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as &$category) {
            $stmt = self::db()->prepare("SELECT films.*, media.filename FROM films INNER JOIN film_media ON films.id=film_media.film_id INNER JOIN media ON media.id=film_media.media_id WHERE film_media.place_at='poster' AND films.id IN (SELECT film_categories.film_id FROM film_categories WHERE film_categories.category_id=:category_id) GROUP BY films.id LIMIT 10");
            $stmt->execute(["category_id" => $category["id"]]);
            $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!count($films)) continue;
            $category["films"] = $films;
        }
        return array_filter($categories, function ($val) {
            return isset($val["films"]);
        });
    }
}
