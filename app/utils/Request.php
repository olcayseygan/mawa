<?php
class Request {
    public static function method(): string {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function url() {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        return str_replace([$dirname, $basename], "", $_SERVER['REQUEST_URI']);
    }

    public static function base() {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $host = $_SERVER["HTTP_HOST"];
        $script_name = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = ($script_name != '/' ? $script_name : '');
        return "$protocol$host$dirname";
    }
}
