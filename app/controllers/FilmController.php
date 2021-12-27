<?php
class FilmController extends Controller {
    public function index() {
        // $job = new Job("* * * * *");
        // $job->run("test", "TestJob");
        $films = Film::all();
        return view("home", ["films" => $films]);
    }

    public function show($film) {
        return null;
    }
}
