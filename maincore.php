<?php
session_start();
ob_start();

require_once "includes/dbconnector.class.php";
require_once "includes/user.class.php";
require_once "includes/function.php";
require "includes/smarty/Smarty.class.php";

$db=new DbConnector;
$db2=new DbConnector;
$smarty=new Smarty;


$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;



$db->queryres("select * from tbl_config where header='privkey'");
$privkey=$db->res['value'];

$db->queryres("select * from tbl_config where header='verkey'");
$verkey=$db->res['value'];

$db->queryres("select * from tbl_config where header='hashkey'");
$hashkey=$db->res['value'];



$ip=get_ip();
$ip=sprintf('%u', ip2long($ip));


define('NOW',time());
define(FILE,basename(basename($_SERVER['SCRIPT_FILENAME']),'.php'));
if(isset($_SESSION['user']['logged'])){
	$uid=$_SESSION['user']['uid'];
	$user=new User($uid);
	$userdet=$user->detail();


}


?>