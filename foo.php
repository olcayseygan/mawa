<?php
require_once "setup.php";


$files = glob("./public/images/posters/*.jpg");
foreach ($files as $file) {
    $stmt = Database::get()->prepare("INSERT INTO media(filename) VALUES(:filename)");
    // $stmt->execute(["filename" => basename($file)]);
}
