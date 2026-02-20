<?php
define("HTTP_OK", 200);
define("HTTP_CREATED", 201);
define("HTTP_NO_CONTENT", 204);
define("HTTP_BAD_REQUEST", 400);
define("HTTP_UNAUTHORIZED", 401);
define("HTTP_FORBIDDEN", 403);
define("HTTP_NOT_FOUND", 404);
define("HTTP_METHOD_NOT_ALLOWED", 405);
define("HTTP_IM_A_TEA_POT", 418);
define("HTTP_INTERNAL_SERVER_ERROR", 500);

function envoyerReponse($reponse) : void {
    http_response_code($reponse["code"] ?? HTTP_OK);
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($reponse["data"], JSON_PRETTY_PRINT);
    die;
}