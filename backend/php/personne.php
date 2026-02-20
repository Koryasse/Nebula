<?php
require_once ROOT . "/php/Database.php";

function lireUnePersonneParId($id) : array | false {
    $sql =
    "SELECT *
    FROM Personnes
    WHERE id = :id;";
    $stmt = db()->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch();
}

function lireUtilisateurParLogin(string $loginName) : array | false {
    $sql =
    "SELECT *
    FROM AppLogin
    WHERE loginName = :loginName;";
    $stmt = db()->prepare($sql);
    $stmt->execute([":loginName" => $loginName]);
    return $stmt->fetch();
}

function lireUtilisateurParJeton(string $loginToken) : array | false {
    $sql = "SELECT id, loginName, loginPass, loginToken
    FROM AppLogin
    WHERE loginToken = :loginToken";
    $stmt = db()->prepare($sql);
    $stmt->execute([':loginToken' => $loginToken]);
    return $stmt->fetch();
}