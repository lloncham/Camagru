<?php

function sendmail($to, $subject, $message){
    $from = "lisalonchamp@yahoo.fr";
    $headers = "From:" . $from;
    
    if (mail($to, $subject, $message, $headers) == TRUE){
        echo "E-mail envoyé avec succès!";
    }
    else{
        echo "Echec de l'envoi";
    }
}

function createtoken(){
    $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $new_char = str_shuffle($char);
    $new_char = substr($new_char, 0, 5);
    return ($new_char);
}

echo createtoken();

?>