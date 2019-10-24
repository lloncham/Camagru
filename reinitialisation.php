<?php
include('pdo.php');
include('mail.php');
session_start();
$db = dbconnect();
if ($_POST['mail'] !== NULL && $_POST['mail'] !== "")
{
    $rep = $db->prepare('SELECT mail FROM compte WHERE mail=:mail');
    $rep->execute(array(
        'mail' => $_POST['mail'],
    ));
    $donnees = $rep->fetch();
    $rep->closeCursor();
}
if ($donnees == NULL)
    echo "introuvable";
else 
{
    resetaccount($_POST['mail'], $db);
    // header("location: index.php");
}
?>
