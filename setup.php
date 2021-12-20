<?php
define("__ROOT__", __DIR__);

require_once "autoload.php";


// gerekli yardımcılar ve sınıflar yükleniyor. 
// require_once "app/env.php";
// require_once "app/db.php";
require_once "app/helpers/view.php";


require_once "routers/web.php";

App::run();
