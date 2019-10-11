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
    mail("lisalonchamp@yahoo.fr", "Welcome!", "coucou\n");
    header("location: index.php");}
?>
