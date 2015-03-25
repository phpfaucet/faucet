{include file='template/header.tpl'}

<div id="blue"><div class="container"><div class="row"><h3>Change Password.</h3></div><!-- /row -->	    </div> <!-- /container -->	</div>


<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Change Passwprd</h3>




</div>
  



<div class="panel-body">
{if $wrong}<div class="alert alert-danger">Entered current password is wrong.</div>{/if}

{if $succ}<div class="alert alert-success">Password changed.</div>{/if}



<div class="row">



<form action="" method="post">



  <div class="form-group">
    <label>Current password</label>
    <input name="prepass" type="password" class="form-control" placeholder="Your Current password">
  </div>
  
  
  <div class="form-group">
    <label>New password</label>
    <input name="newpassword" type="password" class="form-control" placeholder="Your New Password">
  </div>



  <button type="submit" name="register" class="btn btn-success">Change</button>




</form>





</div>



  </div>
</div>




<br>

{include file='template/footer.tpl'}