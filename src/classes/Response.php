<?php
class Response {

    private $code;
    
    private function __construct($code) {
        $this->code = $code;
    }

    public static function ok() {
        return new Response(200);
    }

    public static function badRequest() {
        return new Response(401);
    }

    public static function internalServerError() {
        return new Response(500);
    }

    public function send() {
        http_response_code($this->code);
        die();
    }

}