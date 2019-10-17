<?php

include('pdo.php');
session_start();
$db = dbconnect();

$ID = $_GET['id'];
$token = $_GET['token'];

$rep = $db->prepare("SELECT token, actif FROM compte WHERE ID=:ID");
$rep->execute(array(
    'ID' => $ID,
));
$donnees = $rep->fetch();

if ($donnees['actif'] == 1){
    echo "Votre compte est déjà actif!";
}
else if ($token == $donnees['token']) {
    echo "Votre compte est maintenant actif!";
    $rep = $db->prepare("UPDATE compte SET actif=1 WHERE ID=:ID");
    $rep->execute(array(
        'ID' => $ID,
    ));
}
else {
    echo "Votre compte n'a pas pu être activé!";
}

$rep->closeCursor(); 