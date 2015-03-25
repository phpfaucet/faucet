
<?php
class SystemComponent{
	private $settings;
	function getSetting(){
			$settings['dbusername']='forexeng_faucet';
			$settings['dbpassword']='147258369'; 
			$settings['dbname']='forexeng_faucet';
			$settings['dbhost']='localhost';
			return $settings;
	}
}