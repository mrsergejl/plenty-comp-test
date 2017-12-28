<?php
namespace Showcase\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;
use Plenty\Plugin\Templates\Twig;
use Showcase\Extensions\TwigPluginStringUtils;

class ShowcaseRouteServiceProvider extends RouteServiceProvider
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
		$router->get('', 'Showcase\Controllers\ContentController@showLandingPage');
		$router->get('search', 'Showcase\Controllers\ContentController@showSearchResults');
		$router->get('tutorials/{tutorialsPage}', 'Showcase\Controllers\ContentController@showTutorials');
		$router->get('dev-doc/{devGuidePage}', 'Showcase\Controllers\ContentController@showDevGuidePage');
		$router->get('marketplace/{marketplacePage}', 'Showcase\Controllers\ContentController@showMarketplacePage');
        $router->get('terra-doc/{terraPage}', 'Showcase\Controllers\ContentController@showTerraPage');
	}
}
