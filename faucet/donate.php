<?php
require_once "header.php";
require_once "maincore.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
if( isset($_POST['PAYMENT_AMOUNT'] ) ){
	$prepare=$db->mysqli->prepare("insert into tbl_donate (user_id,amount,`date`,link) values (?,?,?,?)");
	$prepare->bind_param('iiis',$uid,$_POST['PAYMENT_AMOUNT'],time(),$_POST['link']);
	$prepare->execute();
	$insid=$prepare->insert_id;
	$prepare->store_result();
	$prepare->close();
	$db->queryres("select * from tbl_config where header='donate_type'");
	$dtype=$db->res['value'];
	
$db->queryres("select * from tbl_config where header='pusername'");
$pusername=$db->res['value'];
$db->queryres("select * from tbl_config where header='STORE_NAME'");
$STORE_NAME=$db->res['value'];
	
	
	
	?>	
<form action="https://www.asmoney.com/sci.aspx" method="post" id="frm">
    <input type="hidden" name="USER_NAME" value="<?php echo $pusername; ?>" />
    <input type="hidden" name="STORE_NAME" value="<?php echo $STORE_NAME; ?>" />
    <input type="hidden" name="PAYMENT_UNITS" value="<?php echo $dtype;?>" />
    <input type="hidden" name="PAYMENT_MEMO" value="Donate" />
    <input type="hidden" name="PAYMENT_ID" value="<?php echo md5($insid);  ?>" />
    <input type="hidden" class="form-control" name="PAYMENT_AMOUNT" value="<?php echo $_POST['PAYMENT_AMOUNT'];?>">
</form>
	<script>document.getElementById('frm').submit();</script>
    Please wait...
	<?php	
			
}else{
	$with=array();
	$db->query("select * from tbl_donate where user_id='$uid' order by date desc");
	while($res=$db->fetchArray()){
		$ar=array('amount'=>$res['amount'],'date'=>date('Y/m/d',$res['date']),'status'=>$res['status']);
		array_push($with,$ar);
	}

	$smarty->assign('with',$with);
	
	$db->queryres("select * from tbl_config where header='donate_min'");
	$smarty->assign('dmin',$db->res['value']);
	
	
	
	if(isset($_SESSION['error']['over'])){
		$smarty->assign('over',true);
		unset($_SESSION['error']);
	}
	
	
	
	if(isset($_SESSION['error']['donate'])){
		$smarty->assign('ed',true);
		unset($_SESSION['error']);
	}



	if(isset($_SESSION['succ']['donate'])){
		$smarty->assign('sd',true);
		unset($_SESSION['esuccrror']);
	}
	
	if(isset($_SESSION['succ']['penging'])){
		$smarty->assign('penging',true);
		unset($_SESSION['succ']);
	}
	
	
	
	
	$smarty->display('template/donate.tpl');
}
?>