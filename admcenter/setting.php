<?php require_once "header.php";
require_once "../includes/dbconnector.class.php"; 
$db=new DbConnector;


if( isset($_POST['save']) ){


$db->query("update tbl_config set value='".$_POST['referral_percent']."' where header='referral_percent'");

$db->query("update tbl_config set value='".$_POST['timer']."' where header='timer'");

$db->query("update tbl_config set value='".$_POST['currency']."' where header='currency'");

$db->query("update tbl_config set value='".$_POST['donate_type']."' where header='donate_type'");

$db->query("update tbl_config set value='".$_POST['donate_min']."' where header='donate_min'");

$db->query("update tbl_config set value='".$_POST['privkey']."' where header='privkey'");

$db->query("update tbl_config set value='".$_POST['verkey']."' where header='verkey'");

$db->query("update tbl_config set value='".$_POST['hashkey']."' where header='hashkey'");



$db->query("update tbl_config set value='".$_POST['pusername']."' where header='pusername'");

$db->query("update tbl_config set value='".$_POST['papiname']."' where header='papiname'");

$db->query("update tbl_config set value='".$_POST['ppassword']."' where header='ppassword'");

$db->query("update tbl_config set value='".$_POST['STORE_NAME']."' where header='STORE_NAME'");


$db->query("update tbl_config set value='".$_POST['AsMoneymin']."' where header='AsMoneymin'");

$db->query("update tbl_config set value='".$_POST['currencymin']."' where header='currencymin'");

$db->query("update tbl_config set value='".$_POST['minimum_donate']."' where header='minimum_donate'");

$db->query("update tbl_config set value='".$_POST['sci_username']."' where header='sci_username'");
$db->query("update tbl_config set value='".$_POST['sci_pass']."' where header='sci_pass'");

$db->query("update tbl_config set value='".$_POST['requestcount']."' where header='requestcount'");




header('Location:setting.php');



}else{
?>


<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<div class="panel-body panel-heading">
						<div class="task-progress">
							<h1>Setting</h1>
						</div>
					</div>
					<div class="panel-body panel-heding">
                   <form action="" method="post"> 
   
			<?php $db->queryres("select * from tbl_config where header='referral_percent'"); ?><fieldset class="scheduler-border"><legend class="scheduler-border">Basic Setting</legend>
            <div class="form-group">
                <label for="exampleInputEmail1">Refferal Percent</label>
                    <input type="text" class="form-control" name="referral_percent" value="<?php echo $db->res['value'];?>">
            </div>


<?php $db->queryres("select * from tbl_config where header='timer'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Prize giving interval</label>
                    <input type="text" class="form-control" name="timer" value="<?php echo $db->res['value'];?>">
            </div>

<?php $db->queryres("select * from tbl_config where header='currency'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Currency</label>
                    
                    <select class="form-control" name="currency">
                    	<option value="BTC" <?php if($db->res['value']=='BTC') echo 'selected'; ?>>BTC</option>
                    	<option value="mBTC" <?php if($db->res['value']=='mBTC') echo 'selected'; ?>>mBTC</option>
                    	<option value="Satoshi" <?php if($db->res['value']=='Satoshi') echo 'selected'; ?>>Satoshi</option>
                    	<option value="LTC" <?php if($db->res['value']=='LTC') echo 'selected'; ?>>LTC</option>
                    	<option value="DOGE" <?php if($db->res['value']=='DOGE') echo 'selected'; ?>>DOGE</option>
                    	<option value="mDOGE" <?php if($db->res['value']=='mDOGE') echo 'selected'; ?>>mDOGE</option>
                    	<option value="PPC" <?php if($db->res['value']=='PPC') echo 'selected'; ?>>PPC</option>
                    	<option value="mPPC" <?php if($db->res['value']=='mPPC') echo 'selected'; ?>>mPPC</option>
                    	<option value="DRK" <?php if($db->res['value']=='DRK') echo 'selected'; ?>>DRK</option>
                    	<option value="mDRK" <?php if($db->res['value']=='mDRK') echo 'selected'; ?>>mDRK</option>
                    </select>
            </div>
</fieldset>

<fieldset class="scheduler-border">    <legend class="scheduler-border">Donate Setting</legend>
<?php $db->queryres("select * from tbl_config where header='donate_type'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Donate Currency</label>
                    <input type="text" class="form-control" name="donate_type" value="<?php echo $db->res['value'];?>">
            </div>

<?php $db->queryres("select * from tbl_config where header='donate_min'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Donate minimum</label>
                    <input type="text" class="form-control" name="donate_min" value="<?php echo $db->res['value'];?>">
            </div>			<?php $db->queryres("select * from tbl_config where header='minimum_donate'"); ?>            <div class="form-group">                <label for="exampleInputEmail1">Minimum amount to danate to show link</label>                    <input type="text" class="form-control" name="minimum_donate" value="<?php echo $db->res['value'];?>">            </div>
</fieldset>
<fieldset class="scheduler-border">  <legend class="scheduler-border">Captcha Setting</legend>  
<?php $db->queryres("select * from tbl_config where header='privkey'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Solvemedia Challenge Key (C-key)</label>
                    <input type="text" class="form-control" name="privkey" value="<?php echo $db->res['value'];?>">
            </div>

<?php $db->queryres("select * from tbl_config where header='verkey'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Solvemedia Verification key (V-Key)</label>
                    <input type="text" class="form-control" name="verkey" value="<?php echo $db->res['value'];?>">
            </div>
            
<?php $db->queryres("select * from tbl_config where header='hashkey'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Solvemedia Hashkey</label>
                    <input type="text" class="form-control" name="hashkey" value="<?php echo $db->res['value'];?>">
            </div>
</fieldset>


<fieldset class="scheduler-border">  <legend class="scheduler-border">API Setting (Send Prize)</legend>  
<?php $db->queryres("select * from tbl_config where header='pusername'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">AsMoney Username</label>
                    <input type="text" class="form-control" name="pusername" value="<?php echo $db->res['value'];?>">
            </div>




<?php $db->queryres("select * from tbl_config where header='papiname'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">API name</label>
                    <input type="text" class="form-control" name="papiname" value="<?php echo $db->res['value'];?>">
            </div>



<?php $db->queryres("select * from tbl_config where header='ppassword'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">AsMoney Password</label>
                    <input type="text" class="form-control" name="ppassword" value="<?php echo $db->res['value'];?>">
            </div>

</fieldset>



<fieldset class="scheduler-border">  <legend class="scheduler-border">Merchant Setting (Accept Donate)</legend>

<?php $db->queryres("select * from tbl_config where header='sci_username'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">AsMoney Username SCI</label>
                    <input type="text" class="form-control" name="sci_username" value="<?php echo $db->res['value'];?>">
            </div>




<?php $db->queryres("select * from tbl_config where header='STORE_NAME'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">AsMoney Shopname SCI</label>
                    <input type="text" class="form-control" name="STORE_NAME" value="<?php echo $db->res['value'];?>">
            </div>



<?php $db->queryres("select * from tbl_config where header='sci_pass'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">AsMoney Password SCI</label>
                    <input type="text" class="form-control" name="sci_pass" value="<?php echo $db->res['value'];?>">
            </div>
</fieldset>






<fieldset class="scheduler-border">  <legend class="scheduler-border">Withdraw Setting </legend>
<?php $db->queryres("select * from tbl_config where header='AsMoneymin'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">AsMoney Withdrawal minimum</label>
                    <input type="text" class="form-control" name="AsMoneymin" value="<?php echo $db->res['value'];?>">
            </div>




<?php $db->queryres("select * from tbl_config where header='currencymin'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Currency Withdrawal minimum</label>
                    <input type="text" class="form-control" name="currencymin" value="<?php echo $db->res['value'];?>">
            </div>

			
<?php $db->queryres("select * from tbl_config where header='requestcount'"); ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Minimum BTC Queue for withdrawal<small>Only for BTC faucets</small></label>
			
<select name="requestcount" class="form-control">
  <option>10</option>
  <option>20</option>
  <option>30</option>
  <option>40</option>
  <option>50</option>
</select> Current is <?php echo $db->res['value'];?>
			
</div>
</fieldset>
            <div class="form-group">
				<button name="save" class="btn btn-success" value="1">Save</button>
            </div>

</form>
					</div>
				</section>
			</div>
		</div>                           


<script>
$.validate({validateOnBlur : false,errorMessagePosition : 'bottom' });
</script>




	</section>
</section>    

<?php }require_once "footer.php";?>
