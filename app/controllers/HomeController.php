<?php
class HomeController extends Controller {
    public function index() {
        $job = new Job("* * * * *");
        $job->run("test", "TestJob");
        $homes = Home::getHomes();
        return view("home", ["data" => $homes]);
    }
}
