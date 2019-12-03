<?php
include("header.php");
include("pdo.php");
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css"/>
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <script src="image.js"></script>
    </head>
    <body>
        <div class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <video  id="video"></video>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <button class="button is-primary" id="startbutton">Take picture</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <button class="button is-primary" id="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="columns is-mobile is-multiline">
<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
$db = dbconnect();
$rep = $db->prepare('SELECT img, date FROM image WHERE iduser=:id');
$rep->execute(array(
    'id' => $_SESSION['id_user'],
));
$donnees = $rep->fetchAll();
foreach ($donnees as $tab)
{
    if ($tab['img'])
        echo '
                <div class="column">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-128x128">
                                <img src=" ' . $tab['img'] . '">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-left">
                                    <figure class="image is-48x48">
                                    <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <p class="title is-4">'. $_SESSION['loggued_on_user'] .'</p>
                                    <p class="subtitle is-6">' . $tab['date'] . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
}
$rep->closeCursor();
?>
</div>
    </body>
    <script>
        photo();
        $("#save").click(function() {
            var canvas = document
                .getElementById("canvas")
                .toDataURL("image/png");
            $.ajax({
                type: "POST",
                url: "/save_img.php",
                dataType: "text",
                data: { content: canvas }
            });
        });
    </script>
</html>

