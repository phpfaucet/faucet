<?phprequire_once "header.php";
require_once "maincore.php";
require_once "includes/dbconnector.class.php";
$db=new DbConnector;
if( isset($_POST['register'] ) ){
	$ausername=$_POST['ausername'];
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$address=$_POST['address'];
	$prepare=$db->mysqli->prepare("select user_id from tbl_user where username=?");
	$prepare->bind_param('s',$username);
	$prepare->execute();
	$prepare->store_result();
	$ucount=$prepare->num_rows;
	$prepare->close();
	if(!$ucount){
		if(isset($_COOKIE['r'])){
			$prepare=$db->mysqli->prepare("insert into tbl_user (ausername,username,password,address,parent_id) values (?,?,?,?,?) ");
			$prepare->bind_param('ssssi',$ausername,$username,$password,$address,$_COOKIE['r']);
			$prepare->execute();
			$uid=$prepare->insert_id;
			$prepare->close();
			$_SESSION['user']['logged']=true;
			$_SESSION['user']['uid']=$uid;
			header('Location:index.php');
		}else{
			$prepare=$db->mysqli->prepare("insert into tbl_user (ausername,username,password,address) values (?,?,?,?) ");
			$prepare->bind_param('ssss',$ausername,$username,$password,$address);
			$prepare->execute();
			$uid=$prepare->insert_id;
			$prepare->close();
			$_SESSION['user']['logged']=true;
			$_SESSION['user']['uid']=$uid;
			header('Location:index.php');
		}
	}else{
		$_SESSION['error']['repeate']=true;
		header('Location:register.php');
	}
}else{
	if( isset( $_SESSION['error']['repeate'])) {
		$smarty->assign('rep',true);
		unset( $_SESSION['error'] ) ;
	}
	$smarty->display('template/register.tpl');
}
?>