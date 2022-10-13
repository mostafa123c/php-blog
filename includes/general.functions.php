<?php

function checklogin()
{
    if(isset($_SESSION['user']))
    return true;
    else 
    return false;


}


?>