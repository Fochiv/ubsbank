<?php
    try{
        $bdd=new PDO('mysql:host=localhost;dbname=ubsbank','root','');
    }
    catch(Exception $e){
        die('Une erreur s\'est produite: '.$e->getMessage());
    }

?>