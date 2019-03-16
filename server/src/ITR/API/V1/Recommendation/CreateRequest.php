<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 12:45
 */

namespace ITR\API\V1\Recommendation;

use ITR\Base\IResourceRequest;
use ITR\Resource;
use ITR\Storage\Storage;

class CreateRequest extends Resource
{

    public function Process(IResourceRequest $data): array
    {
        $errors = $data->GetErrors();
        $errors = array_map(function ($messages) {
            return implode("\n", $messages);
        }, $errors);
        if (!$data->HasErrors()) {
            $storage = new Storage($this->config->get('requests'));
            $storage->Persist($data);
        }
        return ['has_errors' => $data->HasErrors(), 'errors' => $errors, 'success' => (!$data->HasErrors()) && $storage->IsPersisted()];
    }

}