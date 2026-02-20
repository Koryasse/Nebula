<?php
define("ROOT", ".");
require_once ROOT . "/php/http.php";
require_once ROOT . "/php/personne.php";
require_once ROOT . "/php/tache.php";
require_once ROOT . "/php/token.php";
// -------------------------------------------------------------
$action = $_SERVER["REQUEST_METHOD"];

$body = file_get_contents("php://input");
if ($body !== false && $body !== "") {
    $tache = json_decode($body, true);
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT) ?? '';

switch ($action) {
    case "GET":
        $reponse = traiterGet();
        break;
    case "POST":
        $reponse = traiterPost($tache);
        break;
    case "PUT":
        $reponse = traiterPut($tache, $id);
        break;
    case "DELETE":
        $reponse = traiterDelete($userAuth);
        break;
    default:
        $reponse = traiterAutre();
        break;
}

envoyerReponse($reponse);
// -------------------------------------------------------------

function traiterGet(): array
{
    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    if (isset($id)) {
        if ($id >= 0) {
            if (lireUneTache($id)) {
                return [
                    "code" => HTTP_OK,
                    "data" => lireUneTache($id)
                ];
            } else {
                return [
                    "code" => HTTP_BAD_REQUEST,
                    "data" => [
                        "id" => "non existant"
                    ]
                ];
            }
        }
    }

    return [
        "code" => HTTP_OK,
        "data" => lireTaches()
    ];
}

function traiterPost($tache): array
{
    $code = HTTP_OK;
    $data = [];

    // $userAuth = lireUtilisateurParJeton(lireJeton());
    // if (!$userAuth) {
    //     return [
    //         "code" => HTTP_FORBIDDEN,
    //         "data" => "L'accès n'est pas autorisé."
    //     ];
    // }

    // if (isset($tache["ownerId"])) {
    //     $ownerId = filter_var($tache["ownerId"], FILTER_VALIDATE_INT);
    //     if (is_int($ownerId)) {
    //         $user = lireUnUtilisateur($ownerId);
    //         if (!$user) {
    //             $code = HTTP_BAD_REQUEST;
    //             $data['ownerId'] = "Référence inexistante";
    //         }
    //     }
    //     else {
    //         $code = HTTP_BAD_REQUEST;
    //         $data['ownerId'] = "Nombre entier attendu";
    //     }
    // }
    // else {
    //     $code = HTTP_BAD_REQUEST;
    //     $data['ownerId'] = "Le champ est obligatoire";
    // }

    if (isset($tache["titre"])) {
        $titre = trim($tache["titre"]);
        if ($titre != "") {
            // restriction pour le titre
            if (strlen($titre) > 50) {
                $code = HTTP_BAD_REQUEST;
                $data['titre'] = "Le titre est trop long, max 50 caractères";
            }
        } else {
            $code = HTTP_BAD_REQUEST;
            $data['titre'] = "Le titre ne peut être vide";
        }
    } else {
        $code = HTTP_BAD_REQUEST;
        $data['titre'] = "Le champ est obligatoire";
    }

    if (isset($tache["description"])) {
        $description = trim($tache["description"]);
        if ($description != "") {
            if (strlen($description) > 150) {
                $code = HTTP_BAD_REQUEST;
                $data['description'] = "La description est trop longue, max 150 caractères";
            }
        } else {
            $code = HTTP_BAD_REQUEST;
            $data['description'] = "La description ne peut être vide";
        }
    } else {
        $code = HTTP_BAD_REQUEST;
        $data['description'] = "Le champ est obligatoire";
    }

    if ($code == HTTP_OK) {
        return [
            "code" => $code,
            "data" => ajouterUneTache($titre, $description, 1) // changer l'id par l'id de l'user
        ];
    }

    return [
        "code" => $code,
        "data" => $data
    ];
}

function traiterPut($tache, $id): array
{
    $code = HTTP_OK;
    $data = [];

    // $userAuth = lireUtilisateurParJeton(lireJeton());
    // if (!$userAuth) {
    //     return [
    //         "code" => HTTP_FORBIDDEN,
    //         "data" => "L'accès n'est pas autorisé."
    //     ];
    // }

    if (!isset($id) || !is_int($id)) {
        $code = HTTP_BAD_REQUEST;
        $data["id"] = "Le champ est obligatoire";
    }

    $tacheAModifier = lireUneTache($id);
    if (!$tacheAModifier) {
        $code = HTTP_NOT_FOUND;
        $data["id"] = "Tache non trouvée";
    }

    if (isset($tache["titre"])) {
        $titre = trim($tache["titre"]);
        if ($titre != "") {
            // restriction pour le titre
            if (strlen($titre) > 50) {
                $code = HTTP_BAD_REQUEST;
                $data['titre'] = "Le titre est trop long, max 50 caractères";
            }
        } else {
            $code = HTTP_BAD_REQUEST;
            $data['titre'] = "Le titre ne peut être vide";
        }
    } else {
        $titre = $tacheAModifier["Titre"];
    }

    if (isset($tache["description"])) {
        $description = trim($tache["description"]);
        if ($description != "") {
            if (strlen($description) > 150) {
                $code = HTTP_BAD_REQUEST;
                $data['description'] = "La description est trop longue, max 150 caractères";
            }
        } else {
            $code = HTTP_BAD_REQUEST;
            $data['description'] = "La description ne peut être vide";
        }
    } else {
        $description = $tacheAModifier["Description"];
    }

    if ($code == HTTP_OK) {
        return [
            "code" => $code,
            "data" => modifierUneTache($titre, $description, $id)
        ];
    }

    return [
        "code" => $code,
        "data" => $data
    ];
}

function traiterDelete(): array
{
    $code = HTTP_OK;
    $data = [];

    $userAuth = lireUtilisateurParJeton(lireJeton());
    if (!$userAuth) {
        return [
            "code" => HTTP_FORBIDDEN,
            "data" => "L'accès n'est pas autorisé."
        ];
    }

    $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    if (is_int($id)) {
        $message = lireUnMessage($id);
        if (!$message) {
            $code = HTTP_BAD_REQUEST;
            $data['id'] = "Référence inexistante";
        }
    } else {
        $code = HTTP_BAD_REQUEST;
        $data['id'] = "Nombre entier attendu";
    }

    if ($code == HTTP_OK) {
        return [
            "code" => HTTP_FORBIDDEN,
            "data" => "L'accès n'est pas autorisé."
        ];
    }
    return [
        "code" => $code,
        "data" => $data
    ];
}

function traiterAutre(): array
{
    return [
        "code" => HTTP_METHOD_NOT_ALLOWED,
        "data" => "La methode n'est pas autorisée."
    ];
}