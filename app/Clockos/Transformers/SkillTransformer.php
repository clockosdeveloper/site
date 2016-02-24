<?php
/**
 * Created by PhpStorm.
 * User: YELLOVE
 * Date: 12/3/2015
 * Time: 11:29 AM
 */

namespace Clockos\Transformers;


class SkillTransformer extends Transformer
{
    public function transform($skills)
    {
        return [
            'name' => $skills['name'],
            'logo' => $skills['logo'],
            'id'   => $skills['id']
        ];
    }
}