<?php
/**
 * This file is part of Notadd.
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2015, iBenchu.org
 * @datetime 2015-10-30 16:29
 */
namespace Notadd\Foundation\Providers;
use Illuminate\Support\ServiceProvider;
use Notadd\Foundation\AliasLoader;
use Notadd\Page\Models\Page as PageModel;
class PageServiceProvider extends ServiceProvider {
    /**
     * @return void
     */
    public function boot() {
        $this->app->make('router')->before(function() {
            $dataes = PageModel::whereEnabled(true)->get();
            foreach($dataes as $value) {
                if($this->app->make('setting')->get('site.home') !== 'page_' . $value->id) {
                    if($value->alias) {
                        $page = new \Notadd\Page\Page($value->id);
                        $this->app->make('router')->get($page->getRouting(), function() use ($page) {
                            return $this->app->call('Notadd\Page\Controllers\PageController@show', ['id' => $page->getId()]);
                        });
                    }
                }
            }
        });
        $this->app->make('router')->group(['namespace' => 'Notadd\Page\Controllers'], function () {
            $this->app->make('router')->group(['middleware' => 'auth.admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
                $this->app->make('router')->resource('page', 'PageController');
                $this->app->make('router')->post('page/{id}/delete', 'PageController@delete');
                $this->app->make('router')->post('page/{id}/restore', 'PageController@restore');
                $this->app->make('router')->get('page/{id}/sort', 'PageController@sort');
                $this->app->make('router')->post('page/{id}/sorting', 'PageController@sorting');
            });
            $this->app->make('router')->resource('page', 'PageController');
        });
        $this->loadViewsFrom($this->app->basePath() . '/resources/views/pages/', 'page');
    }
    /**
     * @return void
     */
    public function register() {
        $this->app->singleton('page', function () {
            return new Factory();
        });
    }
}