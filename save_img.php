<?php

include('pdo.php');

session_start();
$db = dbconnect();

//A CONTINUER

$rep = $db->prepare('INSERT INTO image(iduser, img, login) VALUES (:iduser, :img, :login)');
$rep->execute(array(
    'iduser' => $_SESSION['id_user'],
    'login' => $_SESSION['loggued_on_user'],
    'img' => $_POST['content'],
));


?>