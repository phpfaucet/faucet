<?php
require_once "header.php";
require_once "maincore.php";


	$db->queryres("SELECT * FROM tbl_config where header='referral_percent' ");




	$smarty->assign('rfp',$db->res['value']);

	
	$smarty->assign('uid',$userdet['user_id']);
	
	
	
	
	
	$db->queryres("select count(user_id) as countref from tbl_user where parent_id='".$userdet['user_id']."'");
	
	
	$smarty->assign('count',($db->res['countref'])? $db->res['countref'] : 0 );
	
	$smarty->display('template/referral.tpl');
?>