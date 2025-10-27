<?php
    function error($msg){
        ?>
            <div class="error">
                <p class="p-error"><?php echo $msg ?></p>
            </div>
        <?php
    }
?>
<?php

     if(isset($_POST['sendAd'])){
         $nomE=$_POST['nomE'];
         $prenomE=$_POST['prenomE'];
         $paysE=$_POST['paysE'];
         $NA=$_POST['NA'];
         $NCE=$_POST['NCE'];
         $NB=$_POST['NB'];
         $DC=$_POST['DC'];
         $MO=$_POST['MO'];
         $nomD=$_POST['nomD'];
         $prenomD=$_POST['prenomD'];
         $paysD=$_POST['paysD'];
         $CB=$_POST['CB'];
         $CG=$_POST['CG'];
         $NCD=$_POST['NCD'];
         $CBI=$_POST['CBI'];
         $key="01234567";
         $swift=str_shuffle($key);
         $dt=$_POST['DT'];
         $ht=$_POST['HT'];
         $email=$_POST['email'];
         $important='Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO:+447476532816';

         
                              
         

         if(!empty($nomE) AND !empty($prenomE) AND !empty($paysE)){
             if(!empty($NA) AND !empty($NCE)){
                 if(!empty($NB) AND !empty($DC) AND !empty($MO)){
                     if(!empty($nomD) AND !empty($prenomD) AND !empty($paysD)){
                         if(!empty($CB) AND !empty($CG)){
                             if(!empty($NCD) AND !empty($CBI) AND($email)){
                                
                                  
                                require_once("connect.php");
                                //********NEW
                                $req=$bdd->prepare('INSERT INTO all_for_one(nom_ex,prenom_ex,pays_ex,numero_aba_ex,numero_compte_ex,nom_banque_ex,devise_compte_ex,montant,date,heure,nom_de,prenom_de,pays_de,email_de,code_banque_de,code_guichet_de,numero_compte_de,code_bic_de,code_swift,etat,important)VALUES(:ne,:pe,:pae,:nae,:nce,:nbe,:dce,:mo,:de,:he,:nd,:pd,:pad,:ed,:cbd,:cgd,:ncd,:cbid,:cs,:etd,:im) ');
                                $req->execute(array(
                                'ne'=>$nomE,
                                'pe'=>$prenomE,
                                'pae'=>$paysE,
                                'nae'=> $NA,
                                'nce'=>$NCE,
                                'nbe'=>$NB,
                                'dce'=>$DC,
                                'mo'=>$MO,
                                'he'=>$ht,
                                'de'=>$dt,
                                'nd'=>$nomD,
                                'pd'=>$prenomD,
                                'pad'=>$paysD,
                                'ed'=> $email,
                                'cbd'=>$CB,
                                'cgd'=> $CG,
                                'ncd'=>$NCD,
                                'cbid'=>$CBI,
                                'cs'=> $swift,
                                'etd'=>10,
                                'im'=> $important
                                ));


 
         
         
        
         
         
         
         
         
         
         
         
        
         
         
      
        
        
        
        
                                
                                
                                
                                //*******LAST
                                /*$req=$bdd->prepare('INSERT INTO expediteur(nom,prenom,pays,numero_aba,numero_compte,nom_banque,devise_compte) VALUES(:nom,:prenom,:pays,:na,:nc,:nb,:dc)');
                                $req->execute(array(
                                    'nom'=>$nomE,
                                    'prenom'=>$prenomE,
                                    'pays'=>$paysE,
                                    'na'=>$NA,
                                    'nc'=>$NCE,
                                    'nb'=>$NB,
                                    'dc'=>$DC,
                                ));
                                $req3=$bdd->query('SELECT max(id_expediteur) as max_id FROM expediteur');
                                $rep3=$req3->fetch();

                                $req1=$bdd->prepare('INSERT INTO destinataire(id_expediteur,nom,prenom,pays,code_banque,code_guichet,numero_compte,code_bic,adresse_mail) VALUES(:ie,:nom,:prenom,:pays,:cb,:cg,:ncd,:cbi,:am)');
                                $req1->execute(array(
                                    'ie'=>$rep3['max_id'],
                                    'nom'=>$nomD,
                                    'prenom'=>$prenomD,
                                    'pays'=>$paysD,
                                    'cb'=>$CB,
                                    'cg'=>$CG,
                                    'ncd'=>$NCD,
                                    'cbi'=>$CBI,
                                    'am'=>$email
                                  
                                ));
                                $req2=$bdd->prepare('INSERT INTO transfert(id_expediteur,montant,code_swift,date_transaction,heure_transaction,avancement,important) VALUES (:ie,:montant,:cs,:dt,:ht,:av,:im)');
                                $req2->execute(array(
                                    'ie'=>$rep3['max_id'],
                                    'montant'=>$MO,
                                    'cs'=>$swift,
                                    'dt'=>$dt,
                                    'ht'=>$ht,
                                    'av'=>10,
                                    'im'=>$important
                                ));
                                */
                                
                                header("location:list.php");
                              
                             }else error('Veuillez remplir le numero de compte destinataire,le code BIC ou l\'adresse mail du destinataire');
                            
                         }else error('Veuillez remplir le code banque et le code guichet');

                     }else error('Veuillez remplir les informations personnelles Destinataire');

                 }else error('Veillez remplir le nom de la banque,la devise du compte ou le montant de la transaction');

             }else error('veuillez remplir le numero ABA et le numero de compte Expediteur');

         }else error('Veuillez remplir toutes les informations personnelles Expediteur');
         
     }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>UBS bank|Admin</title>
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

