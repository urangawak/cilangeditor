<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('fileInfo')){
	function fileInfo($path,$output){
		$CI=& get_instance();
		$CI->load->helper('file');
		$item=get_file_info($path,array($output));
		foreach($item as $ritem){
			return $ritem;
		}
	}
}

?>