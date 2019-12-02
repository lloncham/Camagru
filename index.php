<html>
    <head>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css"
        />
        <script
            defer
            src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"
        ></script>
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

        <meta charset="utf-8" />
        <title>Camagru</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="section">
            <div class="container">
                <?php
                include('pdo.php');
                error_reporting(E_ALL);

                if (session_status() != PHP_SESSION_ACTIVE)
                    session_start();

                $db = dbconnect();

                $rep = $db->prepare('SELECT * FROM image as img LEFT JOIN compte as co ON img.iduser = co.id');
                $rep->execute();

                $donnees = $rep->fetchAll();
                $rep->closeCursor();
                foreach ($donnees as $tab)
                {
                    if ($tab['img'])
                        echo '
                            <div class="columns">
                                <div class="column is-8 is-offset-2">
                                    <div class="card">
                                        <div class="card-image">
                                            <figure class="image is-fullwidth">
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
                                                    <p class="title is-4">'. $tab['identifiant'] .'</p>
                                                    <p class="subtitle is-6">' . $tab['date'] . '</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
                ?>
            </div>
        </div>
    </body>
</html>