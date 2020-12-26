<?php
/**
 * Protected Entries plugin for Craft CMS 3.x
 *
 * Require a password to access certain entries
 *
 * @link      https://brianhanson.net
 * @copyright Copyright (c) 2020 Brian Hanson
 */

namespace brianjhanson\protectedentries\services;

use brianjhanson\protectedentries\ProtectedEntries;

use brianjhanson\protectedentries\records\GlobalRecord;
use Craft;
use craft\base\Component;

/**
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 */
class AuthService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function authorize(string $userPassword)
    {
        $password = GlobalRecord::findOne(1)->password;

        return $password === $userPassword;
    }

    public function isAuthorized() {

    }
}
