<?php
require_once "setup.php";

[$self, $key, $class, $cron] = $argv;
$root = __ROOT__;

$key_path = "$root/cache/jobs/$key";
$job_path = "$root/app/jobs/$class.php";

$job = new $class($cron);
$crontab = new Cron($cron);

$format = "Y-m-d H:i:00";

$last_run_time = null;
while (1) {
    if (!file_exists($key_path))
        break;

    $run_time = date($format);
    $is_runnable = $crontab->check($run_time);
    if (is_null($last_run_time) and $is_runnable) {
        $job->exec();
        $last_run_time = $run_time;
    }

    if ($run_time != $last_run_time)
        $last_run_time = null;
    sleep(1);
}
