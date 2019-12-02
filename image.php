<?php
include("header.php");
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
        <script src="image.js"></script>
    </head>
    <body>
        <div class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <video  id="video"></video>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <button class="button is-primary" id="startbutton">
                                        Take picture
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <button class="button is-primary" id="save">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        photo();
        $("#save").click(function() {
            var canvas = document
                .getElementById("canvas")
                .toDataURL("image/png");
            $.ajax({
                type: "POST",
                url: "/save_img.php",
                dataType: "text",
                data: { content: canvas }
            });
        });
    </script>
</html>
