<?php

require __DIR__ . '/../utility/all.inc.php';

$char = $_GET['char'] ?? '';

$stmt = $pdo->prepare(
    'SELECT DISTINCT name
     FROM names
     WHERE name LIKE :expr
     ORDER BY name ASC'
);

$stmt->execute([
    'expr' => strtoupper($char) . '%'
]);

echo json_encode(
    $stmt->fetchAll(PDO::FETCH_ASSOC)
);