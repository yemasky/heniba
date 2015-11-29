<?php

/**
 * WebServiceClient 2015年11月28日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015
 */

class WebServiceClient {
	private $method;
	private $request_url;
	private $arrayHeader = array ();
	private $request_data = "";

	public function put(){
		$this->method = "put";
		return $this;
	}

	public function get(){
		$this->method = "get";
		return $this;
	}

	public function post(){
		$this->method = "post";
		return $this;
	}

	public function getMethod(){
		return $this->method;
	}

	public function header($arrayHeader){
		$this->arrayHeader = $arrayHeader;
		return $this;
	}

	public function url($url){
		$this->request_url = $url;
		return $this;
	}

	public function data($requestData){
		$this->request_data = $requestData;
		return $this;
	}

	public function execute_file_get_contents(){
		$header = $this->method . ": HTTP/1.1\r\n";
		if(!empty($this->arrayHeader)) {
			foreach($this->arrayHeader as $k => $v) {
				$header .= $k . ": " . $v . "\r\n";
			}
		}
		$opts = array (
				'http' => array (
						'method' => "GET",
						'header' => $header 
				) 
		);
		if($this->request_data != "") {
			$opts[0]["http"]['content'] = $this->request_data;
		}
		$context = stream_context_create($opts);
		$return['result'] = file_get_contents($this->request_url,false,$context);
		$return['header'] = $http_response_header;
		return $return;
	}
}