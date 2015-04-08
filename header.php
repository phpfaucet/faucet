<?php
require_once "maincore.php";



if(isset($_GET['r']) &&  $_GET['r']>0){

		//If IP referral not equal with user IP
		
	$ruid = $_GET['r'];
	$prepare=$db->mysqli->prepare("select ip from tbl_user where user_id=?");
	$prepare->bind_param('i',$ruid);
	$prepare->execute();
	$prepare->bind_result($refip);
	$prepare->fetch();
	
	if ( $ip != $refip ) {
	setcookie('r', trim($_GET['r']), time() + 60 * 60 * 24 * 30);
	}
	$prepare->close();
	
}



if(isset($uid)){
	
	

	
	
	
	
	
	
	
}

if(isset($uid) ){


$smarty->assign('logged',true);


}


?>