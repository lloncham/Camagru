<html>
    <head>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css"/>
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

        <meta charset="utf-8" />
        <title>Photo</title>
    </head>
    <body>
<?php
include("header.php");
include('pdo.php');

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
$db = dbconnect();

$rep = $db->prepare('SELECT * FROM comment as com LEFT JOIN image as im ON com.id_img=im.id WHERE im.id=:id');
$rep->execute(Array(
    'id' => $_GET['id_img'],
));
$donnees = $rep->fetchAll();
echo '
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-8 is-offset-2">
                <div class="card">
                    <div class="card-image"> 
                        <figure class="image is-fullwidth">
                            <img src="' . $donnees[0]['img']. '">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';