<?php
namespace Showcase\Services;

use Plenty\Plugin\CachingRepository;
use Plenty\Plugin\ConfigRepository;
use Showcase\Models\ChangelogEntry;

/**
 * Created by ptopczewski, 27.02.17 17:12
 * Class PluginApiChangelog
 * @package Showcase\Services
 */
class PluginApiChangelog
{
    const FORUM_HOST = 'https://forum.plentymarkets.com';
    
    const MAX_CHANGELOG_ENTRIES = 5;
    
    /**
     * @var array
     */
    private static $tags = ['plugin', 'rest'];
    
    /**
     * @var ConfigRepository
     */
    private $configRepository;
    
    /**
     * @var CachingRepository
     */
    private $cachingRepository;
    
    /**
     * PluginChangelog constructor.
     * @param ConfigRepository $configRepository
     * @param CachingRepository $cachingRepository
     */
    public function __construct(ConfigRepository $configRepository, CachingRepository $cachingRepository)
    {
        $this->configRepository  = $configRepository;
        $this->cachingRepository = $cachingRepository;
    }
    
    /**
     * @return
     */
    public function getChangelog()
    {
        return $this->cachingRepository->remember(
            'showcase.changelog',
            5,
            function () {
                $apiKey      = $this->configRepository->get('PlentyPluginShowcase.discourse_api_key');
                $apiUsername = $this->configRepository->get('PlentyPluginShowcase.discourse_api_username');
                
                $url = self::FORUM_HOST . '/search.json?q=tags%3A' . implode('%2C',
                        self::$tags) . '%20%23changelog&order=create' .
                    '&api_key=' . $apiKey .
                    '&api_username=' . $apiUsername;
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                
                $result           = json_decode($output, true);
                $changelogEntries = [];
                if (is_array($result['topics'])) {
                    $counter = 0;
                    foreach ($result['topics'] as $topic) {
                        
                        /** @var ChangelogEntry $changelogEntry */
                        $changelogEntry = pluginApp(ChangelogEntry::class);
                        $changelogEntry->setTitle($topic['title']);
                        $changelogEntry->setUrl(self::FORUM_HOST . '/t/' . $topic['slug'] . '/' . $topic['id']);
                        $changelogEntry->setDateString($topic['created_at']);
                        
                        //TODO change to array_intersect after added to plugin api
                        $changelogEntry->setTags(array_filter($topic['tags'], function($tag){ return in_array($tag, self::$tags);}));
                        
                        $changelogEntries[] = $changelogEntry;
                        $counter++;
                        
                        if ($counter > self::MAX_CHANGELOG_ENTRIES) {
                            break;
                        }
                    }
                }
                return $changelogEntries;
            }
        );
    }
}