<?php
class MostWatchedFilmsJob extends Job {
    public function exec() {
        $this->create_watchers();
        $stmt = Database::get()->prepare(query("most_watched_film_ranks"));
        $stmt->execute();
    }

    private function create_watchers() {
        $film_ids = array_map(function ($val) {
            return $val["id"];
        }, Database::get()->query("SELECT * FROM films")->fetchAll(PDO::FETCH_ASSOC));

        foreach (range(0, 100) as $i) {
            $stmt = Database::get()->prepare("INSERT INTO film_watchers(film_id, watched_time) VALUES(:film_id, :watched_id)");
            $stmt->execute(["film_id" => $film_ids[rand(0, count($film_ids) - 1)], "watched_id" => rand(50, 200)]);
        }
    }
}
