<?php

require('paydunya_php/paydunya.php'); // Assurez vous que le fichier est inclus relativement à votre arborescence
Paydunya_Setup::setMasterKey("wQzk9ZwR-Qq9m-0hD0-zpud-je5coGC3FHKW");
Paydunya_Setup::setPublicKey("test_public_kb9Wo0Qpn8vNWMvMZOwwpvuTUja");
Paydunya_Setup::setPrivateKey("test_private_rMIdJM3PLLhLjyArx9tF3VURAF5");
Paydunya_Setup::setMode("test");
Paydunya_Setup::setToken("IivOiOxGJuWhc5znlIiK");

$direct_pay = new Paydunya_DirectPay();

if ($direct_pay->creditAccount("776727563", 5000)) {
  echo $direct_pay->description."<br/>";
  echo $direct_pay->response_text."<br/>";
  echo $direct_pay->transaction_id."<br/>";
}else{
  echo $direct_pay->response_text."<br/>";
}