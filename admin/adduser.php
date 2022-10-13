<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}



$success='';
$error ='';

if(count($_POST)>0)
{
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];

$usersobject=new users;
if($usersobject->adduser($username,$password,$email))
{
    $success = 'user added successfully';
}
else
{
   $error = 'invalid data submitted';
}
}    
include('../templates/admin/header.html');
include('../templates/admin/add-user.html');
include('../templates/admin/footer.html');




?>