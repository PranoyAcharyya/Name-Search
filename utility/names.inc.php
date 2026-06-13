<?php 
declare(strict_types=1);

function getNames(PDO $pdo, string $query = ''): array
{
    if ($query === '') {
        $stmt = $pdo->query(
            'SELECT DISTINCT `name`
             FROM `names`
             ORDER BY `name` ASC'
        );
    } else {
        $stmt = $pdo->prepare(
            'SELECT DISTINCT `name`
             FROM `names`
             WHERE `name` LIKE :expr
             ORDER BY `name` ASC'
        );

        $stmt->execute([
            ':expr' => $query . '%'
        ]);
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
