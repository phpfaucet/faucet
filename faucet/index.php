<?php
require_once "header.php";
require_once "maincore.php";

require_once "includes/solvemedialib.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
if(isset($_POST['claim'])){
	
$solvemedia_response = solvemedia_check_answer($verkey,$_SERVER["REMOTE_ADDR"],$_POST['adcopy_challenge'],$_POST['adcopy_response'],$hashkey);
	if($solvemedia_response->is_valid ){
	
		$db2->query("select * from tbl_prize order by chance desc ");
		while($res2=$db2->fetchArray()){
			$prize.=$res2['prize'].'*'.$res2['chance'].',';	
		}
	
		
		if(!isset($_SESSION['prize']))
			$_SESSION['prize']=chance_creator($prize);
	
		$db->queryres("select * from tbl_config where header='timer'");
		$timer=NOW+($db->res['value']*60);
		$db->query("update tbl_user set credit=credit+'".$_SESSION['prize']."',reset='$timer',ip='$ip' where user_id='$uid'");
		$rid=$userdet['parent_id'];
	
		if($rid){
			$db->queryres("select * from tbl_config where header='referral_percent'");
			$profit=($_SESSION['prize']*$db->res['value'])/100;
			$db->query("update tbl_user set credit=credit+'$profit' where user_id='$rid'");
		}
		
		$_SESSION['user']['win']=$_SESSION['prize'];
		unset($_SESSION['prize']);
		header('Location:index.php');

	}else{
		unset($_SESSION['succ']);
		unset($_SESSION['error']);
		$_SESSION['error']['capt']=true;
		header('Location:index.php?er=captcha');
	}
}else{

if(isset($uid)){


if(isset($_SESSION['user']['win'])){
	$db->queryres("select * from tbl_config where header='currency'");
	$smarty->assign('prize',$_SESSION['user']['win']);
	$smarty->assign('curency',$db->res['value']);
	
}

if(isset($_SESSION['error']['capt'])){
	$smarty->assign('capt',true);
	unset($_SESSION['error']);
}







$db->queryres("select reset from tbl_user where user_id='$uid' or ip='$ip' order by reset desc");
	if($db->res['reset']-time() > 0){
		$smarty->assign('timer',true);
		$smarty->assign('timer_amount',$db->res['reset']-time());
	}




	$with=array();
	$db->query("select * from tbl_donate where status=2 order by rand() limit 20");
	while($res=$db->fetchArray()){
		$ar=array('link'=>$res['link']);
		array_push($with,$ar);
	}
	$smarty->assign('with',$with);

$smarty->assign('captcha',solvemedia_get_html($privkey));


}else{
	
	$smarty->assign('notlogged',true);
	
	
}








$smarty->display('template/index.tpl');

}

?>