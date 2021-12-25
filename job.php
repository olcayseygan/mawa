<?php
require_once "setup.php";

[$self, $key, $class, $cron] = $argv;
$root = __ROOT__;

$key_path = "$root/cache/jobs/$key";
$job_path = "$root/app/jobs/$class.php";

$job = new $class($cron);
$crontab = new Cron($cron);

$executed = false;

while (1) {
    if (!file_exists($key_path))
        break;

    if (!$executed and $crontab->check(date("Y-m-d h:m:00"))) {
        // if (!$executed) {
        $executed = true;
        $job->exec();
    }

    sleep(60);
    $executed = false;
}
