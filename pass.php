<?php
require_once "header.php";
require_once "maincore.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
if( isset($_POST['newpassword'] ) ){
	
	$newpass=md5($_POST['newpassword']);
	
	$prepass=md5($_POST['prepass']);

	
	if($userdet['password']==$prepass){
		$prepass=$db->mysqli->prepare("update tbl_user set password=? where user_id=? ");
		$prepass->bind_param('si',$newpass,$uid);
		$prepass->execute();
		$prepass->close();
		$_SESSION['succ']['change']=true;
	}else{
		$_SESSION['error']['wrong']=true;
	}
		header('Location:pass.php');
}else{
	if(isset($_SESSION['error']['wrong'])){
		$smarty->assign('wrong',true);
		unset($_SESSION['error']);
	}
	
	if(isset($_SESSION['succ']['change'])){
		$smarty->assign('succ',true);
		unset($_SESSION['succ']);
	}
	
	
	
	
	
	$smarty->display('template/pass.tpl');
}
?>