<?php
class Cron {
    public function __construct($cron) {
        $this->cron = $cron;
    }

    /**
     * Gönderilen tarihin Cron ile uyumlu olup olmadığını kontrol eder, eğer vakti geldiyse true cevabı verilir.
     * 
     * @param date Kontrolü istenen tarih.
     * @return boolean Vakti gelip gelmediği.
     */
    public function check_its_time($time) {
        // En son Cron'un formatı değiştirilerek daha karmaşık bir koşul yapısına dönüştürülür.
        // Bu koşul metin olarak tutulduğu için eval ile kontrol edilir.
        // (true or true or true or true) and (...) and (...)
        return eval(sprintf("return %s;", implode(" and ", array_map(function ($match) {
            [$date, $cron] = $match;
            $tabs = explode(",", $cron);

            // Değiştirilen formatı metin olarak koşul olarak tutar ve üst katmana gönderir.
            // true or true or 5===5 or true
            return  "(" . implode(" or ", array_map(
                function ($tab) use ($date) {
                    // Cron formatında girilen değişkeni, uygun olan formatta değiştirir.
                    // *    -> true
                    // 5    -> 5===4
                    // 1-3  -> 1<=2<=3
                    // */3  -> 3%3===0
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
