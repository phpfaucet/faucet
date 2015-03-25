<?php

require_once "maincore.php";
require_once "includes/dbconnector.class.php";
require_once "includes/AsmoneyAPI.php";
$db=new DbConnector;
$db->queryres("select * from tbl_config where header='currency'");
$currency=$db->res['value'];
$db->queryres("select * from tbl_config where header='pusername'");
$pusername=$db->res['value'];
$db->queryres("select * from tbl_config where header='papiname'");
$papiname=$db->res['value'];
$db->queryres("select * from tbl_config where header='ppassword'");
$ppassword=$db->res['value'];

$api = new AsmoneyAPI($pusername,$papiname, $ppassword);

$db->query("select * from tbl_withdrawal where status=0");
while($res=$db->fetchArray()){
	
	if($res['type']==0){
		$r = $api->Transfer($res['wallet'],$res['amount'],$currency,'Withdrawal'); // Payment memo
		if ($r['result'] == APIerror::OK){
			$batchno = $r['value'];
			$db2->query("update tbl_withdrawal set status=1,reccode='$batchno' where withdrawal_id='".$res['withdrawal_id']."'");
		}
	}else{
	
		$db2->queryres("select * from tbl_user where user_id='".$res['user_id']."'");
		$address=$db2->res['address'];
		$amount=$res['amount'];


		if( $currency=='mBTC' ){
			$r = $api->TransferBTC($address,$amount,'mBTC','Withdrawal');
		}
		
		
		if( $currency=='mLTC' ){
			$r = $api->TransferLTC($address,$amount,'mLTC','Withdrawal');
		}
		
		
		if( $currency=='mDRK' ){
			$r = $api->TransferDRK($address,$amount,'mDRK','Withdrawal');
		}
		
		
		if( $currency=='mPPC' ){
			$r = $api->TransferPPC($address,$amount,'mPPC','Withdrawal');
		}
		
		
		if( $currency=='mDOGE' ){
			$r = $api->TransferDOGE($address,$amount,'mDOGE','Withdrawal');
		}
		
		if ($r['result'] == APIerror::OK){
			$batchno = $r['value'];
			$db2->query("update tbl_withdrawal set status=1,reccode='$batchno' where withdrawal_id='".$res['withdrawal_id']."'");
		}
    
	}

}



/*











*/

?>