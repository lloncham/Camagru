<?php

include('pdo.php');

session_start();
$db = dbconnect();
?>

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
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.html">
                    CAMAGRU
                </a>

                <a
                    role="button"
                    class="navbar-burger burger"
                    aria-label="menu"
                    aria-expanded="false"
                    data-target="navbarBasicExample"
                >
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <?php
            if ($_SESSION['loggued_on_user'] !== "" && $_SESSION['loggued_on_user'] !== NULL)
            {
                echo "<div class=\"navbar-menu\">
                <div class=\"navbar-start\">
                    <a class=\"navbar-item\" href=\"index.php\">
                        Home
                    </a>
                    <a class=\"navbar-item\" href=\"image.html\">
                        Take a picture!
                    </a></div>
                    </div>
                    <div class=\"navbar-end\">
                    <div class=\"navbar-item\">
                        <div class=\"buttons\">
                            <a class=\"button is-primary\" href=\"create.html\">
                                <strong>My account</strong>
                            </a>
                            <a class=\"button is-light\" href=\"logout.html\">
                                Log out
                            </a>
                        </div>
                    </div>
                </div></nav>";
            }
            else 
            {
                echo "<div class=\"navbar-end\">
                    <div class=\"navbar-item\">
                        <div class=\"buttons\">
                            <a class=\"button is-primary\" href=\"create.html\">
                                <strong>Sign up</strong>
                            </a>
                            <a class=\"button is-light\" href=\"login.html\">
                                Log in
                            </a>
                        </div>
                    </div>
                </div></nav>
                ";
            }
        $rep = $db->prepare('SELECT * FROM image WHERE iduser=:iduser');
        $rep->execute(array(
            'iduser' => $_SESSION['id_user'],
        ));
        $donnees = $rep->fetchAll();
        $rep->closeCursor();
        foreach ($donnees as $tab)
        {
            if ($tab['img'])
                echo "<div class=\"box\">
                        <article class=\"media\">
                <div class=\"media-content\">
                  <div class=\"content\">
                    <p>
                      <strong>" . $tab['login'] . "</strong> <small>" . $tab['date'] . "</small> <br>
                      <img src=\" " . $tab['img'] . "\">
                    </p>
                  </div>
                  <nav class=\"level is-mobile\">
                    <div class=\"level-left\">
                      <a class=\"level-item\" aria-label=\"like\">
                        <span class=\"icon is-small\">
                          <i class=\"fas fa-heart\" aria-hidden=\"true\"></i>
                        </span>
                      </a>
                    </div>
                  </nav>
                </div>
              </article>
            </div>";
        }
        ?>