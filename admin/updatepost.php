<?php
session_start();
require('../includes/config.php');
require('../includes/posts.class.php');
require('../includes/general.functions.php');

if(!checklogin())
{
    exit ('you are not allowed to view this page');
}

$idfromurl =(isset($_GET['id']))? (int)$_GET['id'] : 0;

$error='';
$success='';

$postobject=new posts;

include('../templates/admin/header.html');

if(count($_POST)>0)
{
    //update post
    $idfromform =$_POST['id'];
    $title= $_POST['title'];
    $content= $_POST['content'];
    $name= $_POST['name'];
    

    //image
    $post = $postobject->getpost($idfromform);

    $postimage = $post['image'];

    if(isset($_FILES['image']))
    {
        //info
        $imagename=$_FILES['image']['name'];
        $type=$_FILES['image']['type'];
        $tmp=$_FILES['image']['tmp_name'];
        $size=$_FILES['image']['size'];
        $error=$_FILES['image']['error'];

        if( $error ==0 && $type=='image/png' || $type=='image/jpg' || $type=='image/jpeg')
        {
            //rename
            $newimagename =md5($imagename.date('u').rand(1000,10000)).$imagename ;
            //move
            if(move_uploaded_file($tmp,'../uploads/'.$newimagename))
            {
                if(file_exists('../uploads/'.$postimage))
                     unlink('../uploads/'.$postimage);

                 $postimage=$newimagename;
            }
               

        }
    }

    
if($postobject->updatepost($idfromform,$title,$content,$postimage))
{
    $success = 'post updated successfully';
    include('../templates/admin/resultmessage.html');
}
else
{
   $error = 'invalid data submitted';
   include('../templates/admin/resultmessage.html');
}



}
else 
{
    $post = $postobject->getpost($idfromurl);
if(!$post || count($post)==0)
{
    $error ='post not found';
    //include('../templates/admin/resultmessage.html');
    include('../templates/admin/footer.html'); 
    exit;
}
    //show product in form
include('../templates/admin/updatepost.html'); 
     

 } 
 
 include('../templates/admin/footer.html'); 
?>