body{
    background: url(../assets/img/hero-bg.jpg);
    background-size: cover;
    background-position: center;
}
.wrapper{
    width:420px;
    position: absolute;
    top:20%;
    left:32%;
    background:transparent; 
    /* color: #fff; */
    border: 2px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(20px); 
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    border-radius: 10px;
    padding:30px 40px;

}
.wrapper h1{
    font-size: 36px;
    text-align: center;
}
.wrapper .input-box{
    width:100%;
    height: 50px;
    /*background-color: salmon; */
     margin:30px 0; 
}
.input-box input{
    width: 100%;
    height: 100%;
    /* background: transparent;  */
    border:none;
    outline:none;
    border:2px solid rgba(24, 15, 15, 0.2);
    border-radius: 40px;
    font-size: 16px;
    /* color: #fff ;  */
    padding:20px 45px 20px 20px; 
    text-align: center;
}
.wrapper input[type="submit"]{
    width:95%;
    height:45px;
    background-color: #fff;
    border:none;
    outline:none;
    border-radius: 40px;
    margin:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
    cursor:pointer;
    font-size: 16px;
    color:#333;
    font-weight: 600;
   

}
.error{
    position: absolute;
    top:10px;
    width:95%;
    height:auto;
    padding:10px;
    border: 2px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0,0,0,0.2);

}
.error .p-error{
    text-align: center;
    font-size: 26px;
    color: red;
}
form .bf{
    /* border: 0.5px solid black; */
    margin:10px;
    padding: 20px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}
form .bf legend{
    text-align: center;
}
@media screen and (min-width:340px) and (max-width:360px) {
  .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:360px) and (max-width:380px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:380px) and (max-width:400px) {
    .wrapper{
    width:100%;
    position: static;
    margin:0;
  }
}
@media screen and (min-width:400px) and (max-width:420px) {
    .wrapper{
    width:100%;
    position: static;
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



    </style>
<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">ubsbank045@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span></span></i>
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

      <h1 class="logo"><a href="../html/index.html">UBS Bank<span></span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="../index.html">Accueil</a></li>
          <li><a class="nav-link scrollto " href="../php/code.php">Code-swift</a></li>
          <li><a class="nav-link scrollto " href="../php/list.php">liste des transactions</a></li>
          <li><a class="nav-link scrollto " href="../php/avancement1.php">modifier etat transaction</a></li>
          <li><a class="nav-link scrollto " href="../php/condition.php">modifier condition</a></li>
          <li><a class="nav-link scrollto" href="../php/mail.php">Envoi-mail</a></li>
          <li id="google_translate_element"></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
<div class="wrapper">
    <form action="" method="post">
        <h1>Ajouter une nouvelle transaction</h1>
            <fieldset class="bf">
                <legend>INFORMATIONS EXPEDITEUR</legend>
                <fieldset>
                    <legend>Informations personnelles</legend>

                        <div class="input-box">
                            <input type="text" placeholder="Nom" name="nomE" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Prenom" name="prenomE" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Pays" name="paysE" >
                        </div>
                        

                </fieldset>
                <fieldset>
                    <legend>Informations bancaires</legend>

                        <div class="input-box">
                            <input type="text" placeholder="Numero ABA" name="NA" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="N° de compte" name="NCE" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Nom de la banque" name="NB" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Devise du compte" name="DC" >
                        </div>
                        <div class="input-box">
                            <input type="number" placeholder="Montant transaction" name="MO" >
                        </div>
                        <div class="input-box">
                            <input type="date" placeholder="Date transaction" name="DT" >
                        </div>
                        <div class="input-box">
                            <input type="" placeholder="Heure transaction(00:00:00)" name="HT" >
                        </div>
                </fieldset>
            </fieldset>
            <fieldset class="bf">
                <legend>INFORMATIONS DESTINATAIRE</legend>
                <fieldset>
                    <legend>Informations personnelles</legend>

                        <div class="input-box">
                            <input type="text" placeholder="Nom" name="nomD" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Prenom" name="prenomD" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Pays" name="paysD" >
                        </div>
                        <div class="input-box">
                            <input type="mail" placeholder="email" name="email" >
                        </div>
                        

                </fieldset>
                <fieldset>
                    <legend>Informations bancaires</legend>

                        <div class="input-box">
                            <input type="text" placeholder="Code banque" name="CB" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="code guichet" name="CG" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="N° de compte" name="NCD" >
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Code BIC" name="CBI" >
                        </div>
                       
                </fieldset>
            </fieldset>
            <input type="submit" name="sendAd" value="Enregistrer" class="btn">
    </form>
</div>


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
