<?php
class HomeController extends Controller {
    public function index() {
        $homes = Home::getHomes();
        return view("home", ["data" => $homes]);
    }
}
