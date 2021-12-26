<?php
class FilmController extends Controller {
    public function index() {
        // $job = new Job("* * * * *");
        // $job->run("test", "TestJob");
        $films = Film::all();
        print_r($films[0]->name);
        return view("home", ["films" => $films]);
    }
}
