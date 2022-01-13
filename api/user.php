<?php

use Orange\User;

$user = new User();

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method){
    case 'POST':
        $newUser = [
            'firstname' => $_POST['firstName'],
            'lastname' => $_POST['lastName'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];
        $user->add($newUser);
        break;
    case 'GET':
        $user->getUser($_GET['userID']);
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"),$putData);
        $user->update($putData['id'], $putData['userID']);
        break;
    case 'DELETE':
        parse_str(file_get_contents("php://input"),$putData);
        $user->delete();
        break;
    default:
        $user->getUser($_GET['id']);
}