<?php
class Request {
    public static function method(): string {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    static public function url() {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        $request_uri = str_replace([$dirname, $basename], "", $_SERVER['REQUEST_URI']);
        return $request_uri;
    }
}
