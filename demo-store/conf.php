<?php
require('paydunya_php/paydunya.php');
Paydunya_Setup::setMasterKey("wQzk9ZwR-Qq9m-0hD0-zpud-je5coGC3FHKW");
Paydunya_Setup::setPublicKey("live_public_wxGWFgpBzar1Vd8VJi5Ox7KvU4C");
Paydunya_Setup::setPrivateKey("live_private_SyJiZG2H0mWtGjUIaAO1b4DFGAr");
Paydunya_Setup::setMode("live");
Paydunya_Setup::setToken("mrS9ktL5ullbVHiOV7e1");

//Configuration des informations de votre service/entreprise
Paydunya_Checkout_Store::setName("La boutique de Sandra");
Paydunya_Checkout_Store::setTagline("L'élégance n'a pas de prix");
Paydunya_Checkout_Store::setPhoneNumber("774262038");
Paydunya_Checkout_Store::setPostalAddress("Dakar Plateau - Etablissement kheweul");

// Vous pouvez mettre ici localhost pour vos tests de redirection en local
// Paydunya_Checkout_Store::setCancelUrl("http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/index.php");
// Paydunya_Checkout_Store::setReturnUrl("http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/confirm.php");