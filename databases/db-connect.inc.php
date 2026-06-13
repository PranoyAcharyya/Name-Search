<?php

try {

    $dbname = 'names';
    $username = 'names';
    $password = 'pran1997';

    $pdo = new PDO(
        "mysql:host=localhost;dbname=$dbname",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    

} catch (PDOException $e) {

    echo $e->getMessage();

    // echo 'A problem occurred with the database connection';
    die();

}





?>


