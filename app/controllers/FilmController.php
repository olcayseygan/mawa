<?php
class FilmController extends Controller {
    public function index() {
        $most_watched_films = Film::most_watcheds();
        $most_rated_films = Film::most_rateds_top10();
        $last_added_top10_films = Film::last_added_top10();
        $categories = Film::in_categories();
        return view("films", ["most_watched_films" => $most_watched_films, "most_rated_films" => $most_rated_films, "last_added_films" => $last_added_top10_films, "categories" => $categories]);
    }

    public function show($slug) {
        $film = Film::details_by_slug($slug);
        $categories = Category::film_categories($film["id"]);
        $gallery = Media::film_media($film["id"]);
        return view("film-show", ["film" => $film, "categories" => $categories, "gallery" => $gallery]);
    }
}
