<?php

require_once "globals.php";
require_once "autoload.php";

use phpseclib\Crypt\RSA;

$microsoftApi = new MicrosoftApi();
$tokenVerifier = new JsonWebTokenVerifier(new RSA());

$request = Request::receive();
$token = new JsonWebToken($request->getBearerToken());
$keyId = $token->getHeader()->kid;
$signingKey = $microsoftApi->getSigningKey($keyId);
$verified = $tokenVerifier->verify($token, $signingKey);
println("verified [" . ($verified ? "true" : "false") . "]");

$response = $verified ? Response::ok() : Response::badRequest();
$response->send();

?>