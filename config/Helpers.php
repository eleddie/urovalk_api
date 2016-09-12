<?php
function apiResponse($code, $response) {
    return json_encode([
        'code' => $code,
        'response' => $response
        ]);
}

/**
* Response Codes:
* 1 -> All Correct
* 2 -> Mandatory parameter missing
* 3 -> Invalid format
* 
*   
*/
