<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bing_translator {
	
	//http://www.microsoft.com/en-us/translator/getstarted.aspx
	
	private $CI;
	private $_client_id = '';
	private $_client_secret = '';
	private $_grant_type = 'client_credentials';
	private $_scope_url = 'http://api.microsofttranslator.com';
	private $_langdefault='';

	public function __construct() {
		$this->CI=& get_instance();
		$this->CI->load->config("translator");		
		$this->_client_id = $this->CI->config->item('bingclientid');
		$this->_client_secret = $this->CI->config->item('bingsecret');
		$this->_langdefault=$this->CI->config->item('bingdefault');
	}

	
	
	public function getResponse($url) {
	$curlHandler = curl_init();
	curl_setopt($curlHandler, CURLOPT_URL, $url);
	curl_setopt($curlHandler, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$this->getToken(), 'Content-Type: text/xml'));
	curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, false);
	 	
	$response = curl_exec($curlHandler);
	 	
	curl_close($curlHandler);
	 	
	return $response;
	}
	
	public function getToken($clientID = '', $clientSecret = '') {
	 	
	$clientID = (trim($clientID) === '') ? $this->_client_id : $clientID;
	$clientSecret = (trim($clientSecret) === '') ? $this->_client_secret : $clientSecret;
	 	
	$curlHandler = curl_init();
	 	
	$request = 'grant_type='.urlencode($this->_grant_type).'&scope='.urlencode($this->_scope_url).'&client_id='.urlencode($clientID).'&client_secret='.urlencode($clientSecret);
	 	
	curl_setopt($curlHandler, CURLOPT_URL, 'https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/');
	curl_setopt($curlHandler, CURLOPT_POST, true);
	curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $request);
	curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curlHandler, CURLOPT_SSL_VERIFYPEER, false);
	 	
	$response = curl_exec($curlHandler);
	 	
	curl_close($curlHandler);
	 	
	$responseObject = json_decode($response);
	 	
	return $responseObject->access_token;
	}
	
	public function getTranslation($fromLanguage, $toLanguage, $text) {
	$response = $this->getResponse($this->getURL($fromLanguage, $toLanguage, $text));	 
	return strip_tags($response);
	}
 
	public function getURL($fromLanguage, $toLanguage, $text) {
		return 'http://api.microsofttranslator.com/v2/Http.svc/Translate?text='.urlencode($text).'&to='.$toLanguage.'&from='.$fromLanguage;
	}
	
	public function getSupportLang(){		
		return 'http://api.microsofttranslator.com/v2/Http.svc/GetLanguagesForTranslate';
	}
	
	public function getTranslateText($from,$to,$text){
		return $this->getTranslation($from,$to,$text);
	}
	
	public function getIcon(){
		$item="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAcFBQYFBAcGBQYIBwcIChELCgkJChUPEAwRGBUaGRgVGBcbHichGx0lHRcYIi4iJSgpKywrGiAvMy8qMicqKyr/2wBDAQcICAoJChQLCxQqHBgcKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKir/wAARCAAgAE4DASIAAhEBAxEB/8QAGwAAAgMBAQEAAAAAAAAAAAAABgcAAgUDBAj/xAA0EAABAwIEBAUCAwkAAAAAAAABAgMEBREABhIhBxMxQRQVIlFhFzIWkaE2QnFzdYGSsbP/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AP+JHEWs5NzjFi09Md6I5CQ6tl5F7qK1gkKBBGyRhiUSeqq5fp9RWgNqlxW3ygG4SVpCrfrhH8dv26h/01H/VzBfW3cxU3hjlqsZWkvJciQI4kR0NhxLjZaT6ikg9COvsSe2AZ+JhJUfjxMas3XqS0+BsXYqihX+Krg/mMOSmz2qpSolQjhaWZbKH2wsWUEqSFC9u9jgLRZ0WcHTDfbeDLqmXdCr6FpNlJPsR7YtKlx4MZcia+1HYR97rqwhKd7bk7DfC6yrVqsxKzLEoVHE9xNdluOuPSAy2gFQskGxKlbHa222++NKbnKHUMhVebVKKHHaa4GZ1KkrBAWFJ21WII3BBt2wBwCCLjcHEwL1bNr9Pzc3lyn0dU2Q7AEplSXghN9ZTpVcelICSdW/YW3x0oeaJEyrTqTXICabPhNJfIS9zG3Gj++lVh0OxvgCTEwGRc51iqR11OkZaXIoyVK0vKkhDz6AbFaG7fBsCQTjbynmAZoyxErAjeGEnXZrXr06VqT1sOum/TvgFRxgpa6pxEho5zUZhFObL0l9WltpPNd3J7n2A3PbFajxh8pocSi5Sa5ohxkRxUJKLatCQnUlvt0v6vywzc4ZHpec4aUTwpmS0CGZTf3I+CO4+P9YEcr8E6fTn/E5jkCpLSr0MIBS0B2Ku6j8dP44BZUPKWZM/VNyW2ha0uru/PkelF++/c/A/TH0lRqf5TQoFO5nN8HGbY5lratCQm9u17Y9TLLcdlDTDaWm0CyUISAEj2AHTF8Atss5pg5Zl5kZryJENp2tynWJBjrUh26hdIKQdxYH5BFseCfCmzsg5yrS4b7PnL6Fxo60HmFtBSlKinqCdzbDYxMAIcl3618/lL5P4e0czSdOrxF7X6Xt2xzqNPem8Rqi02lSEyMt8hLpB0hZdWOvvuDgzxMAvsrZwi0fK8ShzoctuuQWvD+XJjLKnVJ2BSoDTY7G97dcaHCi/0xpWrrd+9v57mLyo2fZTDsRMuhRkOXR4xpLpdQk9wg+nVb5tjeoVHj5foMSlQyosxW9AUrqo9ST8kkn++A//2Q==";
		return $item;
	}
	
}