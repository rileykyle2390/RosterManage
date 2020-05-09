<?php
require_once('settings.php');
require_once('user.php');
function signin(){
    if(count($_POST)>0){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
             return 'The email you entered is not valid';
        }
        //Check for duplicate emails, eg if user puts all upper and db stores all lower
        $_POST['email'] = strtolower($_POST['email']);
        $_POST['password'] = trim($_POST['password']);
        if(strlen($_POST['password'])<8){
             return 'The password must be at least 8 characters';
        }
        $user =  new User();
        $user->email =  $_POST['email'];
        $user->password =  $_POST['password'];
        $error = $user->login();
        if(isset($error[0])) return $error;
        else echo 'Successful log in.';
        return "";
    }
}

function signup(){
    if(count($_POST)>0){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
             return 'The email you entered is not valid';
        }
        $_POST['email'] = strtolower($_POST['email']);
        $_POST['password'] = trim($_POST['password']);
        if(strlen($_POST['password'])<8){
             return 'The password must be at least 8 characters';
        }
        $user =  new User();
        $user->email =  $_POST['email'];
        $user->password =  $_POST['password'];
        $user->first_name =  $_POST['first_name'];
        $user->last_name =  $_POST['last_name'];
        //Register
        $error = $user->create();
        if(isset($error[0])) return $error;
        else echo 'You successfully registered your account. Now you can <a href="signin.php"> Sign in </a>.';
        return "";
    }
}

function is_logged($user_key = 'user/ID'){
    if(isset($_SESSION[$user_key])){
        if(is_numeric(($_SESSION[$user_key]))) return true;
        elseif(isset(($_SESSION[$user_key]{0}))) return true;
    }
    return false;
}

function signout(){
    $_SESSION=[];
    session_destroy();
}