<?php

class JsonWebTokenVerifier {

    private $rsa;

    function __construct($rsa) {
        $this->rsa = $rsa;
    }

    function verify($token, $publicKey) {
        $exponent = Base64::fromUrlEncoding($publicKey->e);
        $modulus = Base64::fromUrlEncoding($publicKey->n);
        $rsaPublicKey = $this->getRsaPublicKey($exponent, $modulus);
        return openssl_verify($token->getData(), $token->getSignature(), $rsaPublicKey, OPENSSL_ALGO_SHA256);
    }

    private function getRsaPublicKey($exponent, $modulus) {
        $this->rsa->setPublicKey('
            <RSAKeyValue>
                <Exponent>' . $exponent . '</Exponent>
                <Modulus>' . $modulus . '</Modulus>
            </RSAKeyValue>
        ');
        return $this->rsa->getPublicKey();
    }

}

?>