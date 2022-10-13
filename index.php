<?php
require('includes/config.php');
require('includes/posts.class.php');

$postobj =new posts;
$posts=$postobj->getposts("ORDER BY `id` DESC");







$success='';
$error ='';

if(count($_POST)>0)
{
    $title= $_POST['title'];
    $content= $_POST['content'];
    $name= $_POST['name'];

    //image
    $image='';
    if(isset($_FILES['image']))
    {
        //info
        $imagename=$_FILES['image']['name'];
        $type=$_FILES['image']['type'];
        $tmp=$_FILES['image']['tmp_name'];
        $size=$_FILES['image']['size'];
        $imageerror=$_FILES['image']['error'];

        if($imageerror==0 && $type=='image/png' || $type=='image/jpg' || $type=='image/jpeg')
        {
            //rename
            $image =md5($imagename.date('u').rand(1000,10000)).$imagename;
            //move
           move_uploaded_file($tmp,'uploads/'.$image);  
        }
    }



$postobject=new posts;
if($postobject->addpost($title,$content,$name,$image))
{
    $success = 'post added successfully';
}
else
{
   $error = 'invalid data submitted';
}
}    





include('blogfront/index.html');

 
 


?>