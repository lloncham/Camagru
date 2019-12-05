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

if ($donnees != NULL)
{
    $com = 1;
    $img = $donnees[0]['img'];
    $date = $donnees[0]['date'];
    $id_user = $donnees[0]['iduser'];
}
if ($donnees == NULL)
{
    $rep = $db->prepare('SELECT * FROM image WHERE id=:id');
    $rep->execute(Array(
        'id' => $_GET['id_img'],
    ));
    $com = 0;
    $donnees = $rep->fetch();
    $img = $donnees['img'];
    $date = $donnees['date'];
    $id_user = $donnees['iduser'];
}
$rep = $db->prepare('SELECT identifiant FROM compte WHERE id=:id_user');
$rep->execute(Array(
    'id_user' => $id_user, 
));
$rec = $rep->fetch();
echo '
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-8 is-offset-2">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="data:image/jpeg;base64,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" alt="Placeholder image">
                            </figure>
                        </div>
                            <div class="media-content">
                            <p class="title is-4">'. $rec['identifiant'] .'</p>
                            <p class="subtitle is-6">' . $date . '</p>
                        </div>
                    </div>
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-fullwidth">
                                    <img src="' . $img . '">
                                    <nav class="level is-mobile">
                                        <div class="level-left">
                                            <a class="level-item">
                                                <span class="icon is-large"><i class="fas fa-heart"></i></span>
                                            A REMPLACER</a>
                                        </div>
                                    </nav>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">';
        if ($com == 1)
        {
            foreach ($donnees as $tab)
            {
                $rep = $db->prepare('SELECT identifiant FROM compte WHERE id=:id_user');
                $rep->execute(Array(
                    'id_user' => $tab['id_user'], 
                ));
                $rec = $rep->fetch();
                $rep->closeCursor();
                    echo '
                        <article class="media">
                          <figure class="media-left">
                            <p class="image is-64x64">
                              <img src="https://bulma.io/images/placeholders/128x128.png">
                            </p>
                          </figure>
                          <div class="media-content">
                            <div class="content">
                              <p>
                                <strong>'. $rec['identifiant'] .'</strong> <small>' . $tab[4] . '</small>
                                <br>
                                ' . $tab['comment'] . '
                              </p>
                            </div>
                          </div>
                          <div class="media-right">
                            <button class="delete"></button>
                          </div>
                        </article>';
            }
        }
        echo '
        </div></div>
';
        if (array_key_exists('loggued_on_user', $_SESSION) && $_SESSION['loggued_on_user'] !== "" && $_SESSION['loggued_on_user'] !== NULL)
        {
            echo '
            <div class="section">
            <div class="container">
            <form method="POST" action="comment.php">
            <article class="media">
                <figure class="media-left">
                    <p class="image is-64x64">
                        <img src="https://bulma.io/images/placeholders/128x128.png">
                    </p>
                </figure>
                <div class="media-content">
                    <div class="field">
                        <p class="control">
                            <input type="hidden" name="id_img" value="' . $tab['id'] . '">
                            <textarea name="comment" class="textarea" placeholder="Add a comment..."></textarea>
                        </p>
                    </div>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <div class="control">
                                    <button class="button is-primary" name="login_sub">Submit</button>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </article>
        </form>
            </div>
        </div>';
        } 