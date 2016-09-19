<?php
function apiResponse($response) {
    return json_encode([
        'code' => $response['code'],
        'response' => $response['response']
        ]);
}