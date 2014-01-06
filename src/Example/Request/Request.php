<?php

namespace Example\Request;

class Request {

	private $headers;

	public function __construct(array $headers) {
		$this->headers = $headers;
	}

	public function getHeader($header) {
		return isset($this->headers[$header]) ? $this->headers[$header] : null;
	}

}
