<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$idfromurl =(isset($_GET['id']))? (int)$_GET['id'] : 0;

$usersobject=new users;
$error='';
$success='';
if(count($_POST)>0)
    {
        $username =$_POST['username'];
        $email =$_POST['email'];
        $password =$_POST['password'];
        $idfromform =$_POST['id'];
        if($usersobject->updateuser($idfromform,$username,$email,$password))
        {
            $success ='user updated';

        }
        else
        {
            $error ='user not updated';

        }
       
    }
else 
    {
        //get user from db 
        $user =$usersobject->getuser($idfromurl);
        //show user in form

    }  

    include('../templates/admin/header.html');
    include('../templates/admin/update-user.html');
    include('../templates/admin/footer.html');
    
    


?>

