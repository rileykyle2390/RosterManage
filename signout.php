<?php
require_once('settings.php');
require_once('user.php');
require_once('authentication_library.php');
session_start();
if(!is_logged()) header('location: home.php');
signout();
header('location: signin.php');
