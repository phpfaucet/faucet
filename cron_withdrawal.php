<?php
error_reporting(E_ALL & ~ E_NOTICE); ini_set('display_errors', 1);
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
function ChangetoMili($amount,&$currency) {
	switch ($currency)
	{		
	case "BTC" : $amount = $amount * 1000;$currency="mBTC";return $amount;
	case "mBTC" :return $amount;
	case "Satoshi" : $amount = $amount / 10000;$currency="mBTC";return $amount;
	case "LTC" :$amount = $amount * 1000;$currency="mLTC";return $amount;
	case "mLTC" :return $amount;
	case "DOGE" :$amount = $amount * 1000;$currency="mDOGE";return $amount;
	case "mDOGE" :	return $amount;
	case "PPC" :$amount = $amount * 1000;$currency="mPPC";return $amount;
	case "mPPC" :return $amount;
	case "DRK" :$amount = $amount * 1000;$currency="mDRK";return $amount;
	case "mDRK" :return $amount;		
	}
}
	
$api = new AsmoneyAPI($pusername,$papiname, $ppassword);
//Change to mili bitcoin because asmoney get currencies based on milicoin
$db->query("select * from tbl_withdrawal where status=0");
while($res=$db->fetchArray()){
	
	if($res['type']==0){
		$db2->queryres("select * from tbl_user where user_id='".$res['user_id']."'");
		$ausername=$db2->res['ausername'];

		$amount = ChangetoMili($res['amount'],$currency);
		$r = $api->Transfer($ausername,$amount,$currency,'Withdrawal'); // Payment memo		echo $r['result'];
		if ($r['result'] == APIerror::OK){
			$batchno = $r['value'];
			$db2->query("update tbl_withdrawal set status=1,reccode='$batchno' where withdrawal_id='".$res['withdrawal_id']."'");			echo "Withdrawal has been proceessed with bactch number " .$batchno. "<br>" ;
		} else {
		if ($r['result'] == APIerror::InvalidUser )
		{		echo "Invalid User";		}
		if ($r['result'] == APIerror::InvalidAPIData )
		{		echo "API login is invalid";		}
		if ($r['result'] == APIerror::InvalidIP   ) 
		{		echo "IP is not match";		}
		if ($r['result'] == APIerror::InvalidIPSetup )
		{		echo "IP Setup invalid";		}
		if ($r['result'] == APIerror::InvalidCurrency ) 
		{		echo "Currency is not valid";		}
		if ($r['result'] == APIerror::InvalidReceiver ) 
		{		echo "Receiver is invalid";		}
		if ($r['result'] == APIerror::NotEnoughMoney )
		{		echo "Not Enough Money";		}
		if ($r['result'] == APIerror::APILimitReached )
		{		echo "API Limit Reach";		}
		if ($r['result'] == APIerror::Invalid )
		{		echo "An Error Occured";		}	
		}
    
		
	}else{
	
		$db2->queryres("select * from tbl_user where user_id='".$res['user_id']."'");
		$address=$db2->res['address'];
		$amount = ChangetoMili($res['amount'],$currency);


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
			$db2->query("update tbl_withdrawal set status=1,reccode='$batchno' where withdrawal_id='".$res['withdrawal_id']."'");			echo "Withdrawal has been proceessed with bactch number " .$batchno. "<br>" ;
		} else {		if ($r['result'] == APIerror::InvalidUser ) {		echo "Invalid User";		}		if ($r['result'] == APIerror::InvalidAPIData ) {		echo "API login is invalid";		}		if ($r['result'] == APIerror::InvalidIP   ) {		echo "IP is not match";		}		if ($r['result'] == APIerror::InvalidIPSetup ) {		echo "IP Setup invalid";		}		if ($r['result'] == APIerror::InvalidCurrency ) {		echo "Currency is not valid";		}		if ($r['result'] == APIerror::InvalidReceiver ) {		echo "Receiver is invalid";		}		if ($r['result'] == APIerror::NotEnoughMoney ) {		echo "Not Enough Money";		}		if ($r['result'] == APIerror::APILimitReached ) {		echo "API Limit Reach";		}		if ($r['result'] == APIerror::Invalid ) {		echo "An Error Occured";		}				}
    
	}

}
?>