<?php

use Slim\Http\Request;
use Slim\Http\Response;
use ITR\HTTP\HTTPMethod;
use ITR\API;

$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


function apiController(Request $request, Response $response, array $args)
{
    extract($args);
    /** @var string $version */
    /** @var string $module */
    /** @var string $resource */
    /** @var ITR\API $api */
    $api = new API();
    $requestData = $request->getParsedBody() ?? [];
    $api = $api->UseVersion($version)->UseModule($module)->UseResource($resource);
    $method = HTTPMethod::GET;
    if ($request->isPost()) {
        $method = HTTPMethod::POST;
    }
    $data = $api->Serve($requestData, $method);
    return $response->withJson($data, $api->GetStatusCode());
}

$app->get('/api/{version}/{module}/{resource}', 'apiController');
$app->post('/api/{version}/{module}/{resource}', 'apiController');


$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});