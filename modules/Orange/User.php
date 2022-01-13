<?php

namespace Orange;

class User extends Db {
    function addUser($newUser){

    }

    function getUser($userID){
        return $user = $this->select('users', [
            'id','username','password','first_name','last_name','status','level','updated'
        ],[
            'id' => $userID
        ]);
    }

    function updateUser($userID,$userData){

    }

    function deleteUser($userID){

    }
}