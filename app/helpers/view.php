<?php

/**
 * Görüntü içeriklerini çeker.
 * 
 * @param string|null $view Görüntü adresi. örn. "layouts.master".
 * @param array $data Kullanılacak veriler.
 * @param object $slot İçeriye basılacak elemanlar.
 */
function view($view = null, $data = [], $slot = null) {
    assert(in_array(gettype($view), ["string", "NULL"]), '$view, string veya null olmalıdır.');
    assert(gettype($data) == "array", '$data, array olmalıdır.');
    assert(in_array(gettype($slot), ["object", "NULL"]), '$data, object veya null olmalıdır.');

    $dir = __ROOT__ . "/resources/views/" . str_replace(".", "/", $view) . ".php";
    if (!file_exists($dir))
        throw new Exception("$view dosyası bulunamadı.");

    $data["slot"] = $slot ?? function () {
    };
    extract($data);
    include $dir;
}
