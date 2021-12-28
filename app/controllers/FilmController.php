<?php
class FilmController extends Controller {
    public function index() {
        $most_watched_films = Film::most_watcheds();
        $categories = Film::in_categories();
        return view("home", ["most_watched_films" => $most_watched_films, "categories" => $categories]);
    }

    public function show($film) {
        return null;
    }
}
