
<?php
class SystemComponent{
	private $settings;
	function getSetting(){
			$settings['dbusername']='root';
			$settings['dbpassword']='1'; 
			$settings['dbname']='phpfaucet';
			$settings['dbhost']='localhost';
			return $settings;
	}
}