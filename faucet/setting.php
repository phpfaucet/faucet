<?php
class SystemComponent{
	private $settings;
	function getSetting(){
			$settings['dbusername']='root';
			$settings['dbpassword']=''; 
			$settings['dbname']='asmoney';
			$settings['dbhost']='localhost';
			return $settings;
	}
}
?>