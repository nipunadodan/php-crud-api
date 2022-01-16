<?php
use Orange\Db;
use Orange\Post;
use Orange\User;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as Valid;

$database = new Db();
$user = new User();
$post = new Post();
$input = json_decode(file_get_contents('php://input'));
//print_r($input);
switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $postValidator = Valid::attribute('title',Valid::length(2,3)->stringType())
            ->attribute('description',Valid::stringType())
            ->attribute('author',Valid::intType()->length(1,2)->setName('Author'))
            ->attribute('user',Valid::intVal()->length(1,2));
        try {
            $postValidator->assert($input);
            $newPost = [
                'title' => $input->title,
                'description' => $input->description,
                'author' => $input->author,
            ];
            try {
                $database->insert('posts', $newPost);
                return json_encode([
                    'status' => 'success',
                    'message' => 'Successfully added a new post'
                ]);
            } catch (PDOException $e) {
                http_response_code(403);
                return json_encode([
                    'status' => 'danger',
                    'message' => 'Error in adding your post',
                    'error' => $e->getMessage()
                ]);
            }
        } catch (NestedValidationException $e) {
            http_response_code(400);
            echo json_encode([
                'status' => 'danger',
                'message' => 'An erroneous input detected',
                'error' => $e->getMessages()
            ]);
        }
        break;
    case 'GET':
        if(isset($_GET['option']) && $_GET['option'] > 0){
            $user = $database->select('posts', [
                'id', 'title', 'description', 'author', 'status', 'updated'
            ], [
                'id' => $_GET['option']
            ]);
        }elseif (isset($_GET['option']) && $_GET['option'] === 'all'){
            $user = $database->select('posts', [
                'id', 'title', 'description', 'author', 'status', 'updated'
            ]);
        }else{
            http_response_code(400);
            $user = [
                'status' => 'warning',
                'message' => 'No option selected'
            ];
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