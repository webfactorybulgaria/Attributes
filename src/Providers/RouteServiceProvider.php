<?php

namespace TypiCMS\Modules\Attributes\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Attributes\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Admin routes
             */
            $router->get('admin/attribute-groups', 'AttributeGroupsAdminController@index')->name('admin::index-attribute_groups');
            $router->get('admin/attribute-groups/create', 'AttributeGroupsAdminController@create')->name('admin::create-attribute_group');
            $router->get('admin/attribute-groups/{group}/edit', 'AttributeGroupsAdminController@edit')->name('admin::edit-attribute_group');
            $router->post('admin/attribute-groups', 'AttributeGroupsAdminController@store')->name('admin::store-attribute_group');
            $router->put('admin/attribute-groups/{group}', 'AttributeGroupsAdminController@update')->name('admin::update-attribute_group');

            $router->get('admin/attribute-groups/{group}/attributes', 'AdminController@index')->name('admin::index-attributes');
            $router->get('admin/attribute-groups/{group}/attributes/create', 'AdminController@create')->name('admin::create-attribute');
            $router->get('admin/attribute-groups/{group}/attributes/{attribute}/edit', 'AdminController@edit')->name('admin::edit-attribute');
            $router->post('admin/attribute-groups/{group}/attributes', 'AdminController@store')->name('admin::store-attribute');
            $router->put('admin/attribute-groups/{group}/attributes/{attribute}', 'AdminController@update')->name('admin::update-attribute');
            $router->post('admin/attributes/sort', 'AdminController@sort')->name('admin::sort-menulinks');

            /*
             * API routes
             */
            $router->get('api/attributes', 'ApiController@index')->name('api::index-attributes');
            $router->put('api/attributes/{attribute}', 'ApiController@update')->name('api::update-attribute');
            $router->delete('api/attributes/{attribute}', 'ApiController@destroy')->name('api::destroy-attribute');

            $router->get('api/attribute-groups', 'AttributeGroupsApiController@index')->name('api::index-attribute_groups');
            $router->put('api/attribute-groups/{attribute}', 'AttributeGroupsApiController@update')->name('api::update-attribute_group');
            $router->delete('api/attribute-groups/{attribute}', 'AttributeGroupsApiController@destroy')->name('api::destroy-attribute_group');
        });
    }
}
