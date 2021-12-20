<?php
class Router {
    static private $QUERY_STRING = "(?:\?(?:&?[^=&]*=[^=&]*)*)*";

    static public $patterns = [];

    static public function match($router) {
        [$url, $method, $controller, $function] = $router;
        if (Request::method() != $method)
            return;

        $url = str_replace(array_keys(self::$patterns), array_values(self::$patterns), $url . self::$QUERY_STRING);
        if (!preg_match("@^$url$@", Request::url(), $regexps))
            return;

        unset($regexps[0]);

        $sectors = explode("/", $controller);
        $class = strtolower(end($sectors));
        unset($sectors[count($sectors) - 1]);
        $path = join("/", $sectors) . (count($sectors) > 0 ? "/" : "");
        if (!file_exists($file = __ROOT__ . "/app/controllers/$path$class.php"))
            return;

        require_once $file;
        call_user_func([new $class, $function]);
    }

    static private function add_route($url, $method, $controller, $function) {
        App::add_route([$url, $method, $controller, $function]);
    }

    static public function get($url, $controller, $function) {
        self::add_route($url, "get", $controller, $function);
    }

    static public function post($url, $controller, $function) {
        self::add_route($url, "post", $controller, $function);
    }
}
