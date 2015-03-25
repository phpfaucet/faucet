{include file='template/header.tpl'}
<div id="blue"><div class="container"><div class="row"><h3>Login to your account</h3></div><!-- /row -->	    </div> <!-- /container -->	</div>

<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Login</h3></div>




<div class="panel-body">

{if $invalid}
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger text-center" role="alert">
        The enetered username / password is wrong
        </div>
    </div>
</div>
{/if}




<form method="post">
  <div class="form-group">
    <label>Username</label>
    <input name="username" type="text" class="form-control" placeholder="Your Username">
  </div>
  
  <div class="form-group">
    <label>Password</label>
    <input name="password" type="password" class="form-control" placeholder="Your Password">
  </div>
  
  <button type="submit" name="register" class="btn btn-success">Login</button>
</form>

</div>
</div>
</div>




{include file='template/footer.tpl'}