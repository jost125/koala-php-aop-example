<?php

namespace Example\Aspect;

use Example\Db\IConnection;
use Exception;
use Koala\AOP\Aspect;
use Koala\AOP\Around;
use Koala\AOP\Joinpoint;

/**
 * @Aspect
 */
class TransactionalHandler {

	private $connection;

	public function __construct(IConnection $connection) {
		$this->connection = $connection;
	}

	/**
	 * @Around("methodAnnotated(\Example\Annotation\Transactional)")
	 */
	public function transaction(Joinpoint $joinpoint) {
		$this->connection->begin();
		try {
			$returned = $joinpoint->proceed();
			$this->connection->commit();
			return $returned;
		} catch (Exception $ex) {
			$this->connection->rollback();
			throw $ex;
		}
	}

}
