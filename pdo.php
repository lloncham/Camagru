<?php

function dbconnect(){
    $user = 'root';
    $pass = 'coucou';
    try {
        $db = new PDO('mysql:host=localhost;dbname=camagru', $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
    }
}