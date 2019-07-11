<?php
require('conf.php');

$co = new Paydunya_Onsite_Invoice();

// Passer l'identifiant du client en paramètre à la fonction create
if($co->charge($_POST["opr_token"],$_POST["confirmation_code"])) {
  echo $co->response_text;
  echo "<br/> Lien du reçu de paiement <a href=\"".$co->getReceiptUrl()."\">Télécharger</a>";
}else{
  echo($co->response_text);
}
?>
<br/>
<br/>
<a href="index2.php?reset=ok" title="">Retour au site</a>

