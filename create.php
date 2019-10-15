<?php
include('pdo.php');
session_start();
    $db = dbconnect();
if ($_POST['submit'] == "OK" && $_POST['login'] !== NULL && $_POST['passwd'] !== NULL && $_POST['e-mail'] !== NULL
&& $_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['e-mail'] !== "")
{
    $mail = $_POST['e-mail'];
    $identifiant = $_POST['login'];
    $passwd = hash(whirlpool, $_POST['passwd']);
    $acces = 0;
    $req = $db->prepare('INSERT INTO compte(mail, identifiant, mdp, acces) VALUES (:mail, :identifiant, :mdp, :acces)');
    $req->execute(array(
        'mail' => $mail,
        'identifiant' => $identifiant,
        'mdp' => $passwd,
        'acces' => $acces,
    ));
// ini_set( 'display_errors', on);
// errot_reporting( E_ALL );
$from = "contact@camagru.com";
$to ="lisalonchamp@yahoo.fr";
$subject = "Vérification PHP Mail";
$message = "PHP mail marche";
$headers = "From:" . $from;
if(mail($to,$subject,$message, $headers))
    $_SESSION['message'] = "un message a été envoyé a votre messagerie pour activer votre compte";
    unset($_POST);
}else{
    $_SESSION['erreur'] ="une erreur est survenue lors de l'envoie du fichier. ";
}
// echo "L'email a été envoyé.";}
//header("location: index.php");}
?>