<?php
class Category extends Model {
    public static function get_by_slug($slug) {
        $stmt = self::db()->prepare(query("category_by_id"));
        $stmt->execute(["slug" => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function details_by_id($id) {
        $stmt = self::db()->prepare(query("films_in_category"));
        $stmt->execute(["id" => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function film_categories($film_id) {
        $stmt = self::db()->prepare(query("film_categories"));
        $stmt->execute(["film_id" => $film_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
