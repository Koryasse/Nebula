<?php
define("ROOT", ".");
require_once ROOT . "/php/Http.php";
require_once ROOT . "/php/Personne.php";
require_once ROOT . "/php/Tache.php";
require_once ROOT . "/php/Token.php";
// -------------------------------------------------------------
$action = $_SERVER["REQUEST_METHOD"];

$body = file_get_contents("php://input");

if ($body !== false && $body !== "") {
    $login = json_decode($body, true);
}

switch ($action) {
    case "POST":
        $reponse = traiterPost($login);
        break;
    case "DELETE":
        $reponse = traiterDelete();
        break;
    default:
        $reponse = traiterAutre();
        break;
}

envoyerReponse($reponse);

// -------------------------------------------------------------

function traiterPost($login) : array {
    if (!isset($login['loginName']) || !isset($login['loginPass'])) {
        return [
            "code" => HTTP_BAD_REQUEST,
            "data" => "Données manquantes."
        ];
    }

    $loginName = $login['loginName'];
    $loginPass = $login['loginPass'];

    $user = lireUtilisateurParLogin($loginName);
    if (!$user || !password_verify($loginPass, $user['loginPass'])) {
        return [
            "code" => HTTP_BAD_REQUEST,
            "data" => "Nom d'utilisateur ou mot de passe incorrect."
        ];
    }

    return [
        "code" => HTTP_OK,
        "data" => [
            "token" => $user['loginToken']
        ]
    ];
}

function traiterDelete() {
    $code = HTTP_OK;

    $token = lireJeton();
    $user = lireUtilisateurParJeton($token);
    if (!$user) {
        return [
            "code" => HTTP_UNAUTHORIZED,
            "data" => "L'accès n'est pas autorisé."
        ];
    }

    $newToken = md5(random_bytes(16));
    
    return [
        "code" => $code,
        "data" => mettreAJourJeton($user['id'], $newToken)
    ];
}

function traiterAutre() : array {
    return [
        "code" => HTTP_METHOD_NOT_ALLOWED,
        "data" => "La methode n'est pas autorisée."
    ];
}