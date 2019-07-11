<?php
require('conf.php');

$co = new Paydunya_Checkout_Invoice();
?>
<html>
<head>
  <title>La boutique de Sandra</title>
  <style type="text/css">
    body{
      background-color: #272727;
      font-family: Arial;
      font-size: 14px;
    }
    h1{
      font-weight: 500;
    }
    .container{
      margin:60px auto 0 auto;
      width:600px;
      min-height: 400px;
      background-color: #fafafa;
      border: 1px solid #e4e4e4;
      padding: 15px 30px;
    }
    input[type="text"]{
      padding:4px;
      display: block;
      width:300px;
      margin-bottom: 8px;
    }
    table{
      width:100%;
      margin-bottom: 50px;
    }
    th{
      background: #282828;
      color:#fff;
      text-align: left;
      padding:8px;
      font-weight: 300;
      font-size: 13px;
    }
    td{
      padding:8px;
      font-size: 13px;
      border-bottom: 1px solid #e4e4e4;
    }
    .checkout{
      background: #2c8211;
      padding:10px;
      font-size: 16px;
      font-weight: bold;
      color:#fff;
    }
    .success {
      padding:8px;
      background-color: #067416;
      color:#ffffff;
    }
    .fail {
      padding:8px;
      background-color: #920b00;
      color:#ffffff;
    }
  </style>
</head>
<body>
<div class="container"><h1>Confirmation de paiement</h1>
<?php
// La méthode confirm returne true ou false dépendamment du statut du paiement.
// Vous pouvez donc utiliser une instruction if - else et gérer le résultat
// comme bon vous semble
if ($co->confirm()) { ?>
  <div class="success">Facturée réglée avec succès</div>
  <p><strong>Nom du client:</strong> <?php echo $co->getCustomerInfo('name') ."<br/>" ; ?></p>
  <p><strong>Email du client:</strong> <?php echo $co->getCustomerInfo('email') ."<br/>"; ?></p>
  <p><strong>Téléphone du client:</strong> <?php echo $co->getCustomerInfo('phone') ."<br/>"; ?></p>
  <p><a href="<?php echo $co->getReceiptUrl(); ?>" target="_blank">Télécharger le reçu de paiement</a></p>
<?php
  }else{
  echo '<div class="fail">Facture non payée: '.$co->response_text.'</div>';
}
?>
</div>
</body>
</html>