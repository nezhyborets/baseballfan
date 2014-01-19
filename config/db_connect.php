<?php

function db() {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=db_baseball', 'root', '', array(
            PDO::ATTR_PERSISTENT => true
        ));

        return $dbh;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}