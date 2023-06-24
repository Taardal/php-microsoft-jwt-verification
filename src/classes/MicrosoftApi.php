<?php

class MicrosoftApi {

    private const OPEN_ID_CONFIGURATION_URI = "https://login.microsoftonline.com/common/v2.0/.well-known/openid-configuration";

    function getSigningKey($keyId) {
        $openIdConfiguration = $this->getOpenIdConfiguration();
        $signingKeys = $this->getSigningKeys($openIdConfiguration);
        foreach ($signingKeys as $key) {
            if ($key->kid == $keyId) {
                return $key;
            }
        }
        return null;
    }

    private function getOpenIdConfiguration() {
        return json_decode(file_get_contents(self::OPEN_ID_CONFIGURATION_URI));
    }

    private function getSigningKeys($openIdConfiguration) {
        $json = file_get_contents($openIdConfiguration->jwks_uri);
        return json_decode($json)->keys;
    }

}

?>