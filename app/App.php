<?php

class App {
    private static $routers = [];
    public static function add_route($route) {
        array_push(self::$routers, $route);
    }
    public static function run() {
        Router::$patterns = require __ROOT__ . "/config/router.php";
        foreach (self::$routers as $router)
            Router::match($router);
    }
}
