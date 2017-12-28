<?php //strict

namespace Showcase\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;

use Plenty\Modules\Category\Contracts\CategoryRepositoryContract;
use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;
use Plenty\Modules\Category\Models\Category;
use Showcase\Services\PluginApiChangelog;

class ContentController extends Controller
{
    /**
     * @param Twig $twig
     * @param PluginApiChangelog $pluginApiChangelog
     * @return string
     */
    public function showLandingPage(Twig $twig, PluginApiChangelog $pluginApiChangelog): string
    {
        $changelogEntries = $pluginApiChangelog->getChangelog();
        return $twig->render('PlentyPluginShowcase::content.LandingPage', ['changelog' => $changelogEntries]);
    }
    
    /**
     * @param Twig $twig
     * @return string
     */
    public function showSearchResults(Twig $twig): string
    {
        return $twig->render('PlentyPluginShowcase::content.GoogleSearch');
    }
    
    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showTutorials(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::content.tutorials.' . $pageName);
    }
    
    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showDevGuidePage(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::content.devguide.' . $pageName);
    }
    
    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showMarketplacePage(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::content.marketplace.' . $pageName);
    }

    /**
     * @param Twig $twig
     * @param string $pageName
     * @return string
     */
    public function showTerraPage(Twig $twig, string $pageName): string
    {
        return $twig->render('PlentyPluginShowcase::terra.' . $pageName);
    }
}
