<?php

// include("pdo.php");

function sendmail($to, $subject, $message){
    $from = "contact@camagru.fr";
    $headers = "From:" . $from;
    
    echo $to . "\n";
    echo $subject . "\n";
    echo $message . "\n";

    if (mail($to, $subject, $message, $headers) == TRUE){
        echo "E-mail envoyé avec succès!";
    }
    else{
        echo "Echec de l'envoi";
    }
}

function createaccountmail($to, $token, $ID, $identifiant){
    $subject = "Bienvenue chez Camagru";
    $message = "Bienvenue sur Camagru $identifiant,\n 
    
    Pour activez votre compte cliquez sur le lien ci-dessous!\n

    http://localhost:8080/Camagru/activation.php?id=" .urlencode($ID). "&token=" .urlencode($token). " \n

    ---------------\n
    
    Ceci est un mail automatique, Merci de ne pas y répondre.";
    sendmail($to, $subject, $message);
}

function createtoken(){
    $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $new_char = str_shuffle($char);
    $new_char = substr($new_char, 0, 10);
    return ($new_char);
}

function foundmaildata($mail, $db){
    // $db = dbconnect();
    $rep = $db->prepare('SELECT mail, ID, identifiant, token FROM compte WHERE mail=:mail');
    $rep->execute(array(
        'mail' => $mail,
    ));
    $donnees = $rep->fetch();
    $rep->closeCursor();
    return ($donnees);
}

function activaccount($mail, $db){
    // $db = dbconnect();
    $donnees = foundmaildata($mail, $db);
    $token = createtoken();
    $req = $db->prepare('UPDATE compte SET token=:token WHERE ID=:ID');
    $req->execute(array(
        'token' => $token,
        'ID' => $donnees['ID'],
    ));
    createaccountmail($mail, $token, $donnees['ID'], $donnees['identifiant']);
    $req->closeCursor();
}

?>