<?php
require_once "maincore.php";



if(isset($_GET['r']) &&  $_GET['r']>0){
	
	setcookie('r', trim($_GET['r']), time() + 60 * 60 * 24 * 30);
	
}



if(isset($uid)){
	
	

	
	
	
	
	
	
	
}

if(isset($uid) ){


$smarty->assign('logged',true);


}


?>