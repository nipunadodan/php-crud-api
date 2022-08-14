<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');

require 'vendor/autoload.php';

include_once('config.php');
include_once('env.php');

/**
     // return all records
    GET /person

    // return a specific record
    GET /person/{id}

    // create a new record
    POST /person

    // update an existing record
    PUT /person/{id}

    // delete an existing record
    DELETE /person/{id}
*/

if (isset($_GET['api']) && $_GET['api'] !== '') {
    if (file_exists(API_PATH . $_GET['api'] . '.php')) {
        include_once(API_PATH . $_GET['api'] . '.php');
    } else {
        echo '{"code":404, "message": "File ' . $_GET['api'] . ' not Found"}';
    }
} else {
    http_response_code(404);
    echo '{"code":404, "message": "Process not Found"}';
}
