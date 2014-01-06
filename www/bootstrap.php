<?php

use Example\Aspect\ContentNegotiation;
use Example\Aspect\TransactionalHandler;
use Example\Controller\HelloController;
use Example\Db\DummyConnection;
use Example\Request\Request;
use Koala\AOP\DI\Extension\AOPExtension;
use Koala\AOP\Proxy\SimpleProxyReplacerFactory;
use Koala\DI\Container;
use Koala\DI\Definition\Configuration\ArrayConfigurationDefinition;

require_once __DIR__ . '/../vendor/autoload.php';

new \Example\Annotation\Transactional([]);

$configurationDefinition = new ArrayConfigurationDefinition([
	'params' => [
		'helloMessage' => 'Hello! I am message!',
		'name' => 'John Doe',
	],
	'services' => [
		'helloController' => [
			'serviceId' => 'helloController',
			'class' => HelloController::class,
			'arguments' => [
				['param' => 'helloMessage'],
				['param' => 'name'],
			],
		],
		'contentNegotiation' => [
			'serviceId' => 'contentNegotiation',
			'class' => ContentNegotiation::class,
			'arguments' => [
				['value' => new Request(['Accept' => 'application/json'])]
			]
		],
		'transactionalHandler' => [
			'serviceId' => 'transactionalHandler',
			'class' => TransactionalHandler::class,
			'arguments' => [
				['service' => 'connection'],
			]
		],
		'connection' => [
			'serviceId' => 'connection',
			'class' => DummyConnection::class,
		]
	],
]);

$proxyReplacerFactory = new SimpleProxyReplacerFactory(
	'__aop__', // proxy member prefix 
	'__AOP__', // proxy namespace prefix
	'MethodMatcher', // matcher namespace
	'generatedInterceptorLoader', // interceptor loader id 
	'container', // container id 
	__DIR__ . '/../tmp/cache/' // cache dir
);

$diContainer = new Container($configurationDefinition);
$diContainer->registerBeforeCompileExtension(
	new AOPExtension($proxyReplacerFactory->create())
);
$diContainer->compile();
