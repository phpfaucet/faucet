<?php
require_once "maincore.php";
require_once "includes/dbconnector.class.php";

$_SESSION['error']['donate']=true;

header('Location:donate.php');


?>