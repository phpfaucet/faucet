<?php require_once "header.php";
require_once "../includes/dbconnector.class.php"; 
$db=new DbConnector;


if( isset($_POST['new_price']) ){
	$prize=$_POST['prize'];
	$prepare=$db->mysqli->prepare("insert into tbl_prize (prize) values (?) ");
	$prepare->bind_param('d',$prize);
	$prepare->execute();
	$prepare->close();
	header('Location: prize.php');
}elseif( isset($_GET['a']) && $_GET['a']=='prize_up' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+1 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
}elseif( isset($_GET['a']) && $_GET['a']=='prize_down' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-1 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_downdd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-20 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_downddd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-30 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+2 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_updd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+20 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_upddd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance+30 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
	
	
	
	
	
}elseif( isset($_GET['a']) && $_GET['a']=='prize_downd' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("update tbl_prize set chance=chance-2 where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
}elseif( isset($_GET['a']) && $_GET['a']=='prize_remove' ){	
	$pid=$_GET['pid'];
	$prepare=$db->mysqli->prepare("delete from  tbl_prize where prize_id=? ");
	$prepare->bind_param('i',$pid);
	$prepare->execute();
	header('Location: prize.php');
}else{
	
	
$db->query("select * from tbl_prize order by chance desc");
	
	
	
	
	
/*	
	q = select val, id from prizes order by val desc

$t = 0;
for each (a in q)
{
a.val = a.val * 100 + t;
t += a;
}

int r = Random.Next(t);

for each (a in q)
{
if (r < a.val)
return a.id;
}
	*/
	
	
	
	
	
	
	
	
	
?>


<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<div class="panel-body panel-heading">
						<div class="task-progress">
							<h1>Prize</h1>
						</div>
					</div>
					<div class="panel-body panel-heding">
                    
                        <div class="row">
                            <div class="alert alert-info">Here you can manage your prizes in your faucet</div>
                        </div>
                    
                        <div class="row">
                        
                        
                        
<table width="100%" class="table table-hover personal-task">

    <tr>
      <th width="26%">Prize</th>
      <th width="30%">Chance</th>
      <th width="17%">&nbsp;</th>
    </tr>

  <tbody>
<?php
$prizes=array();
$db->query("select * from tbl_prize order by chance desc");
if($db->rownum()>0){

while($res=$db->fetchArray()){
	array_push($prizes,$res['prize'].'*'.$res['chance']);
}

$chancer=get_rewards( implode(',',$prizes) );
}

$db->query("select * from tbl_prize order by chance desc");
while($res=$db->fetchArray()){
?>
    <tr>
      <td width="26%"><?php echo $res['prize']; ?></td>
      <td width="30%"><?php echo $chancer[$res['prize']]; ?></td>
      <td width="17%">
      
      	<a class="btn btn-success btn-xs tooltips" href="?a=prize_up&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="left" title="Chance up low"><i class="fa fa-sort-asc" style="color:#FFFFFF"></i></a>
      
      
      	<a class="btn btn-success btn-xs tooltips" href="?a=prize_upd&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="left" title="Chance up high"><i class="fa fa-chevron-up" style="color:#FFFFFF"></i></a>
      
      	<a class="btn btn-success btn-xs tooltips" href="?a=prize_updd&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="left" title="Chance up very high"><i class="fa fa-chevron-up" style="color:#FFFFFF"></i></a>
      
      
      	<a class="btn btn-success btn-xs tooltips" href="?a=prize_upddd&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="left" title="Chance up very very high"><i class="fa fa-chevron-up" style="color:#FFFFFF"></i></a>
      
      
      
      <br>

      
      
      
      <?php if($res['chance']>1){?>
      	<a class="btn btn-warning btn-xs tooltips" href="?a=prize_down&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="top" title="Chance down low"><i class="fa fa-sort-desc" style="color:#FFFFFF"></i></a>
      <?php } ?>
      

      
      
      
      
      
      <?php if($res['chance']>2){?>
      	<a class="btn btn-warning btn-xs tooltips" href="?a=prize_downd&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="top" title="Chance down high"><i class="fa fa-chevron-down" style="color:#FFFFFF"></i></a>
      <?php } ?>
      
      
      
      
      
      
      <?php if($res['chance']>20){?>
      	<a class="btn btn-warning btn-xs tooltips" href="?a=prize_downdd&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="top" title="Chance down very high"><i class="fa fa-chevron-down" style="color:#FFFFFF"></i></a>
      <?php } ?>
      
      
      
      <?php if($res['chance']>30){?>
      	<a class="btn btn-warning btn-xs tooltips" href="?a=prize_downddd&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="top" title="Chance down very high"><i class="fa fa-chevron-down" style="color:#FFFFFF"></i></a>
      <?php } ?>
      
      
      
      
      
      	<a class="btn btn-danger btn-xs tooltips" href="?a=prize_remove&pid=<?php echo $res['prize_id'];?>" data-toggle="tooltip" data-placement="right" title="Remove"><i class="fa fa-trash-o" style="color:#FFFFFF"></i></a>
      
      
      
      
      </td>
    </tr>
<?php } ?>
</tbody>
</table>
                        
                        </div>
   
   <div class="row">
                    

<form action="" method="post">


<div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Prize</label>
                <div class="input-group">
                    <div class="input-group-addon">Amount</div>
                    <input type="text" class="form-control tooltips" name="prize" placeholder="Amount">
                </div>
            </div>
</div>
<div class="col-md-6">

  <div class="form-group">
    <br>

    <button type="submit" name="new_price" class="btn btn-success">Add</button>
  </div>

    

</div>


  
</form>





</div>



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