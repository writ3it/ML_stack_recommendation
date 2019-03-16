<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 16.03.19
 * Time: 14:12
 */

use Slim\Http\Request;
use Slim\Http\Response;
use ITR\HTTP\HTTPMethod;
use ITR\API;
use Noodlehaus\Config;

function apiController(Request $request, Response $response, array $args)
{
    extract($args);
    $configuration = Config::load('../configuration.xml');
    $configuration->set('http.request', $request);
    /** @var string $version */
    /** @var string $module */
    /** @var string $resource */
    /** @var ITR\API $api */
    $api = new API($configuration);
    $requestData = $request->getParsedBody() ?? [];
    $api = $api->UseVersion($version)->UseModule($module)->UseResource($resource);
    $method = HTTPMethod::GET;
    if ($request->isPost()) {
        $method = HTTPMethod::POST;
    }
    $data = $api->Serve($requestData, $method);
    return $response->withJson($data, $api->GetStatusCode());
}