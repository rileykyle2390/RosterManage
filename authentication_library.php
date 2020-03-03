<?php
function signin($database_file){
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
        //MUST CHECK IF FILE EXISTS
        if(!file_exists($database_file)){
            $h=fopen($database_file, 'w+');
            fwrite($h, '<?php die() ?>'."\n");
            fclose($h);
        }
        $h=fopen($database_file, 'r');
        while(!feof($h)){
            $line = fgets($h);
            $line = preg_replace('/\n/', '', $line);
            if(strstr($line, $_POST['email'])){ 
                $line = explode(';', $line);
                if(!password_verify($_POST['password'], $line[1])){
                    fclose($h);
                    return 'The password you entered is not valid';
                }
                //the password is valid
                fclose($h);
                return '';
            }
        }
        fclose($h);
        return 'The email you entered is not registered. Please <a href= "signup.php"> Sign up</a>';
    }
}

function signup($database_file){
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
        //MUST CHECK IF FILE EXISTS
        if(!file_exists($database_file)){
            $h=fopen($database_file, 'w+');
            fwrite($h, '<?php die() ?>'."\n");
            fclose($h);
        }
        $h=fopen($database_file, 'r');
        while(!feof($h)){
            $line = fgets($h);
            if(strstr($line, $_POST['email'])){ 
                return 'The email you entered is already registered';
            }
        }
        fclose($h);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $h=fopen($database_file, 'a+');
        fwrite($h, implode(';', [$_POST['email'],$_POST['password']])."\n");
        fclose($h);
        echo 'You successfully registered your account. Now you can <a href="signin.php"> Sign in </a>.';
        return "";
    }
}