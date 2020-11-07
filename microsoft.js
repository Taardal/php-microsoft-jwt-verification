export default class MicrosoftClient {

    static #CONFIG = {
        auth: {
            clientId: "e24b92d7-57d9-4319-8fad-e3c2965c0c8f",
            authority: "https://login.microsoftonline.com/common",
            redirectUri: "http://localhost:3000",
        }
    }

    #msal;

    constructor() {
        this.#msal = new Msal.UserAgentApplication(MicrosoftClient.#CONFIG);
    }

    async logIn() {
        const request = {
            scopes: ["User.Read"],
        };
        const response = await this.#msal.loginPopup(request);
        return response.idToken.rawIdToken;
    }

}