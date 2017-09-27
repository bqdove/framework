<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-09-27 14:29
 */
namespace Notadd\Foundation\Administration\Repositories;

use Notadd\Foundation\Http\Abstracts\Repository;

/**
 * Class StylesheetRepository.
 */
class StylesheetRepository extends Repository
{
    /**
     * Initialize.
     */
    public function initialize()
    {
        $this->module->assets()->filter(function ($definition) {
            return isset($definition['entry'])
                && isset($definition['type'])
                && $definition['entry'] == 'administration'
                && $definition['type'] == 'stylesheet';
        })->each(function ($definition) {
            $definition['file'] = $this->url->asset($definition['file']);
            $this->items[] = $definition;
        });
    }
}