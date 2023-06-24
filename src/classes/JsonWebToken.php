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
        return json_decode(base64_decode($this->header));
    }
    
    function getBody() {
        return json_decode(base64_decode($this->body));
    }

    function getSignature() {
        return base64_decode(convert_base64url_to_base64($this->signature));
    }

    function getData() {
        return $this->header . "." . $this->body;
    }

}

?>