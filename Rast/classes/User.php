<?php 

class User {

    Public function isAdmin(){
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user';
    }


    public function isLoggedIn (){
        return isset($_SESSION['logged_in']);
    }


    public function name(){
        if(isset($_SESSION['user_name'])){
            return $_SESSION['user_name'];
        }

        return 'guest';

    }

}