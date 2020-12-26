<?php
/**
 * Protected Entries plugin for Craft CMS 3.x
 *
 * Require a password to access certain entries
 *
 * @link      https://brianhanson.net
 * @copyright Copyright (c) 2020 Brian Hanson
 */

namespace brianjhanson\protectedentries;

use brianjhanson\protectedentries\services\AuthService;
use brianjhanson\protectedentries\services\GlobalService;
use brianjhanson\protectedentries\variables\ProtectedEntriesVariable;
use Craft;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use yii\base\Event;

/**
 * Class ProtectedEntries
 *
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 *
 * @property GlobalService $global
 * @property AuthService $auth
 */
class ProtectedEntries extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ProtectedEntries
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = true;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'global' => GlobalService::class,
            'auth' => AuthService::class,
        ]);

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $event->rules['protected-entries'] = 'protected-entries/global/render';
            }
        );

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('protectedEntries', ProtectedEntriesVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'protected-entries',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
