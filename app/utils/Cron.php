<?php
class Cron {
    public function __construct($cron) {
        $this->cron = $cron;
    }

    public function check($time) {
        echo $time, $this->cron;
        return eval(sprintf("return %s;", implode(" and ", array_map(function ($match) {
            [$date, $cron] = $match;
            $tabs = explode(",", $cron);
            return  "(" . implode(" or ", array_map(
                function ($tab) use ($date) {
                    return preg_replace(
                        ['/^\*$/', '/^\d+$/', '/^(\d+)\-(\d+)$/', '/^\*\/(\d+)$/'],
                        ["true", sprintf('%s===\0', $date), sprintf('(\1<=%1$s and %1$s<=\2)', $date), sprintf('%s%%\1===0', $date)],
                        $tab
                    );
                },
                $tabs
            )) . ")";
        }, array_map(function ($left, $right) {
            return [intval($left), $right];
        }, explode(" ", date("i G j n w", strtotime($time))), explode(" ", $this->cron))))));
    }
}
