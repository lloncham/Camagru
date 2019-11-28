<?php

include('pdo.php');

session_start();
$db = dbconnect();
?>
<html>
<head>
    <!-- <link rel="stylesheet" href="header.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css"><script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <meta charset="utf-8"/>
        <title>Camagru</title>
        <style>
        /* li {list-style-type: none} */
        /* nav>ul>li{font-size: 1vw ;float:right; position:relative; margin: 0.5%; top: -4vw}
        li a{display:inline-block; text-decoration:none; color : white}
        #bienvenue{color : pink; float:left; position:relative; margin: 0.5%;top: -4vw;font-size: 1vw;} */
        </style>

</head>
<body>
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="index.php">
        CAMAGRU
    </a>
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Home
      </a>

      <a class="navbar-item">
        Documentation
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light">
            Log in
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
</body>
<!-- <nav><H1><a href="index.php">CAMAGRU</a></H1> -->
<?php

// if ($_SESSION['loggued_on_user'] === "" || $_SESSION['loggued_on_user'] === NULL)
// {
//     echo "<ul><li><a href=\"login.html\"> CONNEXION </a></li>";
//     echo "<li><a href=\"create.html\"> CREER UN COMPTE </a></li></ul>";
// }
// else
// {
//     echo "<div id=\"bienvenue\">Bienvenue ".$_SESSION['loggued_on_user']."</div>";
//     echo "<ul><li><a href=\"modif.html\"> MON COMPTE </a></li>";
//     echo "<li><a href=\"logout.php\"> DECONNEXION </a></li>";
//     echo "<li><a href=\"image.html\"> PHOTO </a></li></ul>";

//     $rep = $db->prepare('SELECT * FROM image WHERE iduser=:iduser');
//     $rep->execute(array(
//         'iduser' => $_SESSION['id_user'],
//     ));
//     $donnees = $rep->fetchAll();
//     $rep->closeCursor();
    // // var_dump($donnees);
    // foreach ($donnees as $tab)
    // {
        //     foreach ($tab as $img)
        //     {
            //         echo "<img src=\"" . $img . "\">";
            //     }
            
            // }
        // }
        
        // ?>
<!-- </nav>
</body>
    <br /><button class="button is-link" id="startbutton">
        take picture
    </button> -->