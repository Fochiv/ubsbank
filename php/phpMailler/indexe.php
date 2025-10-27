<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// require './PHPMailer/src/Exception.php';
// require './PHPMailer/src/PHPMailer.php';
// require './PHPMailer/src/SMTP.php';
//avec ces lignes ont a pu importés les librairies

function envoi_mail($from_name,$from_mail,$subject,$message){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Debug = 0;
    $mail->SMTPSecure ='ssl';
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth =true;
    $mail->Username="cyrillerasgado@gmail.com";
    $mail->Password="hmldsrmwegqwhcak";
    $mail->SMTPSecure=PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom($from_mail,$from_name);
    // $mail->addAddress('woofinternationnalairlines@outlook.fr','CyrilleCompt');
    $mail->addAddress('cyrillerasgado@gmail.com','CyrilleCompt');
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->setLanguage('fr','/optional/path/to/language/directory/');
    
    
    if(!$mail->Send()){
       return  $mail->ErrorInfo;
    }else{
        return true;
    }
}


$mesg = envoi_mail($_POST['nom'],$_POST['email'],$_POST['subject'],$_POST['message']);
// if($mesg=="true"){echo "lundi";} else {echo "mardi";}
echo $mesg;

// }
// else{
//     echo "Une erreur s'est produite";
// }