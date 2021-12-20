<?php
require "./../setup.php";

require_once __ROOT__ . "/routers/web.php";

Database::connect();
App::run();
