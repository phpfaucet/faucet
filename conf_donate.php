<?php
require_once "maincore.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
$pid=$_POST['PAYMENT_ID'];


if($_POST['PAYMENT_STATUS']=='Complete'){



	$db->query("update tbl_dobate set status=1 where md5(donate)='$pid' ");
	
	$_SESSION['succ']['donate']=true;
	

}else{
	
	$_SESSION['succ']['penging']=true;
	
}


header('Location:donate.php');


?>