<?php
class HomeController extends Controller {
    public function index() {
        $query = Database::call()->query("SELECT * FROM test");
        $results = $query->fetchAll();
        return view("home", ["data" => $results]);
    }
}
