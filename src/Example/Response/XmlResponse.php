<?php

namespace Example\Response;

class XmlResponse implements RenderableResponse {

	private $variables;

	public function __construct(array $variables) {
		$this->variables = $variables;
	}

	public function render() {
		echo "There should be XML formating of variables";
		var_dump($this->variables);
	}

}
