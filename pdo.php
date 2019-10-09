<?php

function dbconnect(){
    $user = 'root';
    $pass = 'lisalol';
    $option = 
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=camagru', $user, $pass);
        return $db;
    } catch (Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
}

// foreach($dbh->query('SELECT * from COMTE') as $row) {
//     print_r($row);
?>