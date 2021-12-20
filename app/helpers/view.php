<?php
function view($path, $data = []) {
    $dir = __ROOT__ . "/resources/views/" . str_replace(".", "/", $path) . ".php";
    if (!file_exists($dir))
        return;
    extract($data);
    include $dir;
}
