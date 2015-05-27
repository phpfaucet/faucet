{include file='template/header.tpl'}
<div id="blue"><div class="container"><div class="row"><h3>Ask for Withdraw</h3></div><!-- /row -->	    </div> <!-- /container -->	</div>



<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Withdrawal



<span class="pull-right">
{$credit} {$curency}
</span>

</h3>




</div>
  

<table class="table table-striped">
  <thead>
    <tr>
      <th>Amount</th>
      <th>Date</th>
      <th>Type</th>
      <th>Status</th>
    </tr>
    </thead>
  <tbody>  
    
    {foreach from=$with item=foo}
    
    
    <tr>
      <td>{$foo['amount']}</td>
      <td>{$foo['date']}</td>
      <td>{if $foo['type']==0}Asmoney{else}Currency{/if}</td>
      <td>
      {if $foo['status']==0}
      
      	<div class="label label-warning">Pending</div>
      
      
      
      {elseif $foo['status']==1}
      
      	<div class="label label-success">Paid</div>
      
      
      {/if}
      
      
      
      </td>
    </tr>
    {/foreach}
    
    
    
    
  </tbody>
</table>

<div class="panel-body">
{if $over}
<div class="alert alert-danger">You have asked more than in your account</div>
{/if}



{if $less}
<div class="alert alert-danger">You are trying to withdrawal below the minimum amount.</div>
{/if}





<div class="row">






<div style="border:1px solid #ccc;padding:15px;margin-right:50px;" class="col-md-5">
  <h3>Withdraw to AsMoney</h3>

  AsMoney is a bitcoin payment processor that allow us to send micropayments<br><br>
  
Withdrawal any amount without minimum<br> Payment will be proceed instantly <br>
You can transfer your money to any cryptocoin from AsMoney<br> 
    If you don't have AsMoney account, create a <a href="https://www.asmoney.com/default.aspx" target="a_blank">new one</a><br>
<br><br><br>
  
<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#asmoney">
  Request a AsMoney withdrawal, minimum is ({$as_min})
</button>

</div>

<div class="col-md-5" style="border:1px solid #ccc;padding:15px;">
  <h3>Withdraw to coin</h3>You can withdraw balance directly to your crypto address but you need<br><br>your balance should higher than {$cur_min}<br> Payment will be proceed with delay<br><br><br><br><br><br>
  
<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">
  Request a coin withdrawal, minimum is ({$cur_min})
</button>

</div>
</div>









  </div>
</div>

<script type="text/javascript">
 function checkasmoney() {
 
var amount = document.asmoney.amount.value;
var wallet = document.asmoney.wallet.value;

if (amount <= 0) {
alert('Amount is incorrect');
return false;

}

if (wallet.length <= 1 ) {
    alert('Please Enter your AsMoney username'); 
    return false;
}

return true;

}

</script>

<div class="modal fade" id="asmoney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  
    <form action="" method="post" name="asmoney" onsubmit="return checkasmoney()">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Request a withdrawal</h4>
      </div>
      <div class="modal-body">
       
       
       
       
       
  <div class="form-group">
    <label for="exampleInputEmail1">Amount</label>
    <input type="text" class="form-control" name="amount" placeholder="Amount to withdrawal">
  </div>

{if {$asmoneyexist}}
Your Asmoney account : {$asmoneyexist}
{else}
  <div class="form-group">
    <label for="exampleInputEmail1">Wallet</label>
    <input type="text" class="form-control" name="wallet" placeholder="Asmoney username">
  </div>
 {/if}




       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" value="1" name="asmoney">Submit</button>
      </div>
    </div>
    
    </form>
    
  </div>
</div>




       
<script type="text/javascript">
function checkcoin() {
 
var address = document.coin.address.value;
var amount = document.coin.amount.value;


if (amount <= 0) {
alert('Amount is incorrect');
return false;

}

 if (address.length <= 15 )
{
    alert('Crypto address is not correct ');
return false;
}

if(/^[a-zA-Z0-9- ]*$/.test(address) == false) {
    alert('Crypto address is not correct ');
return false;
} 

return true;
}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  
  <form action="" method="post" name="coin" onsubmit="return checkcoin()">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Request a withdrawal</h4>
      </div>
      <div class="modal-body">
       
       
       
       
       
    <div class="form-group">
    <label for="exampleInputEmail1">Amount</label>
    <input type="text" class="form-control" name="amount" placeholder="Amount to withdrawal">
  </div>

{if {$cryptoexist}}
Your Crypto address : {$cryptoexist}
{else}
  <div class="form-group">
    <label for="exampleInputEmail1">Wallet</label>
    <input type="text" class="form-control" name="address" placeholder="crypto address">
  </div>
 {/if}


       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" value="1" name="currency">Submit</button>
      </div>
    </div>
    
    </form>
    
  </div>
</div>








<br>

{include file='template/footer.tpl'}