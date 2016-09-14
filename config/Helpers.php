<?php
function apiResponse($code, $response) {
    return json_encode([
        'code' => $code,
        'response' => $response
        ]);
}