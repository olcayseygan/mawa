<?php
class HomeController extends Controller {
    public function index() {
        return view("layouts.master", ["slot" => "home"]);
    }
}
