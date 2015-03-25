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
		if ($r == 'Invalid user')
			return array('result' => APIerror::InvalidUser);
		if ($r == 'Invalid api data')
			return array('result' => APIerror::InvalidAPIData);
		if ($r == 'Invalid IP')
			return array('result' => APIerror::InvalidIP);
		if ($r == 'Invalid IP setup')
			return array('result' => APIerror::InvalidIPSetup);
		if ($r == 'Invalid')
			return array('result' => APIerror::InvalidCurrency);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function Transfer($touser, $amount, $currency, $memo)
	{
		$r = $this->client->transfer($this->username, $this->apiname, $this->password, $amount, $currency, $touser, $memo);
		if ($r == 'Invalid user')
			return array('result' => APIerror::InvalidUser);
		if ($r == 'Invalid api data')
			return array('result' => APIerror::InvalidAPIData);
		if ($r == 'Invalid IP')
			return array('result' => APIerror::InvalidIP);
		if ($r == 'Invalid IP setup')
			return array('result' => APIerror::InvalidIPSetup);
		if ($r == 'Invalid')
			return array('result' => APIerror::InvalidCurrency);
		if ($r == 'The receiver is not valid')
			return array('result' => APIerror::InvalidReceiver);
		if ($r == 'Not enough money')
			return array('result' => APIerror::NotEnoughMoney);
		if ($r == 'limit')
			return array('result' => APIerror::APILimitReached);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function TransferBTC($btcaddress, $amount, $currency, $memo)
	{
		$r = $this->client->transferbtc($this->username, $this->apiname, $this->password, $amount, $currency, $btcaddress, $memo);
		if ($r == 'Invalid user')
			return array('result' => APIerror::InvalidUser);
		if ($r == 'Invalid api data')
			return array('result' => APIerror::InvalidAPIData);
		if ($r == 'Invalid IP')
			return array('result' => APIerror::InvalidIP);
		if ($r == 'Invalid IP setup')
			return array('result' => APIerror::InvalidIPSetup);
		if ($r == 'Invalid')
			return array('result' => APIerror::InvalidCurrency);
		if ($r == 'The receiver is not valid')
			return array('result' => APIerror::InvalidReceiver);
		if ($r == 'Not enough money')
			return array('result' => APIerror::NotEnoughMoney);
		if ($r == 'limit')
			return array('result' => APIerror::APILimitReached);
		return array('result' => APIerror::OK, 'value' => $r);
	}

	function TransferLTC($ltcaddress, $amount, $currency, $memo)
	{
		$r = $this->client->transferltc($this->username, $this->apiname, $this->password, $amount, $currency, $ltcaddress, $memo);
		if ($r == 'Invalid user')
			return array('result' => APIerror::InvalidUser);
		if ($r == 'Invalid api data')
			return array('result' => APIerror::InvalidAPIData);
		if ($r == 'Invalid IP')
			return array('result' => APIerror::InvalidIP);
		if ($r == 'Invalid IP setup')
			return array('result' => APIerror::InvalidIPSetup);
		if ($r == 'Invalid')
			return array('result' => APIerror::InvalidCurrency);
		if ($r == 'The receiver is not valid')
			return array('result' => APIerror::InvalidReceiver);
		if ($r == 'Not enough money')
			return array('result' => APIerror::NotEnoughMoney);
		if ($r == 'limit')
			return array('result' => APIerror::APILimitReached);
		return array('result' => APIerror::OK, 'value' => $r);
	}

	function GetTransaction($TransActionID)
	{
		$r = $this->client->gettransaction($this->username, $this->apiname, $this->password, $TransActionID);
		if ($r == 'Invalid user')
			return array('result' => APIerror::InvalidUser);
		if ($r == 'Invalid api data')
			return array('result' => APIerror::InvalidAPIData);
		if ($r == 'Invalid IP')
			return array('result' => APIerror::InvalidIP);
		if ($r == 'Invalid IP setup')
			return array('result' => APIerror::InvalidIPSetup);
		if ($r == 'Invalid')
			return array('result' => APIerror::Invalid);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function GetHistory($skip)
	{
		$r = $this->client->history($this->username, $this->apiname, $this->password, $skip);
		if ($r == 'Invalid user')
			return array('result' => APIerror::InvalidUser);
		if ($r == 'Invalid api data')
			return array('result' => APIerror::InvalidAPIData);
		if ($r == 'Invalid IP')
			return array('result' => APIerror::InvalidIP);
		if ($r == 'Invalid IP setup')
			return array('result' => APIerror::InvalidIPSetup);
		if ($r == 'Invalid')
			return array('result' => APIerror::Invalid);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	function GetNewTransActions()
	{
	
		$r = $this->client->getnewtransactions($this->username, $this->apiname, $this->password);
		if ($r == 'Invalid user')
			return array('result' => APIerror::InvalidUser);
		if ($r == 'Invalid api data')
			return array('result' => APIerror::InvalidAPIData);
		if ($r == 'Invalid IP')
			return array('result' => APIerror::InvalidIP);
		if ($r == 'Invalid IP setup')
			return array('result' => APIerror::InvalidIPSetup);
		if ($r == 'Updated')
			return array('result' => APIerror::OK, 'value' => []);
		return array('result' => APIerror::OK, 'value' => $r);
	}
	
	
		
}
?>