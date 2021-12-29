<?php
class CategoryController extends Controller {
    public function show($slug) {
        $category = Category::get_by_slug($slug);
        if ($category)
            $films = Category::details_by_id($category["id"]);
        else {
            switch ($slug) {
                case 'en-cok-begeni-alanlar':
                    $films = Film::most_rateds_top10();
                    $category = ["name" => "En Çok Beğeni Alanlar"];
                    break;

                case 'en-son-eklenenler':
                    $films = Film::last_added_top10();
                    $category = ["name" => "En Son Eklenenler"];
                    break;

                case 'en-son-izlenenler':
                    $films = Film::most_watcheds();
                    $category = ["name" => "En Çok İzlenenler"];
                    break;
            }
        }
        return view("category-show", ["category" => $category, "films" => $films]);
    }
}
