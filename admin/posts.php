<?php
session_start();
require('../includes/config.php');
require('../includes/posts.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$postobject=new posts;
$allposts= $postobject->getposts();



include('../templates/admin/header.html');
include('../templates/admin/all-posts.html');
include('../templates/admin/footer.html');




?>

