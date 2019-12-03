<?php

include('pdo.php');

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
$db = dbconnect();

if (!array_key_exists('comment', $_POST) || !array_key_exists('id_img', $_POST) || !array_key_exists('id_user', $_SESSION))
{
    header("Location : /index.php");    
    exit(0);
}
$comment = $_POST['comment'];
$id_user = $_SESSION['id_user'];
$id_img = $_POST['id_img'];
$req = $db->prepare('INSERT INTO comment(id_img, id_user, comment) VALUES (:id_img, :id_user, :comment)');
    $req->execute(array(
        'id_img' => $id_img,
        'id_user' => $id_user,
        'comment' => $comment,
    ));
$req->closeCursor();
header("location: /photo.php?id_img=" . urlencode($id_img));