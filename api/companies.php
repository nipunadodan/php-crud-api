<?php
use Orange\Db;
use Orange\User;

$user = new User();
$input = json_decode(file_get_contents('php://input'));
//print_r($input);
$database = new Db();

switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $newUser = [
            'title' => $input->title,
            'description' => $input->description,
            'author' => $input->author,
        ];
        try{
            $database->insert('posts', $newUser);
            echo json_encode([
                'status' => 'success',
                'message' => 'Successfully added a new post'
            ]);
        }catch (PDOException $e){
            echo json_encode([
                'status' => 'danger',
                'message' => 'Error in adding your post',
                'error' => $e->getMessage()
            ]);
        }
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