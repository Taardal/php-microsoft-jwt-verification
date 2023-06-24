<?php
use \phpseclib\Crypt\RSA;

println("--- HEADERS ---");
$headers = getallheaders();
printlnln($headers);

println("--- ID TOKEN ---");
$idToken = $headers["Authorization"];
printlnln($idToken);

println("--- ID TOKEN PARTS ---");
$idTokenParts = explode('.', $idToken);
printlnln($idTokenParts);

println("--- ID TOKEN HEADER ---");
$idTokenHeader = json_decode(base64_decode($idTokenParts[0]));
printlnln($idTokenHeader);

println("--- ID TOKEN PAYLOAD ---");
$idTokenPayload = json_decode(base64_decode($idTokenParts[1]));
printlnln($idTokenPayload);

println("--- SIGNING KEY ID ---");
$keyId = $idTokenHeader->kid;
printlnln($keyId);

println("--- OPEN ID CONFIGURATION ---");
$openIdConfigurationUri = "https://login.microsoftonline.com/common/v2.0/.well-known/openid-configuration";
$openIdConfiguration = json_decode(file_get_contents($openIdConfigurationUri));
printlnln($openIdConfiguration);

println("--- SIGNING KEYS URI ---");
$signingKeysUri = $openIdConfiguration->jwks_uri;
printlnln($signingKeysUri);

println("--- SIGNING KEYS ---");
$signingKeys = json_decode(file_get_contents($signingKeysUri));
printlnln($signingKeys);

println("--- SIGNING KEY ---");
$signingKey;
for ($i = 0; $i < sizeof($signingKeys->keys); $i++) {
	$key = $signingKeys->keys[$i];
	if ($key->kid == $keyId) {
		$signingKey = $key;
		break;
	}
}
printlnln($signingKey);

println("--- EXPONENT ---");
$exponent = convert_base64url_to_base64($signingKey->e);
printlnln($exponent);

println("--- MODULUS ---");
$modulus = convert_base64url_to_base64($signingKey->n);
printlnln($modulus);

println("--- RSA PUBLIC KEY ---");
$rsa = new RSA();
$rsa->setPublicKey('
	<RSAKeyValue>
		<Exponent>' . $exponent . '</Exponent>
		<Modulus>' . $modulus . '</Modulus>
	</RSAKeyValue>'
);
$rsaPublicKey = $rsa->getPublicKey();
printlnln($rsaPublicKey);

println("--- VERIFICATION ---");
$tokenData = $idTokenParts[0] . "." . $idTokenParts[1];
$tokenSignature = base64_decode(convert_base64url_to_base64($idTokenParts[2]));
$verified = openssl_verify($tokenData, $tokenSignature, $rsaPublicKey, OPENSSL_ALGO_SHA256);
$verifiedString = $verified ? "true" : "false";
printlnln("verified [$verifiedString]");

?>