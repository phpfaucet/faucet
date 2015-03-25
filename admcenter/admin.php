<?php require_once "header.php";
if( isset($_GET['a']) && $_GET['a']=='delete' ){
	$aid=$_GET['aid'];
	$db->query("delete from tbl_admin where admin_id='$aid'");
	header('Location:admin.php');	
}elseif( isset($_POST['add']) ){
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$db->Query("insert into tbl_admin (username,password) values ('$username','$password') ");
	header('Location:admin.php');	
}else{
?>
<section id="main-content">
	<section class="wrapper">

		<section class="panel">
			<div class="panel-heading">
				Administrator
			</div>
			
            <table width="100%" class="table table-hover personal-task">

            
    <tr>
    <th width="2%">#</th>
    	<th width="86%">Username</th>
      <th width="12%">Action</th>
    </tr>


<?php
$db->query("select * from tbl_admin");
while($res=$db->fetcharray()){
?>

    <tr>
    <td>
    <?php echo ++$i; ?>
      	
    
    </td>
    	<td width="86%"><?php echo $res['username']; ?></td>
      <td width="12%"><a href="?a=delete&aid=<?php echo $res['admin_id'];?>" class="btn btn-danger btn-xs" onClick="return conf_delete()"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>



<?php } ?>




</table>
   
   
<div class="panel-body">    
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  New
</button>
   
</div>  
   
   
   <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
       
  
	<div class="form-group">
		<label for="exampleInputEmail1">Username</label>
		<input type="text" name="username" class="form-control" placeholder="">
	</div>
  
	<div class="form-group">
		<label for="exampleInputEmail1">Password</label>
		<input type="password" name="password" class="form-control" placeholder="">
	</div>
       
       
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn btn-primary">Add</button>
      </div>
    </div>
    </form>
    
  </div>
</div>
   
   
   
   
    
    
            
		</section>
        
	</section>
</section>
<?php }require_once "footer.php"; ?>