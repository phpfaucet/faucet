<?php
require_once "header.php";
require_once "../includes/AsmoneyAPI.php";

?>
<section id="main-content">
	<section class="wrapper">




              <div class="row state-overview">
                  <div class="col-md-3" >
                      <section class="panel" data-step="1" data-intro="This is your calculated account balance including all of your currencies in sum" data-position="right">
                          <div class="symbol blue"><i class="fa fa-user"></i></div>
                          <div class="value">
                              <h1><?php
                              $db->queryres("select count(user_id) as ucount from tbl_user");
							  echo number_format($db->res['ucount']);
							  ?></h1>
                              <p>Total User</p>
                          </div>
                      </section>
                  </div>
                  
                  
                  <div class="col-md-3" >
                      <section class="panel" data-step="1" data-intro="This is your calculated account balance including all of your currencies in sum" data-position="right">
                          <div class="symbol terques"><i class="fa fa-money"></i></div>
                          <div class="value">
                              <h1><?php
                              $db->queryres("select sum(amount) as amsum from tbl_withdrawal where status=1 and type=0");
							  echo number_format($db->res['amsum']);
							  ?></h1>
                              <p>Total Paid in asmony currency</p>
                          </div>
                      </section>
                  </div>
                  
                  
                  
                  <div class="col-md-3" >
                      <section class="panel" data-step="1" data-intro="This is your calculated account balance including all of your currencies in sum" data-position="right">
                          <div class="symbol yellow"><i class="fa fa-btc"></i></div>
                          <div class="value">
                              <h1><?php
                              $db->queryres("select sum(amount) as amsum from tbl_withdrawal where status=1 and type=1");
							  echo number_format($db->res['amsum']);
							  ?></h1>
                              <p>Total Paid in <?php $db->queryres("select * from tbl_config where header='currency'"); echo $db->res['value']; ?></p>
                          </div>
                      </section>
                  </div>
                  
                  
                  <div class="col-md-3" >
                      <section class="panel" data-step="1" data-intro="This is your calculated account balance including all of your currencies in sum" data-position="right">
                          <div class="symbol red"><i class="fa fa-credit-card"></i></div>
                          <div class="value">
                              <h1><?php
                              $db->queryres("select sum(amount) as amsum from tbl_donate where status!=0");
							  echo number_format($db->res['amsum']);
							  ?></h1>
                              <p>Total Donated</p>
                          </div>
                      </section>
                  </div>
        
        
                  
                  
                  
                  
</div>



              <div class="row state-overview">





                  <div class="col-md-3" >
                      <section class="panel" data-step="1" data-intro="This is your calculated account balance including all of your currencies in sum" data-position="right">
                          <div class="symbol blue"><i class="fa fa-money"></i></div>
                          <div class="value">
                              <h1><?php
							  
							  
							  
$db->queryres("select * from tbl_config where header='pusername'");
$pusername=$db->res['value'];
$db->queryres("select * from tbl_config where header='papiname'");
$papiname=$db->res['value'];
$db->queryres("select * from tbl_config where header='ppassword'");
$ppassword=$db->res['value'];
	
							  
							  
							  
$db->queryres("select * from tbl_config where header='currency'");
$currency=$db->res['value'];
function changecur(&$currency) {	switch ($currency)	{			    case "BTC" : 	    case "mBTC" :	    case "Satoshi" :			$currency="mBTC";			break;	    case "LTC" :	    case "mLTC" :			$currency="mLTC";			break;	    case "DOGE" :	    case "mDOGE" :			$currency="mDOGE";			break;	    case "PPC" :	    case "mPPC" :			$currency="mPPC";			break;	    case "DRK" :	    case "mDRK" :			$currency="mDRK";			break;	}}

							  $api = new AsmoneyAPI($pusername,$papiname,$ppassword);
changecur($currency);							 
$r = $api->GetBalance($currency); // Possible values are 'EUR', 'mBTC', 'mLTC', 'GBP'
    echo $balance = $r['value'];
	
							  
							  
							  
							  
							  ?></h1>
                              <p>Balance</p>
                          </div>
                      </section>
                  </div>






</div>





	</section>
</section>    
<?php
require_once "footer.php";
?>