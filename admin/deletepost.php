<?php
session_start();
require('../includes/config.php');
require('../includes/posts.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$id =(isset($_GET['id']))? (int)$_GET['id'] : 0;

$error='';
$success='';

$postobject=new posts;
$post = $postobject->getpost($id);

//include('../templates/admin/header.html');
if( $postobject->deletepost($id))      //deleted from db 
    {
        if(file_exists('../uploads/'.$post['image']))
            unlink('../uploads/'.$post['image']);  // deleting image 
        $success='post deleted';
        header('LOCATION:posts.php');
    }
else 
    $error = 'post not deleted'   ;


//include('../templates/admin/all-posts.html');
//include('../templates/admin/footer.html');



?>