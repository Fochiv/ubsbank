<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpMailler/vendor/autoload.php';

// Fonction pour envoyer un email
function envoi_mail($from_name, $from_mail, $subject, $message){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Debug = 0;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    
    // SÉCURITÉ: Utiliser des variables d'environnement pour les credentials
    // Pour configurer dans Replit: Outils > Secrets > Ajouter un nouveau secret
    // Secrets requis:
    // - SMTP_USERNAME: Votre adresse Gmail
    // - SMTP_PASSWORD: Votre mot de passe d'application Gmail
    $mail->Username = getenv('SMTP_USERNAME') ?: '';
    $mail->Password = getenv('SMTP_PASSWORD') ?: '';
    
    // Vérification que les credentials sont configurés
    if (empty($mail->Username) || empty($mail->Password)) {
        return 'Erreur: Les identifiants SMTP ne sont pas configurés. Veuillez ajouter SMTP_USERNAME et SMTP_PASSWORD dans les Secrets Replit.';
    }
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom($from_mail, $from_name);
    $mail->addAddress($_POST['email'], '');
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->setLanguage('fr', '/optional/path/to/language/directory/');
    
    if(!$mail->Send()){
        return $mail->ErrorInfo;
    } else {
        return true;
    }
}

// Fonction pour afficher une erreur
function error($msg){
    return '<div class="error">
        <p class="p-error">' . htmlspecialchars($msg) . '</p>
    </div>';
}

// Traitement du formulaire
$messageErreur = '';
$messageSucces = '';

if(isset($_POST['send'])){
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if(!empty($nom) && !empty($email)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(!empty($subject) && !empty($message)){
                $msg = envoi_mail($nom, $email, $subject, $message);
                if($msg === true){
                    $messageSucces = 'Email envoyé avec succès!';
                } else {
                    $messageErreur = 'Échec de l\'envoi du mail: ' . $msg;
                }
            } else {
                $messageErreur = 'Veuillez remplir l\'objet et le contenu du mail';
            }
        } else {
            $messageErreur = 'Adresse email invalide';
        }
    } else {
        $messageErreur = 'Veuillez remplir le nom et l\'email';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
  
    <title>Envoi mail | UBS bank</title>
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
    margin:30px 0; 
}
.input-box input{
    width: 100%;
    border:none;
    outline:none;
    border:2px solid rgba(24, 15, 15, 0.2);
    border-radius: 40px;
    font-size: 16px;
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
.success{
    position: absolute;
    top:10px;
    width:95%;
    height:auto;
    padding:10px;
    border: 2px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
.success .p-success{
    text-align: center;
    font-size: 26px;
    color: green;
}
@media screen and (max-width:720px) {
    .wrapper{
        width:100%;
        position: static;
        margin:0;
    }
}
    </style>
</head>
<body>
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:aldofoch@gmail.com">aldofoch@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+237 696485333</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
</section>

<!-- Header -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="../index.html">UBS Bank<span></span></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="../index.html">Accueil</a></li>
          <li><a class="nav-link scrollto " href="code.php">Identifiant de la transaction</a></li>
          <li><a class="nav-link scrollto " href="admin.php">Retour à l'administration</a></li>
          <li id="google_translate_element"></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
    </div>
</header>

<?php if($messageErreur): ?>
    <div class="error">
        <p class="p-error"><?php echo $messageErreur; ?></p>
    </div>
<?php endif; ?>

<?php if($messageSucces): ?>
    <div class="success">
        <p class="p-success"><?php echo $messageSucces; ?></p>
    </div>
<?php endif; ?>

<div class="wrapper">
    <form action="" method="post">
        <h1>Envoyer un mail</h1>
        <div class="input-box">
            <input type="text" name="nom" id="name" placeholder="Entrer le nom" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required>
        </div>
        <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Entrer l'email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        </div>
        <div class="input-box">
            <input type="text" name="subject" id="subject" placeholder="Entrer le sujet" value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>" required>
        </div>
        <div class="input-box">
            <input type="text" name="message" id="message" placeholder="Message" value="<?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?>" required>
        </div>
        <br>
        <input type="submit" value="Envoyer" name="send" class="btn">
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
