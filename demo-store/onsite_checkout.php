<?php
session_start();
require('conf.php');

$co = new Paydunya_Onsite_Invoice();
$total_amount = 0;
foreach ($_SESSION["cart"] as $product) {
  $co->addItem($product['name'],$product['quantity'],$product['unit_price'],$product['total_price']);
  $total_amount += $product['total_price'];
}

$co->setTotalAmount($total_amount);

// Passer l'identifiant du client en paramètre à la fonction create
if($co->create($_POST["account_alias"])) {
  // header("Location: ".$co->getInvoiceUrl());
}else{
  exit($co->response_text);
}
?>
<html>
<head>
  <title>Requête de paiement PSR</title>
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
  </style>
</head>
<body>
<div class="container"><h1>Confirmation de paiement</h1>

<form method="post" action="charge.php">
<input type="text" name="confirmation_code" placeholder="Code de Confirmation">
<input type="hidden" value="<?php echo $co->token; ?>" name="opr_token">
<input type="submit" value="Confimer le paiement">
</form>
</div>
</body>
</html>