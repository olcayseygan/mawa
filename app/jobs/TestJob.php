<?php
class TestJob extends Job {
    public function exec() {
        $root = __ROOT__;
        $file = fopen("$root/test.txt", "a");
        fwrite($file, "run\n");
        fclose($file);
    }
}
