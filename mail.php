<?php

include("pdo.php");

function sendmail($to, $subject, $message){
    $from = "contact@camagru.fr";
    $headers = "From:" . $from;
    
    if (mail($to, $subject, $message, $headers) == TRUE){
        echo "E-mail envoyé avec succès!";
    }
    else{
        echo "Echec de l'envoi";
    }
}

function createcountmail($to, $token, $ID){
    $subject = "Bienvenue chez Camagru";
    $message = "Bienvenue sur Camagru,\n Pour activez votre compte cliquez sur le lien ci-dessous!\n
    http://localhost:8080/Camagru/activation.php?id='.urlencode($ID).'&token='.urlencode($token).'\n
    ---------------\nCeci est un mail automatique, Merci de ne pas y répondre.";
    sendmail($to, $subject, $message);
}

function createtoken(){
    $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $new_char = str_shuffle($char);
    $new_char = substr($new_char, 0, 5);
    return ($new_char);
}

function stocktoken($ID, $token){
    $db = dbconnect();
    $req = $db->prepare('UPDATE compte SET token=:token WHERE ID=:ID');
    $req->execute(array(
        'token' => $token,
        'ID' => $ID,
    ));
}

?>