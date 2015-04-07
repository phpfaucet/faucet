<?php require_once "header.php";
require_once "../includes/dbconnector.class.php"; 
$db=new DbConnector;
?>


<section id="main-content">
	<section class="wrapper">

		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
                  <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Withdrawals</h1>
                              </div>
                          </div>
                          <a href="../cron_withdrawal.php" class="alert"> Pay all Withdrawal requests </a>
                          
                          <table width="100%" class="table table-hover personal-task">
                                                        
                              <tr>
                                  <td width="31%">Amount</td>
                                  <td width="25%">By</td>
                                  <td width="34%">Date</td>
                                  <td width="34%">Status</td>
                                  <td width="10%">Type</td>
                              </tr>
                              <tbody>    
				<?php
						
					$perpage=20;
					if (!isset($_GET['p']) || $_GET['p']==0 )
						$screen = 0;
					else
					$screen=$_GET['p']-1;
					$start = $screen * $perpage;	
                	$db->query("select * from tbl_withdrawal order by date desc limit ".$start.",".$perpage);
					if($db->rownum()>0){
                	while($res=$db->Fetcharray()){
                ?>
                              <tr>
                                  <td width="31%"><?php echo $res['amount'];?></td>
                                  <td width="25%">
                                  <?php
								  $db2->queryres("select * from tbl_user where user_id='".$res['user_id']."'");
								  echo $db2->res['username'];
								  
								  ?>
                                  </td>
                                  <td width="34%"><?php echo ($res['date'])? date('Y/m/d H:i:s',$res['date']) : ''; ?></td>
                                  <td><?php
								  if($res['status']==0)
								   echo '<div class="label label-warning">Pending</div>';
								  elseif($res['status']==1)
								   echo '<div class="label label-success">Success</div>';
								  else
								   echo '<div class="label label-success">Active in Play </div>';
								   
								   
								   
								   ?></td>
                                   
                                   <td width="34%"><?php 
								   if($res['type']==0)
								   		echo 'Asmoney';
									else
										echo 'Currency';
								   
								   
								    ?></td>
                                   
                                   
                                   
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
                    
                    
                    
                    $db->query("select * from tbl_withdrawal");
                
                $n=$db->rownum();
                $page=$screen+1;
                $last_page=ceil($n/$perpage)+1;
                $part='withdrawal.php?p=';
                
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

<?php require_once "footer.php";?>