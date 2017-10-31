<?php
/**
 * This file is part of Notadd.
 *
 * @author        TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      2017-10-23 19:58
 */
namespace Notadd\Foundation\Extension\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Notadd\Foundation\GraphQL\Abstracts\Type as AbstractType;

/**
 * Class ExtensionType.
 */
class ExtensionType extends AbstractType
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'enabled'        => [
                'description' => '',
                'type'        => Type::boolean(),
            ],
            'identification' => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'name'           => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'namespace'      => [
                'description' => '',
                'type'        => Type::string(),
            ],
            'provider'       => [
                'description' => '',
                'type'        => Type::string(),
            ],
        ];
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'extension';
    }
}