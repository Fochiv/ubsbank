<?php
require_once("connect.php");
?>
<?php
   $req=$bdd->query('SELECT * FROM all_for_one');
  
    while($rep=$req->fetch()){
    ?>
    
                <div class="wrapper">
                    <h2>Transaction N°<?php echo $rep['id'];?></h2>
                    <div class=" w2">
                        <ul>
                            <li><b style="blue">Code swift:<?php echo $rep['code_swift'];?></b></li>
                            <li>Montant transfere:<?php echo $rep['montant'];?></li>
                            <li>Date de transfert:<?php echo $rep['date'];?></li>
                            <li>Heure de transfert:<?php echo $rep['heure'];?></li>
                        </ul>
                    </div>
                    <div class=" w2">
                        <h3>Informations expediteur</h3>
                        <h4>Informations personnelles</h4>
                        <?php
                           
                         ?>                        
                        <ul>
                            <li>Nom:<?php echo $rep['nom_ex'];?></li>
                            <li>Prenom:<?php echo $rep['prenom_ex'];?></li>
                            <li>Pays:<?php echo $rep['pays_ex'];?></li>
                        </ul>
                        <h4>Informations bancaire</h4>
                        <ul>
                            <li>Numero aba:<?php echo $rep['numero_aba_ex'];?></li>
                            <li>Numero compte:<?php echo $rep['numero_compte_ex'];?></li>
                            <li>Nom banque:<?php echo $rep['nom_banque_ex'];?></li>
                            <li>Devise du compte:<?php echo $rep['devise_compte_ex'];?></li>
                    </ul>
                    </div>
                    <div class=" w2">
                        <h3>Informations Destinataire</h3>
                        <h4>Informations personnelles</h4>
                        <?php
                            
                         ?>  
                        <ul>
                            <li>Nom:<?php echo $rep['nom_de'];?></li>
                            <li>Prenom:<?php echo $rep['prenom_de'];?></li>
                            <li>Pays:<?php echo $rep['pays_de'];?></li>
                        </ul>
                        <h4>Informations bancaires</h4>
                        <ul>
                            <li>Code banque:<?php echo $rep['code_banque_de'];?></li>
                            <li>Code guichet:<?php echo $rep['code_guichet_de'];?></li>
                            <li>Numero compte:<?php echo $rep['numero_compte_de'];?></li>
                            <li>Code bic:<?php echo $rep['code_bic_de'];?></li>

                        </ul>
                        <?php
                    
                    ?>
                    </div>
                </div>
            <?php

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/admin.css">
    <!-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste des transactions|UBS bank</title>
</head>
<body>
    
</body>
</html>

<style>


body{
    background: url(../assets/img/hero-bg.jpg);
    background-size: cover;
    background-position: center;
}
.wrapper{
    width:420px;
    background:transparent; 
    border: 2px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(20px); 
    box-shadow: 0 0 10px rgba(0.9,0.9,0.9,1);
    border-radius: 10px;
    padding:30px 40px;
    margin-left: 30%;
    margin-top: 30px;

}
.w2{
    width:400px;
    border: 2px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(20px); 
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    border-radius: 10px;
    background:transparent;
    margin: 7px;
    padding: 10px;

}
.wrapper  h2,h3,h4{
    text-align: center;
}
.wrapper .w2 ul li{
    list-style-type: none;
}
@media screen and (min-width:340px) and (max-width:360px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:380px) and (max-width:400px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:400px) and (max-width:420px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
    
  }
@media screen and (min-width:420px) and (max-width:440px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:440px) and (max-width:460px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:460px) and (max-width:480px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:480px) and (max-width:500px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
  }
@media screen and (min-width:500px) and (max-width:520px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:520px) and (max-width:540px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:540px) and (max-width:560px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:560px) and (max-width:580px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:580px) and (max-width:600px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:600px) and (max-width:620px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:620px) and (max-width:660px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
}
@media screen and (min-width:660px) and (max-width:720px) {
    .wrapper{
    width:100%;
    position: static;
    margin: 0;
    padding:0;
  }
  .w2{
    width:90%;
    margin: 5px;
    padding: 5px;
  }
} 
</style>
