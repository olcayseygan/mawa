<?php
spl_autoload_register('search');
function search(string $name, string $path = __ROOT__ . "/app/") {
    $class_name = ltrim($name, '\\');
    $file_name = '';
    if ($last_ns_pos = strripos($class_name, '\\')) {
        $namespace = substr($class_name, 0, $last_ns_pos);
        $class_name = substr($class_name, $last_ns_pos + 1);
        $file_name = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    if (file_exists($file_name =  $path . $file_name . $class_name . '.php')) {
        require_once $file_name;
        return;
    }
    $dirs = array_filter(glob($path . '*'), 'is_dir');
    foreach ($dirs as $dir) {
        $parts = explode('\\', $dir);
        search($name, $dir . "/");
    }
}
