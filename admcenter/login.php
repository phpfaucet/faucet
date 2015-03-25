<?php
require_once "header.php";
if(isset($_POST['login'])){
	$username=trim($_POST['username']);
	$password=md5($_POST['password']);
	$prepare=$db->mysqli->prepare("select admin_id,username,password from tbl_admin where username=?");
	$prepare->bind_param('s',$username);
	$prepare->execute();
	$prepare->bind_result($aid,$username,$pass);
	$prepare->fetch();
	$prepare->close();
	if(is_numeric($aid) && $password==$pass){
		$_SESSION['admin']['logged']=true;
		$_SESSION['admin']['aid']=$aid;
		header('Location:index.php');
	}else{
		$_SESSION['error']['invalid']=true;
		header('Location:login.php');
	}
}else{	
?>
<div class="container">
	<form enctype="application/x-www-form-urlencoded" class="form-signin" action="" method="post">
		<h2 class="form-signin-heading">Login</h2>
		<div class="login-wrap">
        

			<div class="form-group">
				<input type="text" name="username" id="username" value="" placeholder="Username" class="form-control input-lg ltr">
			</div>
        

			<div class="form-group">
				<input type="password" name="password" id="password" value="" placeholder="Password" class="form-control input-lg ltr">
			</div>
            
            
            <div class="row">
			  <button class="btn btn-lg btn-login btn-block" name="login" type="submit">Enter</button>
            </div>
            
            
            
            
      </div>
	</form>
</div>
<?php }require_once "footer.php";?>