<?php
include('pdo.php');
session_start();
$db = dbconnect();
if ($_POST['login'] !== NULL && $_POST['login'] !== "" && $_POST['passwd'] !== NULL && $_POST['passwd'] !== "")
{
    $rep = $db->prepare('SELECT identifiant, mdp, acces FROM compte WHERE identifiant=:identifiant AND mdp=:mdp');
    $rep->execute(array(
        'identifiant' => $_POST['login'],
        'mdp' => $_POST['passwd'],
    ));
    $donnees = $rep->fetch();
    $rep->closeCursor();
}
if ($donnees == NULL)
    echo "introuvable";
else 
    header("location: index.php");
?>
