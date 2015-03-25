<?php
require_once "header.php";
require_once "maincore.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
if( isset($_POST['register'] ) ){
	$username=$_POST['username'];
	$password=md5($_POST['password']);

	$prepare=$db->mysqli->prepare("select user_id,password from tbl_user where username=?");
	$prepare->bind_param('s',$username);
	$prepare->execute();
	$prepare->bind_result($uid,$pass);
	$prepare->fetch();
	$prepare->close();
	
	if($password==$pass){
		$_SESSION['user']['logged']=true;
		$_SESSION['user']['uid']=$uid;
		header('Location:index.php');
	}else{
		
		$_SESSION['error']['invalid']=true;
		header('Location:login.php');
		
	}
}else{
	if( isset( $_SESSION['error']['invalid'])) {
		$smarty->assign('invalid',true);
		unset( $_SESSION['error'] ) ;
	}
	$smarty->display('template/login.tpl');
}
?>