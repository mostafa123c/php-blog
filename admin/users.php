<?php
session_start();
require('../includes/config.php');
require('../includes/users.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$usersobject=new users;
$allusers = $usersobject->getusers();






include('../templates/admin/header.html');
//include('../templates/admin/content.html');
include('../templates/admin/all-users.html');
include('../templates/admin/footer.html');



?>