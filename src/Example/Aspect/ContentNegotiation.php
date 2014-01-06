<?php

namespace Example\Aspect;

use Example\Request\Request;
use Example\Response\JsonResponse;
use Example\Response\Response;
use Example\Response\XmlResponse;
use Koala\AOP\Aspect;
use Koala\AOP\Around;
use Koala\AOP\Joinpoint;

/**
 * @Aspect
 */
class ContentNegotiation {

	private $request;

	public function __construct(Request $request) {
		$this->request = $request;
	}

	/**
	 * @Around("execution(public \Example\Controller*::*Action(..))")
	 */
	public function convert(Joinpoint $joinpoint) {
		$result = $joinpoint->proceed();
		if ($result instanceof Response) {
			$accept = $this->request->getHeader('Accept');
			switch ($accept) {
				case 'text/xml':
					$result = new XmlResponse($result->getVariables());
					break;
				case 'application/json':
					$result = new JsonResponse($result->getVariables());
					break;
			}
		}
		return $result;
	}

}
