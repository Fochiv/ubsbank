<?php
require_once("connect.php");
if(isset($_GET['code'])){
  $code=$_GET['code'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UBS bank|information transaction</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  

  <!-- =======================================================
  * Template Name: BizLand
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <style>

*{
    margin:0;
    padding:0;
    
}
#progressbar{
  width:90%;
  height:40px;
  border:2px solid black;
  margin-left:5%;
}

#content p{
  text-align: center;
  color: #fff;
  padding: 10px;
}

body{
    background: url(../assets/img/hero-bg.jpg);
    /* background-size: cover; */
    background-position: center;
}
.wrapper{
    width:420px;
    /* position: absolute;
    top:10%;
    left:32%; */
    background:transparent; 
    /* color: #fff; */
    border: 2px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(20px); 
    box-shadow: 0 0 10px rgba(0.9,0.9,0.9,1);
    border-radius: 10px;
    /* padding:30px 40px; */
    margin-left: 32%;
    

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
section{
  backdrop-filter: blur(10px); 
}
section h2,h5{
  text-align:center;
}
@media screen and (min-width:340px) and (max-width:360px) {
  .wrapper{
    width:100%;
    position: static;
    backdrop-filter: blur(30px); 
    margin:0;
  }
}
@media screen and (min-width:360px) and (max-width:380px) {
    .wrapper{
    width:100%;
    position: static;
    backdrop-filter: blur(30px); 
    margin:0;
  }
}
@media screen and (min-width:380px) and (max-width:400px) {
    .wrapper{
    width:100%;
    position: static;
    backdrop-filter: blur(30px); 
    margin:0;
  }
}
@media screen and (min-width:400px) and (max-width:420px) {
    .wrapper{
    width:100%;
    position: static;
    backdrop-filter: blur(30px); 
    margin:0;
  }
}
@media screen and (min-width:420px) and (max-width:440px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:440px) and (max-width:460px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:460px) and (max-width:480px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:480px) and (max-width:500px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:500px) and (max-width:520px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:520px) and (max-width:540px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:540px) and (max-width:560px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:560px) and (max-width:580px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:580px) and (max-width:600px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:600px) and (max-width:620px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:620px) and (max-width:660px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:660px) and (max-width:720px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}  
<?php

$req2=$bdd->query('SELECT * FROM all_for_one WHERE code_swift='.$code.'');
$rep2=$req2->fetch();

 
 ?>
#content{
  width: <?php echo $rep2['etat']?>%;
  height: 36px;
  border: none;
  background: linear-gradient( blue,orange);
}



  </style>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">ubsbank045@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+447476532816</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="../html/index.html">Ubs Bank<span></span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="../index.html">Accueil</a></li>
          <li><a class="nav-link scrollto" href="../index.html">A-propos</a></li>
          <li><a class="nav-link scrollto" href="../index.html">Services</a></li>
          <li><a class="nav-link scrollto " href="../php/code.php">Code-swift</a></li>
          <li><a class="nav-link scrollto" href="../index.html">Contact</a></li>
          <li id="google_translate_element"></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  <section class="loading-bar">
    <h2>virement en cours</h2>
    <h5>cher client veuillez lire attentivement votre suivi</h5>
    <div id="progressbar">
      <div id="content">
        <p><?php  echo $rep2['etat']?>%</p>
      </div>
    </div>
  </section>

    
                <div class="wrapper">
                    <h2>Transaction en cours</h2>
                    <div class=" w2">
                        <ul>
                            <li><b style="blue">Code swift:<?php echo $rep2['code_swift'];?></b></li>
                            <li>Montant transfere:<?php echo $rep2['montant'];?></li>
                            <li>Date de transfert:<?php echo $rep2['date'];?></li>
                            <li>Heure de transfert:<?php echo $rep2['heure'];?></li>
                        </ul>
                    </div>
                    <div class=" w2">
                        <h3>Informations expediteur</h3>
                        <h4>Informations personnelles</h4>
                        <?php
                           
                         ?>                        
                        <ul>
                            <li>Nom:<?php echo $rep2['nom_ex'];?></li>
                            <li>Prenom:<?php echo $rep2['prenom_ex'];?></li>
                            <li>Pays:<?php echo $rep2['pays_ex'];?></li>
                        </ul>
                        <h4>Informations bancaire</h4>
                        <ul>
                            <li>Numero aba:<?php echo $rep2['numero_aba_ex'];?></li>
                            <li>Numero compte:<?php echo $rep2['numero_compte_ex'];?></li>
                            <li>Nom banque:<?php echo $rep2['nom_banque_ex'];?></li>
                            <li>Devise du compte:<?php echo $rep2['devise_compte_ex'];?></li>
                    </ul>
                    </div>
                    <div class=" w2">
                        <h3>Informations Destinataire</h3>
                        <h4>Informations personnelles</h4>
                        <?php
                            
                         ?>  
                        <ul>
                            <li>Nom:<?php echo $rep2['nom_de'];?></li>
                            <li>Prenom:<?php echo $rep2['prenom_de'];?></li>
                            <li>Pays:<?php echo $rep2['pays_de'];?></li>
                        </ul>
                        <h4>Informations bancaires</h4>
                        <ul>
                            <li>Code banque:<?php echo $rep2['code_banque_de'];?></li>
                            <li>Code guichet:<?php echo $rep2['code_guichet_de'];?></li>
                            <li>Numero compte:<?php echo $rep2['numero_compte_de'];?></li>
                            <li>Code bic:<?php echo $rep2['code_bic_de'];?></li>

                        </ul>
                        <?php
                    
                    ?>
                    </div>
                    <h4 style="background:red;">Conditions a respecter</h4>
                    <div class=" w2">
                  <?php  echo $rep2['important'];?><br>
                  <strong style="color:orangered">LE VIREMENT SERA ANNULE DANS LES 72H POUR MANQUE DE JUSTIFICATIFS</strong>
                </div>
                </div>
            <?php

    

?>

 
 

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <script>
  
    function googleTranslateElementInit(){
      new google.translate.TranslateElement(
        {pageLanguage:'fr'},
        'google_translate_element'
      );
    }
  </script>

</body>

</html>
<?php
}else header("location:code.php");