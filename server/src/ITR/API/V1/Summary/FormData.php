<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 11:53
 */

namespace ITR\API\V1\Summary;

use ITR\Base\IResource;

class FormData implements IResource
{

    public function Serve(array $data): array
    {
        // TODO: Implement Serve() method.
        return [
            'test'=>"it's working!"
        ];
    }
}