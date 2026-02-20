<?php
require_once ROOT . "/php/Database.php";

function lireJeton() : string {
    $httpHeaders = getallheaders();
    $bearerString = $httpHeaders['Authorization'] ?? '';
    $bearer = explode(' ', $bearerString, 3);

    if ($bearer[0] !== 'Bearer' || count($bearer) != 2) {
        return "";
    }

    return $bearer[1];
}

function lireJetonParLogin($name, $pass) : array | null {
    $sql = "SELECT loginToken
        FROM AppLogin
        WHERE loginName = :loginName AND loginPass = :loginPass";
    $stmt = db()->prepare($sql);
    $stmt->execute([
        ':loginName' => $name,
        ':loginPass' => $pass
    ]);
    return $stmt->fetch();
}

function mettreAJourJeton(int $userId, string $newToken) : int {
    $sql = "UPDATE AppLogin
    SET loginToken = :newToken
    WHERE id = :userId";
    $stmt = db()->prepare($sql);
    $stmt->execute([
        ":newToken" => $newToken,
        ":userId" => $userId
    ]);
    return $stmt->rowCount();
}