# Microsoft ID-token verification

This is a demo of verifying Microsoft ID-token signatures using PHP and the [phpseclib][phpseclib:github] library. 

This demo was created for educational purposes.

It features two versions:

### V1

This is the simple and primitive version with a lot of logging, and where almost everything is contained in a single file. This was the first implementation just to get it up and running and to demonstrate the basic procedure.

### V2

This is the OOP-version where the code is split into classes to show how they work, and how they can be used to organize code.


# Prerequisites :vertical_traffic_light:
- [Git][git:download]
- [PHP][php:download]

# Getting started :runner:

### Getting the code :octocat:

- Clone the repository: `git clone https://github.com/Taardal/php-microsoft-jwt-verification.git`

### Running the app :rocket:

- Export the ID-token as an environment variable: `export ID_TOKEN=...`
- Run the PHP server: `php -S localhost:3000`
- Send a request to the desired version:
```
curl -H "Authorization: $ID_TOKEN" "http://localhost:3000?version=v1"
``` 


[git:download]: https://git-scm.com/downloads
[php:download]: https://www.php.net/downloads.php
[phpseclib:github]: https://github.com/phpseclib/phpseclib
