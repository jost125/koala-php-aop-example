<?php

namespace Example\Response;

class Response implements RenderableResponse {

	private $variables;

	public function __construct(array $variables) {
		$this->variables = $variables;
	}

	public function getVariables() {
		return $this->variables;
	}

	public function render() {
		var_dump($this->variables);
	}
}
