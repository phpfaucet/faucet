<?php require_once "header.php";
require_once "../includes/dbconnector.class.php"; 
$db=new DbConnector;


if( isset($_GET['a']) && $_GET['a']=='deac'  ){
$did=$_GET['did'];
$db->query("update tbl_donate set status=1 where donate='$did'");
header('Location:donate.php');




}elseif( isset($_GET['a']) && $_GET['a']=='ac'  ){

$did=$_GET['did'];
$db->query("update tbl_donate set status=2 where donate='$did'");
header('Location:donate.php');
}else{
	
	$db2->queryres("select * from tbl_config where header='minimum_donate'"); 
	
?>


<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
                  <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Donate</h1>
                              </div>
                          </div>
                          
                          
                          <table width="100%" class="table table-hover personal-task">
                                                        
                              <tr>
                                  <td width="15%">Amount</td>
                                  <td width="11%">By</td>
                                  <td width="17%">Date</td>
                                  <td width="10%">Status</td>
                                  <td width="17%">Link</td>
                                  <td width="30%">Action</td>
                              </tr>
                              <tbody>    
				<?php
						
					$perpage=30;
					if (!isset($_GET['p']) || $_GET['p']==0 )
						$screen = 0;
					else
					$screen=$_GET['p']-1;
					$start = $screen * $perpage;	
                	$db->query("select * from tbl_donate order by date desc limit ".$start.",".$perpage);
					if($db->rownum()>0){
                	while($res=$db->Fetcharray()){
                ?>
                              <tr <?php if( $res['amount']>=$db2->res['value']) echo 'style="background-color:rgba(127,205,163,0.42)"'; ?>>
                                  <td width="15%"><?php echo $res['amount'];?></td>
                                  <td width="11%">
                                  <?php
								  $db2->queryres("select * from tbl_user where user_id='".$res['user_id']."'");
								  echo $db2->res['username'];
								  
								  ?>
                                  </td>
                                  <td width="17%"><?php echo date('Y/m/d H:i:s',$res['date']); ?></td>
                                  <td width="10%"><?php
								  if($res['status']==0)
								   echo '<div class="label label-warning">Pending</div>';
								  elseif($res['status']==1)
								   echo '<div class="label label-success">Success</div>';
								  else
								   echo '<div class="label label-success">Active in Play </div>';
								   
								   
								   
								   ?></td>
                                  <td width="17%"><a href="<?php echo $res['link'];?>" target="_blank"> <?php echo $res['link'];?> </a></td>
                                  <td width="30%">
                                  <?php
								  if($res['status']==2){?>
                                  <a href="?a=deac&did=<?php echo $res['donate'];?>">
                                  Deactive
                                  </a>
                                     
                                     
									  <?php
								  }elseif($res['status']==1){
									  ?>
									 
                                    <a href="?a=ac&did=<?php echo $res['donate'];?>"> 
                                     Active
                                   </a>  
                                     
                                     
                                     
									  <?php
								  }
								  
								  
								  
								  
								  ?>
                                  
                                  
                                  </td>
                              </tr>
				<?php }
					}else{?>
					<div class="row center show-grid tbl">
						<div class="col-md-12 col-xs-4 col-sm-3 text-danger tex">No transaction founded</div>
					</div>
                <?php } ?>
                              </tbody>
                          </table>
                          
                          
                      <div class="row">                
                    <ul class="pagination">
                    <?php
                    
                    
                    
                    $db->query("select * from tbl_donate");
                
                $n=$db->rownum();
                $page=$screen+1;
                $last_page=ceil($n/$perpage)+1;
                $part='donate.php?p=';
                
                if($page != 1)
                    $paging.='<li><a href="'.$part.($page - 1).'">&lsaquo;</a></li>';
                
                if($page > 4)
                    $paging.='<li><a href="'.$part.($page-$page+1).'">&laquo;</a></li>';
                
                for($i=4;$i>0;$i--)
                    if($page-$i>0)
                        $paging.='<li><a href="'.$part.($page-$i).'">'.($page-$i).'</a></li>';
                        
                if ($page == 0)
                    $paging.='<li><a>&rsaquo;</a></li>';
                elseif($page == $last_page)
                    $paging.='<li><a>&lsaquo;</a></li>';
                else
                    $paging.='<li><a>'.$page.'</a></li>';
                        
                for($i=1 ; $i<5 ; $i++)
                    if($last_page-($page+$i)>0)
                        $paging.='<li><a href="'.$part.($page+$i).'">'.($page+$i).'</a></li>';
                            
                if ($page < $last_page - 5)
                    $paging.='<li><a href="'.$part.($last_page - 1).'">&raquo;</a></li>';
                
                if ($page != $last_page-1)
                    $paging.='<li><a href="'.$part.($page + 1).'">&rsaquo;</a></li>';
                    
                echo $paging;
                ?>
                    </ul>
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