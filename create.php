<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="header.css">
    <style>
        .box {width: 20vw; height: 70vw; margin-left: auto ; margin-right: auto ; margin-top: auto; background-color: white}
    </style>
    <title>Créer son compte</title>
</head>
<body>
<body>
    <nav><H1>CAMAGRU</H1></nav>
<div class="box"> Créer son compte
    <form action="create.php" method="POST">
        Adresse e-mail: <input type="e-mail" name="e-mail">
        <br/>
        Identifiant: <input type="text" name="login">
        <br/>
        Mot de passe: <input type="password" name="passwd">
        <br />
        <input type="submit" name="submit" value="OK">
    </form>
</div>
</body>
</html>