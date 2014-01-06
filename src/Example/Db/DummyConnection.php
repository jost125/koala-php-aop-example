<?php

namespace Example\Db;

class DummyConnection implements IConnection {

	public function begin() {
		var_dump('begin');
	}

	public function commit() {
		var_dump('commit');
	}

	public function rollback() {
		var_dump('rollback');
	}
}
