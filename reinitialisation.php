<?php
include('pdo.php');
include('mail.php');

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
$db = dbconnect();
if ($_POST['mail'] !== NULL && $_POST['mail'] !== "")
{
    $rep = $db->prepare('SELECT mail FROM compte WHERE mail=:mail');
    $rep->execute(array(
        'mail' => $_POST['mail'],
    ));
    $donnees = $rep->fetch();
    $rep->closeCursor();
    if ($donnees == NULL)
        echo "introuvable";
    else 
        resetaccount($_POST['mail'], $db);
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css"/>
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        
        <meta charset="utf-8" />
        <title>Réinitialiser son compte</title>
    </head>
    <body>
        <?php include('header.php'); ?>
        <div class="section">
            <div class="container">
                <h3 class="title">Password reset</h3>
                <form action="reinitialisation.php" method="POST">
                    <div class="field">
                        <label class="label">E-mail :</label>
                        <div class="control">
                            <input class="input"
                                type="mail"
                                name="mail"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                title="Il ne s'agit pas d'une adresse e-mail valide"
                            />
                        </div>
                    </div>
                    <div class="control">
                      <button class="button is-primary" name="submit" value="OK">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

