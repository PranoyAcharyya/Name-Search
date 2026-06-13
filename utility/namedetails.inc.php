<?php 

function getNameDetails(PDO $pdo , string $query = ''){
    $stmt = $pdo ->prepare('SELECT * FROM `names` WHERE `name` = :nqr');
    $stmt -> bindValue(':nqr', $query);
    $stmt -> execute();
    $namedetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $namedetails;
}