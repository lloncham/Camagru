<?php

include('pdo.php');
if (!array_key_exists('submit', $_POST))
{
    if (!array_key_exists('token', $_GET))
    {
        header('Location: /reinitialisation.php');
        exit(0);
    }

    $db = dbconnect();
    $rep = $db->prepare("SELECT id FROM compte WHERE token=:token");
    $rep->execute(array(
        'token' => $_GET['token'],
    ));
    $donnees = $rep->fetch();
    if (!is_array($donnees))
    {
        header('Location: /reinitialisation.php');
        exit(0);
    }
}

if (array_key_exists('submit', $_POST) && array_key_exists('_token', $_POST) && array_key_exists('passwd', $_POST))
{
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();
    $db = dbconnect();

    $token = $_POST['_token'];

    $rep = $db->prepare("SELECT id FROM compte WHERE token=:token");
    $rep->execute(array(
        'token' => $token,
    ));
    $donnees = $rep->fetch();

    echo is_array($donnees);
    if (is_array($donnees) && $_POST['passwd'] !== NULL && $_POST['passwd'] !== "" && $_POST['submit'] == "OK")
    {
        $rep = $db->prepare('UPDATE compte SET mdp=:mdp, token = NULL WHERE token=:token');
        $rep->execute(array(
            'mdp' => hash("sha512", $_POST['passwd']),
            'token' => $token,
        ));
        header('Location: login.php');
    }
    else 
    {
        //echo "echec, votre mot de passe n'a pas pu être réinitialisé";
        header("location: /resetpswd.php?=" . urlencode($token));
    }
    $rep->closeCursor();
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
        <title>Nouveau mot de passe</title>
    </head>
    <body>
        <?php include('header.php'); ?>
        <div class="section">
            <div class="container">
                <form action="resetpswd.php" method="POST">
                    <input type="hidden" name="_token" value="<?php echo $_GET['token']; ?>">
                    <div class="field">
                        <label class="label">New Password :</label>
                        <div class="control">
                            <input class="input" type="password" name="passwd" 
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Doit contenir au moins un chiffre, une majuscule, une minuscule ainsi qu'être composé d'au moins 8 caractères">
                        </div>
                    </div>
                    <div class="control">
                      <button class="button is-primary" name="submit" value="OK">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>