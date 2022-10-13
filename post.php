<?php

require('includes/config.php');
require('includes/posts.class.php');

$id =(isset($_GET['id']))? (int)$_GET['id']:0;
$postobj =new posts;
$post =$postobj->getpost($id);

if($post && count($post)>0 )
{
    include('blogfront/post.html');
}
else
{
    echo '404 not found';

}




?>