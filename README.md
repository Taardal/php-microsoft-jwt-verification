# Demo: Verifisere ID-token frå Microsoft 

Dette er ein liten prototype av å...

1. Logge inn hos Microsoft
2. Få eit ID-token tilbake
3. Verifisere signaturen til tokenet

...for ein Single-Page-Application med PHP backend.

<br />

Tanken her er å opprette ein sesjon, med data frå tokenet, når tokenet er verifisert:
```
$verified = $tokenVerifier->verify($token, $signingKey);

if $($verified) { 
    //Opprett ein sesjon her
    //Send 200 OK
} else {
    //Send 401 BAD REQUEST f.eks.
}
```

<br />

Backend er delt opp i to versjonar (som gjer akkurat det samme!):
- `v1.php`: Den mest primitive versjonen. Alt ligger i ei og samme fil, og inneheld ein del debug-logging.
- `v2.php`: Den meir avanserte versjonen. Koden er fordelt i fleire forskjellige filer og klasser.

<br />

### MERK!
- Applikasjonen verifiserer kun *ID-TOKEN*. Den klarar **ikkje** å verifisere *ACCESS_TOKEN*.
- Applikasjonen brukar, og er dermed avhengig av, biblioteket `phpseclib` for å verifisere tokenet.


