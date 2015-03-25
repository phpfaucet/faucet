<?php
require_once "header.php";
require_once "maincore.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
if( isset($_POST['currency'] ) ){
	$db->queryres("SELECT * from tbl_config where header='currency'");	$curtype = $db->res['value'];	$amount=$_POST['amount'];		/*Bitcoin :  1% + 0.1 mBTCLitecoin : 1% + 1 mLTCDogecoin : 1% + 1.0 DogePeercoin : 1% + 10 mPPCDarkcoin : 1% + 1 mDRK */	switch ($curtype) {		case "BTC" :			$fees = $amount - (($amount/100.0) + 0.0001);			break;		case "mBTC" :			$fees = $amount - (($amount/100.0) + 0.1);			break;		case "Satoshi" :			$fees = $amount - (($amount/100.0) + 10000);			break;		case "LTC" :			$fees = $amount - (($amount/100.0) + 0.001);			break;		case "mLTC" :			$fees = $amount - (($amount/100.0) + 1);			break;		case "DOGE" :			$fees = $amount - (($amount/100.0) + 1);			break;		case "mDOGE" :			$fees = $amount - (($amount/100.0) + 1000);			break;		case "PPC" :			$fees = $amount - (($amount/100.0) + 0.01);			break;		case "mPPC" :			$fees = $amount - (($amount/100.0) + 10);			break;		case "DRK" :			$fees = $amount - (($amount/100.0) + 0.001);			break;		case "mDRK" :			$fees = $amount - (($amount/100.0) + 1);			break;		}
	$db->queryres("SELECT * FROM tbl_config where header='currencymin' ");
		
	
	if($amount>=$db->res['value']){
		if($userdet['credit']>=$amount){
			$prepare=$db->mysqli->prepare("insert into tbl_withdrawal (user_id,amount,type) values (?,?,1) ");
			$prepare->bind_param('id',$uid,$fees);
			$prepare->execute();
			$prepare->close();
			$db->query("update tbl_user set credit=credit-'$amount' where user_id='$uid'");		
			header('Location:withdrawal.php');
		}else
			$_SESSION['error']['over']=true;
	}else
		$_SESSION['error']['less']=true;
header('Location:withdrawal.php');
}elseif( isset($_POST['asmoney'] ) ){
	$amount=$_POST['amount'];
	$db->queryres("SELECT * FROM tbl_config where header='asmoneymin' ");

	if($amount>=$db->res['value']){
		if($userdet['credit']>=$amount){
			$prepare=$db->mysqli->prepare("insert into tbl_withdrawal (user_id,amount,type) values (?,?,0) ");
			$prepare->bind_param('id',$uid,$amount);
			$prepare->execute();
			$prepare->close();
			$db->query("update tbl_user set credit=credit-'$amount' where user_id='$uid'");		
			header('Location:withdrawal.php');
		}else
			$_SESSION['error']['over']=true;
	}else
		$_SESSION['error']['less']=true;
header('Location:withdrawal.php');
}else{
	$with=array();
	$db->query("select * from tbl_withdrawal where user_id='$uid' order by date desc");
	while($res=$db->fetchArray()){
		$ar=array('amount'=>$res['amount'],'date'=>($res['date'])? date('Y/m/d',$res['date']) : '','status'=>$res['status'],'type'=>$res['type']);
		array_push($with,$ar);
	}

	$db->queryres("select * from tbl_config where header='currency'");
	$smarty->assign('curency',$db->res['value']);
	$smarty->assign('credit',$userdet['credit']);
	$smarty->assign('with',$with);
	
	
	
	if(isset($_SESSION['error']['over'])){
		$smarty->assign('over',true);
		unset($_SESSION['error']);
	}
	
	
	if(isset($_SESSION['error']['less'])){
		$smarty->assign('less',true);
		unset($_SESSION['error']);
	}
	$db->queryres("SELECT * FROM tbl_config where header='currencymin' ");
	
	
	$smarty->assign('cur_min',$db->res['value']);
	$db->queryres("SELECT * FROM tbl_config where header='asmoneymin' ");
	$smarty->assign('as_min',$db->res['value']);
	
	
	$smarty->display('template/withdrawal.tpl');
}
?>