<?php
use phpseclib\Crypt\RSA;

$microsoftApi = new MicrosoftApi();
$tokenVerifier = new JsonWebTokenVerifier(new RSA());

$request = Request::receive();
$idToken = new JsonWebToken($request->getHeader("Authorization"));
$signingKey = $microsoftApi->getSigningKey($idToken->getHeader()->kid);
$verified = $tokenVerifier->verifySignature($idToken, $signingKey);

println("verified [" . ($verified ? "true" : "false") . "]");
$response = $verified ? Response::ok() : Response::badRequest();
$response->send();

?>