<?php

use Slim\Http\Request;
use Slim\Http\Response;

use ITR\API;

$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/api/{version}/{module}/{resource}', function (Request $request, Response $response, array $args) {
    extract($args);
    /** @var string $version */
    /** @var string $module */
    /** @var string $resource */
    /** @var ITR\API $api */
    $api = new API();
    $requestData = $request->getParsedBody() ?? [];
    $data = $api->UseVersion($version)->UseModule($module)->UseResource($resource)->Serve($requestData);
    return $response->withJson($data, $api->GetStatusCode());
});


$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});