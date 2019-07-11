# PAYDUNYA - Client PHP API
============================
PAYDUNYA Client PHP

## Documentation Officielle
http://paydunya.com/developers/php

## Installation

Inclure la librairie PHP PAYDUNYA

    require 'paydunya/paydunya.php'

## Configuration de vos clés d'API

    Paydunya_Setup::setMasterKey(VOTRE_CLE_PRINCIPALE);
    Paydunya_Setup::setPublicKey(VOTRE_CLE_PUBLIQUE);
    Paydunya_Setup::setPrivateKey(VOTRE_CLE_PRIVEE);
    Paydunya_Setup::setMode(["test"|"live"]);
    Paydunya_Setup::setToken(VOTRE_TOKEN);

## Configuration des informations de votre service/activité/entreprise

    Paydunya_Checkout_Store::setName("Magasin Chez Sandra");
    Paydunya_Checkout_Store::setTagline("L'élégance n'a pas de prix");
    Paydunya_Checkout_Store::setPhoneNumber(NUMERO_DE_TELEPHONE_DE_VOTRE_ENTREPRISE);
    Paydunya_Checkout_Store::setPostalAddress(ADRESSE_DE_VOTRE_ENTREPRISE);

Le client sera redirigé vers cette URL au cas où il annulait le paiement de sa commande sur le site web de PAYDUNYA

    Paydunya_Checkout_Store::setCancelUrl(URL_DE_REDIRECTION_APRES_ANNULATION);

PAYDUNYA redirigera automatiquement le client à cette adresse URL après un paiement fructueux.
Cette configuration est facultative et il fortement recommandé de ne pas s'en servir, à moins que vous voulez personnaliser l'expérience de paiement de vos clients.
Si cette URL de redirection n'est pas définie, PAYDUNYA redirigera le client vers une page affichant son reçu électronique.

    Paydunya_Checkout_Store::setReturnUrl(URL_DE_REDIRECTION_APRES_SUCCES);

## Créer une facture de paiement avec redirection sur notre plateforme

    $co = new Paydunya_Checkout_Invoice();

## Créer un paiement sans redirection

    co = new Paydunya_Onsite_Invoice();

Les paramètres attendus sont nom du produit, la quantité, le prix unitaire,
le prix total et une description optionelle. `addItem(nom_du_produit, quantité, prix_unitaire, prix_total, description_optionelle)`

    $co->addItem("Clavier DELL", 2, 3000, 6000);
    $co->addItem("Ordinateur Lenovo L440", 1, 400000, 400000, "Réduction de 10%");
    $co->addItem("Casque Logitech", 1, 8000, 8000);


## Configuration du montant total de la facture! Important

    $co->setTotalAmount(6500);

## Ajouter une description de facture (Optionnel)

    $co->setDescription("Adapté regrouper les tables de prix sur votre site web.");

## Ajout de taxes (Optionnel)

    $co->addTax('TVA (18%)', 5000);
    $co->addTax('Autre taxe', 700);

## Ajout de données supplémentaires que vous pourrez récupérer par la suite

    $co->addCustomData("Prénom", "Badara");
    $co->addCustomData("Nom", "Alioune");
    $co->addCustomData("CartId", 97628);
    $co->addCustomData("Coupon","NOEL");

## Redirection vers la page de paiement

    if($co->create()) {
       header("Location: ".$co->getInvoiceUrl());
    }else{
      echo $co->response_text;
    }

## Paiement de facture Sans Redirection (PSR)

La première étape consiste à récupérer l'adresse email ou le numéro de téléphone du client PAYDUNYA.
Passer le ensuite en paramètre la méthode `create` d'une instance de la classe `Paydunya_Onsite_Invoice`.
PAYDUNYA vous renverra un token PSR. Le client PAYDUNYA recevra également un code de confirmation par e-mail et SMS (uniquement pour les transactions réelles).

        if($co->create("EMAIL_OU_NUMERO_DU_CLIENT_PAYDUNYA")) {
           $opr_token = $co->token;
        }else{
          echo $co->response_text;
        }

La seconde étape nécessite que vous récupérer le code de confirmation envoyé au client, y ajouter votre token PSR pour ensuite facturer réellement le client. En cas de succès de paiement, vous devriez être en mesure d'accéder à l'URL du reçu électronique et d'autres informations listées au niveau de la documentation officielle.

    if($co->charge("TOKEN_PSR", "CODE_DE_CONFIRMATION_DU_CLIENT")){
        $receipt = $co->receipt_url;
        $customer_name = $co->customer["name"];
    }else{
        echo $co->response_text;
    }

## Transfert d'argent via le service de Paiement Direct
Vous pouvez transférer des fonds vers d'autres comptes clients PAYDUNYA à partir de votre compte via l'API de Paiement Direct.

Cette option s'avère très intéressante si vous souhaitez créer votre propre solution de paiement par dessus celle de PAYDUNYA.

    $direct_pay = new Paydunya_DirectPay();
    if ($direct_pay->creditAccount("EMAIL_OU_NUMERO_MOBILE_DU_CLIENT_PAYDUNYA", MONTANT_A_TRANSFERER)) {
      echo $direct_pay->description."\n";
      echo $direct_pay->response_text."\n";
      echo $direct_pay->transaction_id."\n";
    }else{
      echo $direct_pay->response_text."\n";
    }

## Télécharger une application exemple écrite en PHP
https://github.com/paydunya/Paydunya_PHP_Demo_Store

## Contribuer

1. Faire un Fork de ce dépôt
2. Créer une nouvelle branche (`git checkout -b nouvelle-fonctionnalite`)
3. Faire un commit de vos modifications (`git commit -am "Ajout d'une nouvelle fonctionnalité"`)
4. Faire un Push au niveau de la branche (`git push origin nouvelle-fonctionnalite`)
5. Créer un Pull Request