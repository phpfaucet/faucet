<?php require_once "../maincore.php";




if( $_SESSION['admin']['logged'] ){
	$aid=$_SESSION['admin']['aid'];
	$logged=true;
}


if( FILE!='login' && !isset($logged)   ){
	$_SESSION['error']['loginreq']=true;
	header('Location:login.php');
}

if( isset($_GET['a']) && $_GET['a']=='logout' ){
unset($_SESSION['admin']);
header('Location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <base>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" href="style/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/css/bootstrap-reset.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <link rel="stylesheet" type="text/css" href="style/css/style.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
</head>
<body <?php if(FILE=='login' ||FILE=='proof' ){ ?> class="login-body" <?php } ?>>

<section id="container">
<?php if(isset($logged) && !$_POST){ ?>
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder fa fa-list tooltips"></div>
                
            </div>
            
            
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="username">Admin</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="?a=logout"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>

      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu">
                  <li <?php if(FILE=='user_dashboard') echo 'class="active"';?>>
                      <a class="" href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
                  </li>
                  
                  
                  <li class="<?php if(FILE=='withdrawal' ) echo 'active';?>">
						<li><a href="withdrawal.php" class=""><i class="fa fa-dashboard"></i><span>Withdrawal</span></a></li>               
                  </li>

                  <li class="<?php if(FILE=='donate') echo 'active';?>">
						<li><a href="donate.php" class=""><i class="fa fa-dashboard"></i><span>Donate</span></a></li>               
                  </li>
            
            
                  
                  
                  <li class="<?php if(FILE=='prize' ) echo 'active';?>">
						<li><a href="prize.php" class=""><i class="fa fa-money"></i> <span>Prize</span></a></li>
                  </li>
                  
                  
                  <li class="<?php if(FILE=='setting' ) echo 'active';?>">
						<li><a href="setting.php" class=""><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
                  </li>
                
                  <li class="<?php if(FILE=='setting' ) echo 'active';?>">
						<li><a href="admin.php" class=""><i class="fa fa-wrench"></i> <span>Administrators</span></a></li>
                  </li>
                
                
                
				  
				  </ul>
          </div>
      </aside>
      
<?php } ?>