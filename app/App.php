<?php

class App {
    private $routers = [];
    private $router_patterns = [];
    public function __construct($routers = []) {
        $this->routers = $routers;
        $this->router_patterns = require __ROOT__ . "/config/router.php";
    }

    public function run() {
        Router::$patterns = $this->router_patterns;
        foreach ($this->routers as $router)
            Router::match($router);
    }
}
