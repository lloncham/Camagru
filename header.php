<?php
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();
?>
        <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php">
                    CAMAGRU
                </a>

                <a
                    role="button"
                    class="navbar-burger burger"
                    aria-label="menu"
                    aria-expanded="false"
                    data-target="navbarBasicExample"
                >
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <?php
            if (array_key_exists('loggued_on_user', $_SESSION) && $_SESSION['loggued_on_user'] !== "" && $_SESSION['loggued_on_user'] !== NULL)
            {
                echo "<div class=\"navbar-menu\">
                <div class=\"navbar-start\">
                    <a class=\"navbar-item\" href=\"index.php\">
                        Home
                    </a>
                    <a class=\"navbar-item\" href=\"image.php\">
                        Take a picture!
                    </a></div>
                    </div>
                    <div class=\"navbar-end\">
                    <div class=\"navbar-item\">
                        <div class=\"buttons\">
                            <a class=\"button is-primary\" href=\"modif.php\">
                                <strong>My account</strong>
                            </a>
                            <a class=\"button is-info\" href=\"logout.php\">
                                Log out
                            </a>
                        </div>
                    </div>
                </div></nav>";
            }
            else 
            {
                echo "<div class=\"navbar-end\">
                    <div class=\"navbar-item\">
                        <div class=\"buttons\">
                            <a class=\"button is-primary\" href=\"create.php\">
                                <strong>Sign up</strong>
                            </a>
                            <a class=\"button is-light\" href=\"login.php\">
                                Log in
                            </a>
                        </div>
                    </div>
                </div></nav>
                ";
            }