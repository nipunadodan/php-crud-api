<?php
//include_once ('modules/User.php');
//include_once ('modules/Db.php');
use Orange\Db;
use Orange\User;

$user = new User();
$input = json_decode(file_get_contents('php://input'));
//print_r($input);
$database = new Db();

switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $newUser = [
            'firstname' => $_POST['firstName'],
            'lastname' => $_POST['lastName'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];
        $user = $database->insert();
        break;
    case 'GET':
        if(isset($_GET['option']) && $_GET['option'] > 0){
            $user = $database->select('companies', [
                'id', 'title', 'bg_image', 'slug', 'content', 'updated'
            ], [
                'id' => $_GET['option']
            ]);
        }elseif (isset($_GET['option']) && $_GET['option'] == 'all'){
            $user = $database->select('companies', [
                'id', 'title', 'bg_image', 'slug', 'content', 'updated'
            ]);
        }

        echo json_encode($user);
        break;
    case 'PUT':
        $user->updateUser($input['userID'], $input);
        break;
    case 'DELETE':
        $user->deleteUser($input['userID']);
        break;
}