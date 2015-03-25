<?php
if(isset($_POST['install']) ){
	$host=$_POST['host'];
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$dbname=$_POST['dbname'];


$config = <<<END
<?php
class SystemComponent{
	private \$settings;
	function getSetting(){
			\$settings['dbusername']='$user';
			\$settings['dbpassword']='$pass'; 
			\$settings['dbname']='$dbname';
			\$settings['dbhost']='$host';
			return \$settings;
	}
}
END;
		$fp = fopen('includes/system.class.php',"w");
		fwrite($fp,$config);
		fclose($fp);


include_once "includes/dbconnector.class.php";
$db=new DbConnector;
$filename = 'phpfaucet.sql';
$templine = '';
$lines = file($filename);
foreach ($lines as $line){
	if (substr($line, 0, 2) == '--' || $line == '')
		continue;
	
	$templine .= $line;
	if (substr(trim($line), -1, 1) == ';'){
		$db->query($templine);
		$templine = '';
	}
}
echo "Tables imported successfully";

echo "<br>Do not resubmit this file.<br>DELETE IMMEDIATELY.";

}else{
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<center>
<form action="" method="post">

<table width="50%" border="1" align="center" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td width="50%">DatabaseHost:</td>
      <td width="50%"><input type="text" name="host" value="localhost"></td>
    </tr>
    <tr>
      <td>DatabaseUseranme:</td>
      <td><input type="text" name="user" value=""></td>
    </tr>
    <tr>
      <td>DatabasePassword:</td>
      <td><input type="text" name="pass" value=""></td>
    </tr>
    <tr>
      <td>DatabaseName:</td>
      <td><input type="text" name="dbname" value=""></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="install" value="install"></td>
      </tr>
  </tbody>
</table>




  <br>
</form>

</center>








</body>
</html>
<?php } ?>