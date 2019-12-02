<?php
include('header.php');

include('pdo.php');
include('mail.php');

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
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
         <div class="section">
            <div class="container">
                <form action="create.php" method="POST">
                    <div class="field">
                        <label class="label">E-mail :</label>
                        <div class="control">
                            <input class="input"
                                type="e-mail"
                                name="e-mail"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                title="Il ne s'agit pas d'une adresse e-mail valide"
                            />
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Username :</label>
                        <div class="control">
                            <input class="input" type="text" name="login">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Password :</label>
                        <div class="control">
                            <input class="input" 
                                type="password"
                                name="passwd"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Doit contenir au moins un chiffre, une majuscule, une minuscule ainsi qu'être composé d'au moins 8 caractères">
                        </div>
                    </div>
                    <div class="control">
                      <button class="button is-primary" name="submit" value="OK">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
    $db = dbconnect();
    
    if ($_POST['submit'] == "OK" && $_POST['login'] !== NULL && $_POST['passwd'] !== NULL && $_POST['e-mail'] !== NULL
    && $_POST['login'] !== "" && $_POST['passwd'] !== "" && $_POST['e-mail'] !== "")
    {
        $mail = $_POST['e-mail'];
        $identifiant = $_POST['login'];
        $passwd = hash("sha512", $_POST['passwd']);
    
        $req = $db->prepare('INSERT INTO compte(mail, identifiant, mdp) VALUES (:mail, :identifiant, :mdp)');
        $req->execute(array(
            'mail' => $mail,
            'identifiant' => $identifiant,
            'mdp' => $passwd,
        ));
        activaccount($mail, $db);
        header('location: /login.php');
    }
?>