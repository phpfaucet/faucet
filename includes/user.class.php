<?php
class User{
	private $uid;
	public function __construct($uid=NULL){$this->uid=$uid;}

	
	public function detail(){
		global $db;
		$db->queryres("Select * from tbl_user where user_id='".$this->uid."' ");
		return $db->res;		
	}
	
	
	
	
	




}
?>