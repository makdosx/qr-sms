<?php
/** @brief Php class that helps send a batch of sms using CURL, using our SMS-MT service.
	@author Mike Nakos - mnakos(at)terracom.gr
	@date 2016-Aug-08
	@version 2.0
*/	

class SMSHelper
{
	//-------------------------------------------------------------------------------------------------------
	private $siteURL = "https://sms.liveall.eu/apiext/Sendout/SendJSMS";
	//-------------------------------------------------------------------------------------------------------
	public function sendSMSMulti($smsData, $api_token, $sender_name, $pricecat = -1, $sendon = NULL)
	{
		$payloadObj = array(
			'apitoken'		=>	$api_token,
			'senderid'		=>	$sender_name,
			'messages'		=>	$smsData
		);
		
		if($sendon !== NULL)
			$payloadObj['sendon'] = $sendon;
		
		if($pricecat !== -1)
			$payloadObj['pricecat'] = $pricecat;

		return $this->curl_submit_json_data($payloadObj);
	}
	//-------------------------------------------------------------------------------------------------------
	private function curl_submit_json_data($jdata)
	{
		$data_string = json_encode($jdata);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->siteURL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result  = curl_exec($ch);
		
		if($result === FALSE) {
			$err_msg = curl_error($ch);
			curl_close($ch);
			
			return $err_msg;
		}
		
		curl_close($ch);	
		
		return $result;
	}
	//-------------------------------------------------------------------------------------------------------
}
?>