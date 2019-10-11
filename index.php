<?php
session_start();
?>
<html>
<head>
    <link rel="stylesheet" href="header.css">
    <meta charset="utf-8"/>
        <title>Camagru</title>
        <style>
        li {list-style-type: none}
        nav>ul>li{float:right; position:relative; margin: 0.5%; top: -4vw}
        li a{display:inline-block; text-decoration:none; color : pink}
        </style>

</head>
<body>
<nav><H1>CAMAGRU</H1>
<?php
if ($_SESSION['loggued_on_user'] === "" || $_SESSION['loggued_on_user'] === NULL)
{
    echo "<ul><li><a href=\"login.html\">CONNEXION</a></li>";
    echo "<li><a href=\"create.html\">CREER UN COMPTE</a></li></ul>";
}
else
{
    echo "<ul>BIENVENUE ".$_SESSION['loggued_on_user']."<b><a href=\"modif.php\">MON COMPTE</a><a href=\"logout.php\">DECONNEXION</b></a></ul>";
    if ($_SESSION['right'] === "1")
        echo "<br><a href=\"admin.php\">Le pouvoir absolue</a><br/>";
}
?>
</nav>
</body>