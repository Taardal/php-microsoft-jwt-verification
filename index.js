import MicrosoftClient from "./microsoft.js";

const microsoftClient = new MicrosoftClient();

function main() {
    document.getElementById("login_button_v1").onclick = async function () {
        clear();
        logIn("v1");
    }
    document.getElementById("login_button_v2").onclick = async function () {
        clear();
        logIn("v2");
    }
}

async function logIn(version) {
    const idToken = await microsoftClient.logIn();
    document.getElementById("id_token").innerHTML = idToken;
    const verificationResult = await verifyToken(idToken, version);
    document.getElementById("verification_result").innerHTML = verificationResult;
    console.log(verificationResult);
}

async function verifyToken(token, version) {
    const requestOptions = {
        headers: new Headers({
            "Authorization": `Bearer ${token}`
        })
    }
    const response = await fetch(`${version}.php`, requestOptions);
    return await response.text();
}

function clear() {
    document.getElementById("id_token").innerHTML = "";
    document.getElementById("verification_result").innerHTML = "";
}

main();