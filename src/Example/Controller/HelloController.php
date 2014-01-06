<?php

namespace Example\Controller;

use Example\Response\RenderableResponse;
use Example\Response\Response;
use Example\Annotation\Transactional;

class HelloController {

	private $helloMessage;
	private $name;

	public function __construct($helloMessage, $name) {
		$this->helloMessage = $helloMessage;
		$this->name = $name;
	}

	/**
	 * @return RenderableResponse
	 */
	public function sayHiAction() {
		$this->doSomeBussinessLogic();
		return new Response([
			'helloMessage' => $this->helloMessage,
			'name' => $this->name,
		]);
	}

	/**
	 * @Transactional
	 */
	protected function doSomeBussinessLogic() {
		var_dump('do some bussiness logic');
	}

}
