<?php

class Request {

    private $headers;

    private function __construct() {
        $this->headers = getallheaders();
    }

    function getBearerToken() {
        $authorizationHeader = $this->headers["authorization"];
        return explode(" ", $authorizationHeader)[1];
    }

    static function receive() {
        return new Request();
    }

}

?>