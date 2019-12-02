<?php
include("header.php");
include('pdo.php');
include('mail.php');

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
$db = dbconnect();
if (array_key_exists('login_sub', $_POST) && $_POST['login'] !== NULL && $_POST['login'] !== "" && $_POST['passwd'] !== NULL && $_POST['passwd'] !== "")
{
    $rep = $db->prepare('SELECT identifiant, mdp, actif, mail, id FROM compte WHERE identifiant=:identifiant AND mdp=:mdp');
    $rep->execute(array(
        'identifiant' => $_POST['login'],
        'mdp' => hash("sha512", $_POST['passwd']),
    ));
    $donnees = $rep->fetch();
    $rep->closeCursor();
    if ($donnees == NULL)
        echo "introuvable";
    else if ($donnees['actif'] != 1)
        echo "votre compte n'a pas été activé";
    else 
    {
        $_SESSION['loggued_on_user'] = $_POST['login'];
        $_SESSION['id_user'] = $donnees['id'];
        header("location: /index.php");
    }
}
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
        <title>Log in</title>
    </head>
    <body>
        <div class="section">
            <div class="container">
                <form action="login.php" method="POST">
                    <div class="field">
                        <label class="label">Username :</label>
                        <div class="control">
                            <input class="input" type="text" name="login">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Password :</label>
                        <div class="control">
                            <input class="input" type="password" name="passwd">
                        </div>
                    </div>
                    <div class="control">
                      <button class="button is-primary" name="login_sub">Login</button>
                    </div>
                </form>
                <a href="reinitialisation.php">Forgot password?</a>
            </div>
        </div>
    </body>
</html>