<?php

class JsonWebToken {

    private $header;
    private $body;
    private $signature;

    function __construct($rawToken) {
        $parts = explode('.', $rawToken);
        $this->header = $parts[0];
        $this->body = $parts[1];
        $this->signature = $parts[2];
    }

    function getHeader() {
        return json_decode(Base64::decode($this->header));
    }
    
    function getBody() {
        return json_decode(Base64::decode($this->body));
    }

    function getSignature() {
        return Base64::decode(Base64::fromUrlEncoding($this->signature));
    }

    function getData() {
        return $this->header . "." . $this->body;
    }

}

?>