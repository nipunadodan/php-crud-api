<?php
/*
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

include_once('env.php');
include_once('config.php');
include_once ('vendor/autoload.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['api']) && $_GET['api'] !== '') {
    if (file_exists(API_PATH . $_GET['api'] . '.php')) {
        include_once(API_PATH . $_GET['api'] . '.php');
    } else {
        echo '404: File ' . $_GET['api'] . ' not found';
    }
} else {
    http_response_code(404);
    echo '404: Process not Found';
}
//echo 'hi api';