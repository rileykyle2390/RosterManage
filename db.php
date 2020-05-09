<?php

class DB{
    public static function connect($settings){
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $pdo = new PDO('mysql:host='.$settings['host'].'; dbname='.$settings['dbname'].';charset=utf8mb4', $settings['username'], $settings['password'],$opt);
        return $pdo;
    }
}