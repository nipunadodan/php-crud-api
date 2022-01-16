<?php

namespace Orange;

use Exception;
use PDOException;
use Respect\Validation\Validator;

class Post extends Db
{
    /**
     * @throws Exception
     */
    public function addPost($input){
        if(property_exists($input,'title') && Validator::stringVal()->validate($input->title)){
            throw new Exception('Title is required');
        }
        if(property_exists($input,'author') && !is_int($input->author)){
            throw new Exception('Author is required and has to be an integer');
        }
        return $input;
    }
}