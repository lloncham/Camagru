<?php
include('pdo.php');
include('header.php');
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
        <title>Modif</title>
    </head>
    <body>
        <form action="modif.php" method="POST">
            <p>
                Mail :
                <input type="text" name="mail" />
            </p>
            <p>
                Identifiant :
                <input type="text" name="login" />
            </p>
            <p>
                Ancien mot de passe :
                <input type="password" name="anmdp" />
            </p>
            <p>
                Nouveau mot de passe :
                <input
                    type="password"
                    name="nvmdp"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Doit contenir au moins un chiffre, une majuscule, une minuscule ainsi qu'être composé d'au moins 8 caractères"
                />
            </p>
            <p>
                Confirmation nouveau mot de passe :
                <input type="password" name="confmdp" />
            </p>
            <p>
                <input type="submit" name="submit" value="OK" />
            </p>
        </form>
    </body>
</html>

<?php
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();
    $db = dbconnect();

    if ($_POST['mail'] !== NULL && $_POST['mail'] !== "" && $_POST['login'] !== NULL && $_POST['login'] !== "" && $_POST['anmdp'] !== NULL && $_POST['anmdp'] !== "" && $_POST['nvmdp'] !== NULL && $_POST['nvmdp'] !== "" && $_POST['confmdp'] !== NULL && $_POST['confmdp'] !== "")
    {
        $rep = $db->prepare("SELECT mail, identifiant FROM compte WHERE mail=:mail AND identifiant=:identifiant");
        $rep->execute(array(
            'mail' => $_POST['mail'],
            'identifiant' => $_POST['login'],
        ));
        $donnees = $rep->fetch();
        if ($donnees == NULL)
            echo "compte introuvable";
        else if ($_POST['confmdp'] !== $_POST['nvmdp'])
            echo "mot de passe à confirmer";
        else
        {
            $rep = $db->prepare("UPDATE compte SET mdp=:nvmdp WHERE mdp=:anmdp");
            $rep->execute(array(
                'nvmdp' => hash("sha512", $_POST['nvmdp']),
                'anmdp' => hash("sha512", $_POST['anmdp']),
            ));
            echo "mot de passe changé avec succès";
        }
        $rep->closeCursor();
    }
?>