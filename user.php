<?php
require_once('settings.php');
require_once('db.php');
class User{
    public $email;
    public $password;
    public $first_name;
    public $last_name;

    public function create(){
        require('settings.php');
        $pdo = DB::connect($settings);
        $q = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $q->execute([$this->email]);
        if($q->rowCount() > 0) return 'The email you entered is already registered.';
        $query = 'INSERT INTO `users` ( `email`, `password`, `role`, `first_name`, `last_name`) VALUES (?,?,?,?,?)';
        $q = $pdo->prepare($query);
        $q-> execute([$this->email, password_hash($this->password,PASSWORD_DEFAULT), "user", $this->first_name, $this->last_name]);
        return "";
    }

    public function login(){
        require('settings.php');
        $pdo = DB::connect($settings);
        $q = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $q->execute([$this->email]);
        if($q->rowCount() == 0) return 'The email you entered is not registered. Please <a href= "signup.php"> Sign up</a>';
        $info = $q->fetch();
        if(!password_verify($this->password, $info['password']))  return 'The password you entered is not valid';
        $_SESSION['user/ID'] = $info['userID'];
        //the password is valid
        return "";
    }
}