<?php
class MostRatedFilmsJob extends Job {
    public function exec() {
        $this->create_raters();
        $stmt = Database::get()->prepare(query("average_film_ratings"));
        $stmt->execute();
    }

    private function create_raters() {
        $film_ids = array_map(function ($val) {
            return $val["id"];
        }, Database::get()->query("SELECT * FROM films")->fetchAll(PDO::FETCH_ASSOC));

        foreach (range(0, 100) as $i) {
            $stmt = Database::get()->prepare("INSERT INTO film_ratings(film_id, rating) VALUES(:film_id, :rating)");
            $stmt->execute(["film_id" => $film_ids[rand(0, count($film_ids) - 1)], "rating" => rand(1, 5)]);
        }
    }
}
