<?php

class posts
{
    private $connection;

    public function __construct()
    {
        $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
    }

    public function addpost($title,$content,$name,$image)
    {
        $this->connection->query("INSERT INTO `posts`( `title`, `content`,`name`,`image`) VALUES ('$title','$content','$name','$image')");
        if($this->connection->affected_rows >0)
             return true;

        echo $this->connection->error;
        return false;    
        
    }


    public function updatepost($id,$title,$content,$image)
    {
        $sql = "UPDATE `posts` SET";

        if(strlen($title)>0)
           $sql.="`title`='$title'";

        if(strlen($content)>0)
           $sql.=",`content`='$content'";

        if(strlen($image)>0)
           $sql.=",`image`='$image'";


        $sql.=" WHERE `id`=$id";

        $this->connection->query($sql);
        if($this->connection->affected_rows >0)
             return true;

        echo $this->connection->error;
        return false;    



    }

    public function deletepost($id)
    {
        $this->connection->query("DELETE FROM `posts` WHERE `id`=$id");
        if($this->connection->affected_rows >0)
             return true;

        return false; 



    }

    public function getposts($extra='')
    {
        $result = $this->connection->query("SELECT * FROM `posts` $extra");
        if($result->num_rows >0)
        {
           $posts =array();
           while($row=$result->fetch_assoc())
           {
            $posts[] =$row ;
           } 
           return $posts;
        }
        return null;



    }

    public function getpost($id)
    {
        $post = $this->getposts("WHERE `id`=$id");
        if($post && count($post)>0)
            return $post[0];
        
         return null;
    }





    public function __destruct()
    {
        $this->connection->close();
    }





}


?>