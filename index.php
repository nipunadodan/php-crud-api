<?php
include_once('config.php');

if (isset($_GET['api']) && $_GET['api'] !== '') {
    if (file_exists(API_PATH . $_GET['api'] . '.php')) {
        include_once(API_PATH . $_GET['api'] . '.php');
    } else {
        echo '404: File ' . $_GET['api'] . ' not found';
    }
} else {
    echo '404: Process not Found';
}