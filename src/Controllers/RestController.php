<?php
namespace Showcase\Controllers;

use Plenty\Modules\Helper\Configuration\GetApiCallLimits;
use Plenty\Plugin\Controller;
use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Templates\Twig;
use Symfony\Component\HttpFoundation\Response as BaseResponse;

class RestController extends Controller
{
    /**
     * @param Twig     $twig
     * @param Response $response
     * @param string   $moduleName
     *
     * @return BaseResponse
     */
	public function showRestModule(Twig $twig, Response $response, string $moduleName):BaseResponse
	{
        try
        {
            $content = $twig->render('PlentyPluginShowcase::rest.intermediate_'.$moduleName);

            return $response->make($content);
        }
        catch (\Exception $e)
        {
            return $response->make('', 404);
        }
	}

    /**
     * @param Twig     $twig
     * @param Response $response
     * @param string   $moduleName
     *
     * @return BaseResponse
     */
	public function showRestModuleDetail(Twig $twig, Response $response, string $moduleName):BaseResponse
	{
        try
        {
            $content = $twig->render('PlentyPluginShowcase::rest.'.$moduleName);

            return $response->make($content);
        }
        catch (\Exception $e)
        {
            return $response->make('', 404);
        }
	}

	/**
	 * @param Twig $twig
	 * @return string
	 */
	public function showRestIntroduction(Twig $twig, GetApiCallLimits $limits):string
	{
	    $callLimits = $limits->get();
		return $twig->render('PlentyPluginShowcase::rest.introduction', compact('callLimits'));
	}
}
