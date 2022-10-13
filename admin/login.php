<?php
session_start();

require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

$error='';
$success='';

if(checklogin())
   exit('you are already logged in');


if(count($_POST)>0)     // because submit in form is a button not input 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usersobject=new users;
    $userdata=$usersobject->login($username,$password);

    if($userdata && count($userdata)>0)
    {
        $_SESSION['user']=$userdata;
        $success ='login successful';
    }
    else
    {
       $error = 'invalid username and password ';
    }



}

include('../templates/admin/login.html');



?>



