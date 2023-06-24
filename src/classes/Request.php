<?php

class Request {

    private $headers;

    private function __construct() {
        $this->headers = getallheaders();
    }

    function getHeader($name) {
        return $this->headers[$name];
    }

    static function receive() {
        return new Request();
    }

}

?>