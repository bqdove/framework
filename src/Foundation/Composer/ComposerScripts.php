<?php
/**
 * This file is part of Notadd.
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-10-24 19:08
 */
namespace Notadd\Foundation\Composer;
use Composer\Script\Event;
use Notadd\Foundation\Application;
/**
 * Class ComposerScripts
 * @package Notadd\Foundation\Composer
 */
class ComposerScripts {
    /**
     * @param \Composer\Script\Event $event
     * @return void
     */
    public static function postInstall(Event $event) {
        require_once $event->getComposer()->getConfig()->get('vendor-dir') . '/autoload.php';
        static::clearCompiled();
    }
    /**
     * @param \Composer\Script\Event $event
     * @return void
     */
    public static function postUpdate(Event $event) {
        require_once $event->getComposer()->getConfig()->get('vendor-dir') . '/autoload.php';
        static::clearCompiled();
    }
    /**
     * @return void
     */
    protected static function clearCompiled() {
        $laravel = new Application(getcwd());
        if(file_exists($compiledPath = $laravel->getCachedCompilePath())) {
            @unlink($compiledPath);
        }
        if(file_exists($servicesPath = $laravel->getCachedServicesPath())) {
            @unlink($servicesPath);
        }
    }
}