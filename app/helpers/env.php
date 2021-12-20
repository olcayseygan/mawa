<?php
$envs = null;
function env($key, $default = null) {
    if (!isset($envs))
        $envs = require __ROOT__ . "/config/env.php";
    return $envs[$key] ?? $default;
}
