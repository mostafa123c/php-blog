<?php
session_start();

require('../includes/general.functions.php');

if(!checklogin())
{
   exit ('you are not allowed to view this page');
}

include('../templates/admin/header.html');
include('../templates/admin/content.html');
include('../templates/admin/footer.html');



?>