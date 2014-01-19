<?php

function db() {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=db_baseball', 'root', '', array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));

        return $dbh;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}