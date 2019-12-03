<?php

include('pdo.php');
include('header.php');

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
$db = dbconnect();
//
if (!array_key_exists('content', $_POST) || !array_key_exists('id_user', $_SESSION))
{
    header("Location : /index.php");    
    exit(0);
}
//
$rep = $db->prepare('INSERT INTO image(iduser, img) VALUES (:iduser, :img)');
$rep->execute(array(
    'iduser' => $_SESSION['id_user'],
    'img' => $_POST['content'],
));
$rep->closeCursor();

?>