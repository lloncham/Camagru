<?php
include('pdo.php');
session_start();
$db = dbconnect();
if ($_POST['login'] !== NULL && $_POST['login'] !== "" && $_POST['passwd'] !== NULL && $_POST['passwd'] !== "")
{
    $rep = $db->prepare('SELECT identifiant, mdp FROM compte WHERE identifiant=:identifiant AND mdp=:mdp');
    $rep->execute(array(
        'identifiant' => $_POST['login'],
        'mdp' => hash("sha512", $_POST['passwd']),
    ));
    $donnees = $rep->fetch();
    $rep->closeCursor();
}
if ($donnees == NULL)
    echo "introuvable";
else 
{
    $_SESSION['loggued_on_user'] = $_POST['login'];
    header("location: /index.php");
}
?>
