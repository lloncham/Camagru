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
        nav>ul>li{font-size: 1vw;float:right; position:relative; margin: 0.5%; top: -4vw}
        li a{display:inline-block; text-decoration:none; color : pink}
        #bienvenue{color : pink; float:left; position:relative; margin: 0.5%;top: -4vw;font-size: 1vw;}
        </style>

</head>
<body>
<nav><H1>CAMAGRU</H1>
<?php
if ($_SESSION['loggued_on_user'] === "" || $_SESSION['loggued_on_user'] === NULL)
{
    echo "<ul><li><a href=\"login.html\"> CONNEXION </a></li>";
    echo "<li><a href=\"create.html\"> CREER UN COMPTE </a></li></ul>";
}
else
{
    echo "<div id=\"bienvenue\">Bienvenue ".$_SESSION['loggued_on_user']."</div>";
    echo "<ul><li><a href=\"modif.php\"> MON COMPTE </a></li>";
    echo "<li><a href=\"logout.php\"> DECONNEXION </a></li>";
    echo "<li><a href=\"image.html\"> PHOTO </a></li></ul>";
}

?>
</nav>
</body>