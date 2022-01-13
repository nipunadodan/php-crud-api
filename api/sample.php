<?php
//include_once ('modules/User.php');
//include_once ('modules/Db.php');
use Orange\User;

$user = new User();
$input = json_decode(file_get_contents('php://input'));
//print_r($input);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->addUser($input);
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userRecord = $user->getUser($input->userID);
    echo json_encode($userRecord);
}elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $user->updateUser($input['userID'], $input);
}elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $user->deleteUser($input['userID']);
}