<?php

include_once __DIR__ . '/bootstrap.php';

/** @var \Example\Controller\HelloController $helloController */
/** @var \Example\Response\RenderableResponse $response */
$helloController = $diContainer->getService('helloController');
$response = $helloController->sayHiAction();
echo $response->render();
