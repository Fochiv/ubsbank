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
require_once("connect.php");
if(isset($_POST['send'])){
    if(!empty($_POST['code'])){
        $req=$bdd->prepare('SELECT * FROM all_for_one WHERE code_swift=:cs');
        $req->execute(array('cs'=>$_POST['code']));
        $code=$_POST['code'];
        $user=$req->rowCount();
        if($user==1){
            header("location:condition2.php?code=".$code);
        } else error('ce code swift n\'existe pas dans la base de donnee');

    }else error('veuillez entrer le code swift pour modifier l\'etat de la transaction');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <title>ubs bank|Entrer le code swift</title>
</head>
<body>
    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: roboto,sans-serif;
}
body{
    display:flex;
    justify-content: center;
    align-items:center;
    min-height:100vh;
    background: url(../assets/img/hero-bg.jpg);
    background-size: cover;
    background-position: center;
}
.wrapper{
    width:420px;
    background:transparent;
    color: #fff;
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
    /* background-color: salmon; */
    margin:30px 0;
}
.input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border:none;
    outline:none;
    border:2px solid rgba(255,255,255,0.2);
    border-radius: 40px;
    font-size: 16px;
    color: #fff ;
    padding:20px 45px 20px 20px;
    text-align: center;
}
.input-box input::placeholder{
    color:#fff;
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
    </style>
    

    <div class="wrapper">
        <form action="" method="post">
            <h1>Entrez le code swift de la transcation pour modifier la condition</h1>
            <div class="input-box">
                <input type="password" placeholder="Ex:000-000-000-0" name="code" >
            </div>
            <input type="submit" name="send" value="Consulter" class="btn">

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