<?php
/**
 * Protected Entries plugin for Craft CMS 3.x
 *
 * Require a password to access certain entries
 *
 * @link      https://brianhanson.net
 * @copyright Copyright (c) 2020 Brian Hanson
 */

namespace brianjhanson\protectedentries\variables;

use brianjhanson\protectedentries\ProtectedEntries;

use Craft;
use craft\web\View;

/**
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 */
class ProtectedEntriesVariable
{
    /**
     * Checks if the current session is authorized to view protected content
     *
     * @return bool
     */
    public function isAuthorized()
    {
        if (!Craft::$app->request->getCookies()->get('protectedEntries')) {
            return false;
        }

        return true;
    }
}
