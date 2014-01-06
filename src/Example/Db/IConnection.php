<?php

namespace Example\Db;

interface IConnection {

	public function begin();
	public function commit();
	public function rollback();

}
