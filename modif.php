<?php

include('pdo.php');
session_start();
$db = dbconnect();

if ($_POST['mail'] !== NULL && $_POST['mail'] !== "" && $_POST['login'] !== NULL && $_POST['login'] !== "" && $_POST['anmdp'] !== NULL && $_POST['anmdp'] !== "" && $_POST['nvmdp'] !== NULL && $_POST['nvmdp'] !== "" && $_POST['confmdp'] !== NULL && $_POST['confmdp'] !== "")
{
    $rep = $db->prepare("SELECT mail, identifiant FROM compte WHERE mail=:mail AND identifiant=:identifiant");
    $rep->execute(array(
        'mail' => $_POST['mail'],
        'identifiant' => $_POST['login'],
    ));
    $donnees = $rep->fetch();
    if ($donnees == NULL)
        echo "compte introuvable";
    else if ($_POST['confmdp'] !== $_POST['nvmdp'])
        echo "mot de passe à confirmer";
    else
    {
        $rep = $db->prepare("UPDATE compte SET mdp=:nvmdp WHERE mdp=:anmdp");
        $rep->execute(array(
            'nvmdp' => hash("sha512", $_POST['nvmdp']),
            'anmdp' => hash("sha512", $_POST['anmdp']),
        ));
        echo "mot de passe changé avec succès";
    }
    $rep->closeCursor();
}
?>