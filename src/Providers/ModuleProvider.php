<?php

namespace TypiCMS\Modules\Attributes\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Facades\TypiCMS;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Attributes\Models\Attribute;
use TypiCMS\Modules\Attributes\Models\AttributeTranslation;
use TypiCMS\Modules\Attributes\Models\AttributeGroup;
use TypiCMS\Modules\Attributes\Models\AttributeGroupTranslation;
use TypiCMS\Modules\Attributes\Repositories\CacheDecorator;
use TypiCMS\Modules\Attributes\Repositories\AttributeGroupCacheDecorator;
use TypiCMS\Modules\Attributes\Repositories\EloquentAttribute;
use TypiCMS\Modules\Attributes\Repositories\EloquentAttributeGroup;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.attributes'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['attributes' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'attributes');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'attributes');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/attributes'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Attributes',
            'TypiCMS\Modules\Attributes\Facades\Facade'
        );

        /*AliasLoader::getInstance()->alias(
            'AttributesGroup',
            'TypiCMS\Modules\Attributes\Facades\Facade'
        );*/
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Attributes\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Attributes\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('attributes::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('attributes');
        });

        $app->bind('TypiCMS\Modules\Attributes\Repositories\AttributeInterface', function (Application $app) {
            $repository = new EloquentAttribute(new Attribute());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'attributes', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

        $app->bind('TypiCMS\Modules\Attributes\Repositories\AttributeGroupInterface', function (Application $app) {
            $repository = new EloquentAttributeGroup(new AttributeGroup());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'attribute_groups', 10);

            return new AttributeGroupCacheDecorator($repository, $laravelCache);
        });
    }
}
