<?php
class Film extends Model {
    public static function most_watcheds() {
        $films = self::db()->query(query("most_watched_films"))->fetchAll(PDO::FETCH_ASSOC);
        return $films;
    }
    public static function most_rateds_top10() {
        $films = self::db()->query(query("most_rated_top10_films"))->fetchAll(PDO::FETCH_ASSOC);
        return $films;
    }
    public static function last_added_top10() {
        $films = self::db()->query(query("last_added_top10_films"))->fetchAll(PDO::FETCH_ASSOC);
        return $films;
    }

    public static function in_categories() {
        $categories = self::db()->query(query("categories"))->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as &$category) {
            $stmt = self::db()->prepare(query("films_in_categories"));
            $stmt->execute(["category_id" => $category["id"]]);
            $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!count($films)) continue;
            $category["films"] = $films;
        }
        return array_filter($categories, function ($val) {
            return isset($val["films"]);
        });
    }

    public static function details_by_slug($slug) {
        $stmt = self::db()->prepare(query("film_details_by_slug"));
        $stmt->execute(["slug" => $slug]);
        $film = $stmt->fetch(PDO::FETCH_ASSOC);
        return $film;
    }
}
