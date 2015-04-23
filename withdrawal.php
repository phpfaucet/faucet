<?php
error_reporting(E_ALL & ~ E_NOTICE); ini_set('display_errors', 1);
require_once "header.php";
require_once "maincore.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
if( isset($_POST['currency'] ) ){


		if (isset($_POST['address'])) {
			$address = $_POST['address'];
			$prepare=$db->mysqli->prepare("select user_id from tbl_user where address=?");
			$prepare->bind_param('s',$address);
			$prepare->execute();
			$prepare->store_result();
			$ucount=$prepare->num_rows;
			$prepare->close();
			if(!$ucount){
			$prepare=$db->mysqli->prepare("update tbl_user set address = ? where user_id = ? ");
			$prepare->bind_param('si',$address,$uid);
			$prepare->execute();
			$prepare->close();
			} else {
			$_SESSION['error']['addressexist']=true;
			return;
			}

		}
		
	$db->queryres("SELECT * from tbl_config where header='currency'");

	$curtype = $db->res['value'];
	$amount=$_POST['amount'];
	/*Bitcoin :  Transfer all payment in one transaction without fees | mBTCLitecoin : 1% + 1 mLTCDogecoin : 1% + 1.0 DogePeercoin : 1% + 10 mPPCDarkcoin : 1% + 1 mDRK */

	switch ($curtype)
	{		
	case "BTC" :			$fees = $amount;			break;
	case "mBTC" :			$fees = $amount;			break;
	case "Satoshi" :		$fees = $amount;			break;
	case "LTC" :			$fees = $amount - (($amount/100.0) + 0.001);			break;
	case "mLTC" :			$fees = $amount - (($amount/100.0) + 1);			break;
	case "DOGE" :			$fees = $amount - (($amount/100.0) + 1);			break;
	case "mDOGE" :			$fees = $amount - (($amount/100.0) + 1000);			break;
	case "PPC" :			$fees = $amount - (($amount/100.0) + 0.01);			break;
	case "mPPC" :			$fees = $amount - (($amount/100.0) + 10);			break;
	case "DRK" :			$fees = $amount - (($amount/100.0) + 0.001);			break;
	case "mDRK" :			$fees = $amount - (($amount/100.0) + 1);			break;
	}
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

			if (isset($_POST['wallet'])) {
			$ausername = $_POST['wallet'];
			$prepare=$db->mysqli->prepare("select user_id from tbl_user where ausername=?");
			$prepare->bind_param('s',$ausername);
			$prepare->execute();
			$prepare->store_result();
			$ucount=$prepare->num_rows;
			$prepare->close();
			if(!$ucount){
			$prepare=$db->mysqli->prepare("update tbl_user set ausername = ? where user_id = ? ");
			$prepare->bind_param('si',$ausername,$uid);
			$prepare->execute();
			$prepare->close();
			} 
			else {
			$_SESSION['error']['accountexist']=true;
			return;
			}

		}
		
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
	
	
	
	if(isset($_SESSION['error']['addressexist'])){
		$smarty->assign('addressexist',true);
		unset($_SESSION['error']);
	}
	
		if(isset($_SESSION['error']['accountexist'])){
		$smarty->assign('accountexist',true);
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
	
	$db->queryres("SELECT * FROM tbl_user where user_id='$uid' ");
	$asmoneyacc = $db->res['ausername'];
	$cryptoaddress = $db->res['address'];
	if ($asmoneyacc != NULL) {
	$smarty->assign('asmoneyexist',$asmoneyacc);
	}
	if ($cryptoaddress != NULL) {
	$smarty->assign('cryptoexist',$cryptoaddress);
	}
	
	$smarty->display('template/withdrawal.tpl');
}
?>