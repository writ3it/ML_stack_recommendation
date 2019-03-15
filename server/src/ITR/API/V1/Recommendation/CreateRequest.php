<?php
/**
 * Created by PhpStorm.
 * User: writ3it
 * Date: 15.03.19
 * Time: 12:45
 */

namespace ITR\API\V1\Recommendation;


use ITR\Base\IResource;

class CreateRequest implements IResource
{

    public function Serve(array $data): array
    {
        return [
            'test'=>"it's working!"
        ];
    }
}