<?php
define("__ROOT__", __DIR__);

require_once "autoload.php";
require_once "app/utils/Helpers.php";

date_default_timezone_set(env("TIMEZONE"));
