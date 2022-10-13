<?php


class users
{
    private $connection;

    public function __construct()
    {
        $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        
    }

    public function adduser($username,$email,$password)
    {
        $this->connection->query("INSERT INTO `user`( `username`, `email`, `password`) VALUES ('$username','$email','$password')");
        if($this->connection->affected_rows >0)
             return true;

        return false;        
    }


    public function updateuser($id,$username,$email,$password)
    {
        $sql = "UPDATE `user` SET";

        if(strlen($username)>0)
           $sql.="`username`='$username'";

        if(strlen($email)>0)
           $sql.=",`email`='$email'";

        if(strlen($password)>0)
           $sql.=",`password`='$password'";

        $sql.="WHERE `id`=$id";


        $this->connection->query($sql);
        if($this->connection->affected_rows >0)
             return true;

        return false;        
    }



    public function deleteuser($id)
    {
        $this->connection->query("DELETE FROM `user` WHERE `id`=$id");
        if($this->connection->affected_rows >0)
             return true;

        return false; 

        
    }


    public function getusers($extra='')
    {
        $result = $this->connection->query("SELECT * FROM `user` $extra");
        if($result->num_rows >0)
        {
           $users =array();
           while($row=$result->fetch_assoc())
           {
            $users[] =$row ;
           } 
           return $users;
        }
        return null;
 
    }
    

    public function getuser($id)
    {
        $users =$this->getusers("WHERE `id` = $id");
        if($users && count($users)>0)
            return $users[0];

        return null;    

    }


    public function login($username , $password)
    {
        $users =$this->getusers("WHERE `username`='$username' AND `password` ='$password'");

        if($users && count($users)>0)
            return $users[0];

        return null;        
    }


    public function __destruct()
    {
        $this->connection->close();
    }


        
    }









?>