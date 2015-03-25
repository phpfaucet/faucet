<?php
require_once "system.class.php";
class DbConnector extends SystemComponent{
	private $link;
	private $result;	
	var $res;
	public $mysqli;
	function __construct(){
		$this->settings=parent::getSetting();
		$host=$this->settings['dbhost'];
		$user=$this->settings['dbusername'];
		$pass=$this->settings['dbpassword'];
		$db=$this->settings['dbname'];
		$this->mysqli=new MySQLi($host,$user,$pass,$db);
		if($this->mysqli->connect_errno)
			die('Unable to connect to database [' . $this->mysqli->connect_error . ']');
		$this->mysqli->set_charset('utf8');
	}
	
	function query($query){
		$this->result=$this->mysqli->query($query);
		return ($this->result) or die( 'There was an error running the query [' . $this->mysqli->error . ']' );
	}
	
	function queryres($query){
		$this->result=$this->mysqli->query($query);
		if($this->result->num_rows){
		$this->res=$this->result->fetch_assoc();
		return ($this->result) or die( 'There was an error running the query [' . $this->mysqli->error . ']' );
		}else
			return false;
		
	}
	
	function queryid($query){
		$this->query($query);
		return $this->mysqli->insert_id;
	}
	
	function qrownum($query){
		$this->result=$this->mysqli->query($query);
		return $this->result->num_rows;
	}
	
	function rownum(){return $this->result->num_rows;}
	function fetchArray(){return $this->result->fetch_assoc();}
	function affected(){return mysql_affected_rows($this->link);}
	
	
	
}
?>