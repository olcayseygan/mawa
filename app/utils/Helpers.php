<?php

/**
 * Anahtarı ile sabit değişkeni çağırır.
 * 
 * @param string $key Değişken anahtarı.
 * @param mixed $default Anahtar ile değişken bulunamadığında çağıralacak değer.
 * @return mixed Sabit değişken.
 */
function env($key, $default = null) {
    assert(gettype($key) == "string", '$key, string olmalıdır.');

    global $envs;
    if (!isset($envs))
        $envs = require __ROOT__ . "/config/env.php";
    return $envs[$key] ?? $default;
}


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

    $root = __ROOT__;
    $replaced = str_replace(".", "/", $view);

    if (!file_exists($dir = "$root/resources/views/$replaced.php"))
        throw new Exception("$view dosyası bulunamadı.");

    if (!is_null($slot)) {
        ob_start();
        echo $slot();
        $content = ob_get_contents();
        ob_end_clean();
        $data["slot"] = $content;
    }

    ob_start();
    extract($data);
    include $dir;
    $content = ob_get_contents();
    ob_end_clean();
    echo $content;
}

function asset($asset, ...$data) {
    $base = Request::base();
    return sprintf("$base/$asset", ...$data);
}

function url($url, ...$data) {
    return asset($url, ...$data);
}

function query($query) {
    $root = __ROOT__;
    if (!file_exists($dir = "$root/resources/sql/$query.sql"))
        throw new Exception("$query dosyası bulunamadı.");
    return file_get_contents($dir);
}
