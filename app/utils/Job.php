<?php
class Job {
    private $cron = null;
    public function __construct($cron) {
        switch ($cron) {
            case "@yearly":
            case "@annually":
                $cron = "0 0 1 1 *";
                break;

            case "@monthly":
                $cron = "0 0 1 * *";
                break;

            case "@weekly":
                $cron = "0 0 * * 0";
                break;

            case "@daily":
                $cron = "0 0 * * *";
                break;

            case "@hourly":
                $cron = "0 * * * *";
                break;
        }

        $this->cron = $cron;
    }

    public function run($key, $filename) {
        [$root, $key, $uuid, $filename, $cron] = [__ROOT__, $key, uniqid(), $filename, $this->cron];

        $path = "$root/cache/jobs/$key-$uuid";
        if (!file_exists($path))
            self::stop_job($key);
        $file = fopen($path, "w");
        fclose($file);
        $cmd = "php \"$root/job.php\" $key-$uuid $filename \"$cron\"";
        if (substr(php_uname(), 0, 7) == "Windows")
            pclose(popen("start /B " . $cmd, "r"));
        else
            exec($cmd . " > /dev/null &");
    }

    public function get_cron() {
        return $this->cron;
    }

    public static function stop_job($key) {
        $root = __ROOT__;
        $files = glob("$root/cache/jobs/*");
        foreach ($files as $file)
            if (substr(basename($file), 0, strlen($key)) == $key) {
                unlink($file);
                return true;
            }
        return false;
    }
}
