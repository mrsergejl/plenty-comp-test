<?php
namespace Showcase\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

class ShowcaseApiRouteServiceProvider extends RouteServiceProvider
{
	/**
	 *
	 */
	public function register()
	{
	}

	/**
	 * @param Router $router
	 */
	public function map(Router $router)
	{
		$router->get('api-doc/{module}', 'Showcase\Controllers\ApiDocController@showApiModule');
	}
}
