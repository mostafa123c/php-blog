<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}


$id =(isset($_GET['id']))? (int)$_GET['id'] : 0;
if($id ==1)
{
    exit('this user cant be deleted');

}
else
{

$usersobject=new users;
if( $usersobject->deleteuser($id))
    {
        header('LOCATION:users.php');
    }
else 
   {
    echo 'invalid user';
   }    


}

?>