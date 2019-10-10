<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="header.css">
    <style>
        .box {width: 20vw; height: 30vw; margin-left: auto ; margin-right: auto ; background-color: grey}
    </style>
    <title>Créer son compte</title>
</head>
<body>
    <nav><H1>CAMAGRU</H1></nav>
    <div> Créer son compte
        <form action="create.php" method="POST">
            Adresse e-mail: <input type="e-mail" name="e-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
            title="Il ne s'agit pas d'une adresse e-mail valide">
            <br/>
            Identifiant: <input type="text" name="login">
            <br/>
            Mot de passe: <input type="password" name="passwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Doit contenir au moins un chiffre, une majuscule, une minuscule ainsi qu'être composé d'au moins 8 caractères">
            <br />
            <input type="submit" name="submit" value="OK">
        </form>
    </div>
</body>
</html>