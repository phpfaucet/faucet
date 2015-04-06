<?php
include 'jsonRPCClient.php';

abstract class APIerror
{
	const OK = 0;
	const InvalidUser = 1;
	const InvalidAPIData = 2;
	const InvalidIP = 3;
	const InvalidIPSetup = 4;
	const InvalidCurrency = 5;
	const InvalidReceiver = 6;
	const NotEnoughMoney = 7;
	const APILimitReached = 8;
	const Invalid = 9;
}

class AsmoneyAPI 
{
	var $username;
	var $apiname;
	var $password;
	var $client;
	
	function __construct($pusername, $papiname, $ppassword)
	{
		$this->username = $pusername;
		$this->apiname = $papiname;
		$this->password = $ppassword;
		$this->client = new jsonRPCClient('https://www.asmoney.com/api.ashx');
	}
	
	function GetBalance($currency)
	{
		$r = $this->client->getbalance($this->username, $this->apiname, $this->password, $currency);
		if (strcmp($r, 'Invalid user') == 0)
			return array('result' => APIerror::InvalidUser);
		if (strcmp($r, 'Invalid api data') == 0)
			return array('result' => APIerror::InvalidAPIData);
		if (strcmp($r, 'Invalid IP') == 0)
			return array('result' => APIerror::InvalidIP);
		if (strcmp($r, 'Invalid IP setup') == 0)
			return array('result' => APIerror::InvalidIPSetup);
		if (strcmp($r, 'Invalid') == 0)
			return array('result' => APIerror::InvalidCurrency);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function Transfer($touser, $amount, $currency, $memo)
	{
		$r = $this->client->transfer($this->username, $this->apiname, $this->password, $amount, $currency, $touser, $memo);
		if (strcmp($r, 'Invalid user') == 0)
			return array('result' => APIerror::InvalidUser);
		if (strcmp($r, 'Invalid api data') == 0)
			return array('result' => APIerror::InvalidAPIData);
		if (strcmp($r, 'Invalid IP') == 0)
			return array('result' => APIerror::InvalidIP);
		if (strcmp($r, 'Invalid IP setup') == 0)
			return array('result' => APIerror::InvalidIPSetup);
		if (strcmp($r, 'Invalid') == 0)
			return array('result' => APIerror::InvalidCurrency);
		if (strcmp($r, 'The receiver is not valid') == 0)
			return array('result' => APIerror::InvalidReceiver);
		if (strcmp($r, 'Not enough money') == 0)
			return array('result' => APIerror::NotEnoughMoney);
		if (strcmp($r, 'limit') == 0)
			return array('result' => APIerror::APILimitReached);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function TransferBTC($btcaddress, $amount, $currency, $memo)
	{
		$r = $this->client->transferbtc($this->username, $this->apiname, $this->password, $amount, $currency, $btcaddress, $memo);
		if (strcmp($r, 'Invalid user') == 0)
			return array('result' => APIerror::InvalidUser);
		if (strcmp($r, 'Invalid api data') == 0)
			return array('result' => APIerror::InvalidAPIData);
		if (strcmp($r, 'Invalid IP') == 0)
			return array('result' => APIerror::InvalidIP);
		if (strcmp($r, 'Invalid IP setup') == 0)
			return array('result' => APIerror::InvalidIPSetup);
		if (strcmp($r, 'Invalid') == 0)
			return array('result' => APIerror::InvalidCurrency);
		if (strcmp($r, 'The receiver is not valid') == 0)
			return array('result' => APIerror::InvalidReceiver);
		if (strcmp($r, 'Not enough money') == 0)
			return array('result' => APIerror::NotEnoughMoney);
		if (strcmp($r, 'limit') == 0)
			return array('result' => APIerror::APILimitReached);
		return array('result' => APIerror::OK, 'value' => $r);
	}

	function TransferLTC($ltcaddress, $amount, $currency, $memo)
	{
		$r = $this->client->transferltc($this->username, $this->apiname, $this->password, $amount, $currency, $ltcaddress, $memo);
		if (strcmp($r, 'Invalid user') == 0)
			return array('result' => APIerror::InvalidUser);
		if (strcmp($r, 'Invalid api data') == 0)
			return array('result' => APIerror::InvalidAPIData);
		if (strcmp($r, 'Invalid IP') == 0)
			return array('result' => APIerror::InvalidIP);
		if (strcmp($r, 'Invalid IP setup') == 0)
			return array('result' => APIerror::InvalidIPSetup);
		if (strcmp($r, 'Invalid') == 0)
			return array('result' => APIerror::InvalidCurrency);
		if (strcmp($r, 'The receiver is not valid') == 0)
			return array('result' => APIerror::InvalidReceiver);
		if (strcmp($r, 'Not enough money') == 0)
			return array('result' => APIerror::NotEnoughMoney);
		if (strcmp($r, 'limit') == 0)
			return array('result' => APIerror::APILimitReached);
		return array('result' => APIerror::OK, 'value' => $r);
	}

	function GetTransaction($TransActionID)
	{
		$r = $this->client->gettransaction($this->username, $this->apiname, $this->password, $TransActionID);
		if (strcmp($r, 'Invalid user') == 0)
			return array('result' => APIerror::InvalidUser);
		if (strcmp($r, 'Invalid api data') == 0)
			return array('result' => APIerror::InvalidAPIData);
		if (strcmp($r, 'Invalid IP') == 0)
			return array('result' => APIerror::InvalidIP);
		if (strcmp($r, 'Invalid IP setup') == 0)
			return array('result' => APIerror::InvalidIPSetup);
		if (strcmp($r, 'Invalid') == 0)
			return array('result' => APIerror::Invalid);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function GetHistory($skip)
	{
		$r = $this->client->history($this->username, $this->apiname, $this->password, $skip);
		if (strcmp($r, 'Invalid user') == 0)
			return array('result' => APIerror::InvalidUser);
		if (strcmp($r, 'Invalid api data') == 0)
			return array('result' => APIerror::InvalidAPIData);
		if (strcmp($r, 'Invalid IP') == 0)
			return array('result' => APIerror::InvalidIP);
		if (strcmp($r, 'Invalid IP setup') == 0)
			return array('result' => APIerror::InvalidIPSetup);
		if (strcmp($r, 'Invalid') == 0)
			return array('result' => APIerror::Invalid);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function GetNewTransActions()
	{
	
		$r = $this->client->getnewtransactions($this->username, $this->apiname, $this->password);
		if (strcmp($r, 'Invalid user') == 0)
			return array('result' => APIerror::InvalidUser);
		if (strcmp($r, 'Invalid api data') == 0)
			return array('result' => APIerror::InvalidAPIData);
		if (strcmp($r, 'Invalid IP') == 0)
			return array('result' => APIerror::InvalidIP);
		if (strcmp($r, 'Invalid IP setup') == 0)
			return array('result' => APIerror::InvalidIPSetup);
		if (strcmp($r, 'Updated') == 0)
			return array('result' => APIerror::OK, 'value' => array());
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	
		
}
?>