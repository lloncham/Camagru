<?php
include('pdo.php');

session_start();
$db = dbconnect();
if ($_POST['submit'] == "OK" && $_POST['login'] !== NULL && $_POST['passwd'] !== NULL && $_POST['e-mail'] !== NULL
&& $_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['e-mail'] !== "")
{
    $mail = $_POST['e-mail'];
    $identifiant = $_POST['login'];
    $passwd = hash("sha512", $_POST['passwd']);

    $req = $db->prepare('INSERT INTO compte(mail, identifiant, mdp) VALUES (:mail, :identifiant, :mdp)');
    $req->execute(array(
        'mail' => $mail,
        'identifiant' => $identifiant,
        'mdp' => $passwd,
    ));
}
?>