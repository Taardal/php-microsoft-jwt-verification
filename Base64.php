<?php

class Base64 {

    static function decode($text) {
        return base64_decode($text);
    }

    static function decodeUrl($url) {
        return base64_decode(self::fromUrlEncoding($url));
    }

    static function fromUrlEncoding($url) {
        $padding = strlen($url) % 4;
        if ($padding > 0) {
            $input .= str_repeat("=", 4 - $padding);
        }
        return strtr($url, '-_', '+/');
    }

}

?>