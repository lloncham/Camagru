<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="header.css">
    <title>Nouveau mot de passe</title>
</head>
<body>
    <nav><H1>CAMAGRU</H1>
    <form action="resetpswd.php" method="POST">
		Nouveau mot de passe:
		<input  type="password"
                name="passwd"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Doit contenir au moins un chiffre, une majuscule, une minuscule ainsi qu'être composé d'au moins 8 caractères"
        />
        <input type="hidden" name="key" value="<?php $_GET['id'] ?>"/>
        <p>
        <input type="submit" name="submit" value="OK">
    </form>
</body>
</html>
<?php
include('pdo.php');

session_start();
$db = dbconnect();

$ID = $_GET['id'];
$token = $_GET['token'];

$rep = $db->prepare("SELECT token FROM compte WHERE ID=:ID");
$rep->execute(array(
    'ID' => $ID,
));
$donnees = $rep->fetch();

if ($token == $donnees['token'] && $_POST['passwd'] !== NULL && $_POST['passwd'] !== "" && $_POST['submit'] == "OK")
{
    $rep = $db->prepare('UPDATE compte SET mdp=:mdp WHERE ID=:ID');
    $rep->execute(array(
        'mdp' => hash("sha512", $_POST['passwd']),
        'ID' => $ID,
    ));
    echo $ID . "coucou";
    echo "succès, votre mot de passe a bien été changé";
}
else 
{
    echo "echec, votre mot de passe n'a pas pu être réinitialisé";
    // header("location: /indesx.php");
}
$rep->closeCursor();


?>