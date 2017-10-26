<?php
/**
 * This file is part of Notadd.
 *
 * @author        TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime      2017-10-19 18:17
 */
namespace Notadd\Foundation\Cache\GraphQL\Mutations;

use Notadd\Foundation\GraphQL\Abstracts\Mutation;

/**
 * Class ConfigurationMutation.
 */
class ClearMutation extends Mutation
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'cache.clear';
    }

    /**
     * @return mixed
     */
    public function resolve()
    {
        // TODO: Implement resolve() method.
    }
}
