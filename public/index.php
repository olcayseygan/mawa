<?php
require "./../setup.php";

require_once __ROOT__ . "/routers/web.php";

$app = new App(Router::$list);

$app->run();
