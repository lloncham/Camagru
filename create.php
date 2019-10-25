<?php

include('pdo.php');
include('mail.php');
session_start();

$db = dbconnect();

if ($_POST['submit'] == "OK" && $_POST['login'] !== NULL && $_POST['passwd'] !== NULL && $_POST['e-mail'] !== NULL
&& $_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['e-mail'] !== "")
{
    $mail = $_POST['e-mail'];
    $identifiant = $_POST['login'];
    $passwd = hash("sha512", $_POST['passwd']);

    $req = $db->prepare('SELECT identifiant, mail FROM compte WHERE identifiant=:identifiant OR mail=:mail');
    $req->execute(array(
        'identifiant' => $identifiant,
        'mail' => $mail,
    ));
    $donnees = $req->fetch();
    if ($donnees['identifiant'] == $identifiant){
        echo "identifiant déjà existant";
    }
    else if ($donnees['mail'] == $mail){
        echo "mail déjà existant";
    }
    else {
        $req = $db->prepare('INSERT INTO compte(mail, identifiant, mdp) VALUES (:mail, :identifiant, :mdp)');
        $req->execute(array(
            'mail' => $mail,
            'identifiant' => $identifiant,
            'mdp' => $passwd,
        ));
        activaccount($mail, $db);
        header('location: /login.html');
    }
}
?>