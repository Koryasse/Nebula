<?php
require_once ROOT . "/php/Database.php";

function lireTaches() : array {
    $sql = "SELECT *
        FROM Taches;";
    $stmt = db()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function lireUneTache($id) : array | false {
    $sql = 
    "SELECT *
    FROM Taches
    WHERE id = :id;";
    $stmt = db()->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch();
}

function ajouterUneTache($titre, $description,$idPersonne){
    $sql = 
    "INSERT INTO Taches(titre, Description, idPersonne)
    VALUES (:titre, :Description, :idPersonne);";
    $stmt = db()->prepare($sql);
    $stmt->execute([
        ':titre' => $titre,
        ':Description' => $description,
        ':idPersonne' => $idPersonne
    ]);
    $lastId = db()->lastInsertId();
    $tache = lireUneTache($lastId);
    return $tache;
}

function modifierUneTache($titre, $description, $id) : array {
    $sql = 
    "UPDATE Taches
    SET titre = :titre, Description = :Description
    WHERE id = :id;";
    $stmt = db()->prepare($sql);
    $stmt->execute([
        ':id' => $id,
        ':titre' => $titre,
        ':Description' => $description
    ]);
    $tache = lireUneTache($id);
    return $tache;
}

function ajouterMessage($msg) : array {
    $sql = 
    "INSERT INTO MicroMessage(ownerId, postContent)
    VALUES (:ownerId, :postContent);";
    $stmt = db()->prepare($sql);
    $stmt->execute([
        ':ownerId' => $msg["ownerId"],
        ':postContent' => $msg["postContent"]
    ]);
    $lastId = db()->lastInsertId();
    $msg = lireUnMessage($lastId);
    return $msg;
}

function modifierMessage($msg) : array {
    $sql = 
    "UPDATE MicroMessage
    SET postContent = :postContent
    WHERE id = :id;";
    $stmt = db()->prepare($sql);
    $stmt->execute([
        ':id' => $msg["id"],
        ':postContent' => $msg["postContent"]
    ]);
    $msg = lireUnMessage($msg["id"]);
    return $msg;
}

function effacerMessage($id) : void {
    $sql = 
    "DELETE FROM MicroMessage
    WHERE id = :id;";
    $stmt = db()->prepare($sql);
    $stmt->execute([':id' => $id]);
}