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

use brianjhanson\protectedentries\models\GlobalSettings;
use brianjhanson\protectedentries\ProtectedEntries;

use brianjhanson\protectedentries\records\GlobalRecord;
use Craft;
use craft\base\Component;

/**
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 */
class GlobalService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function save(GlobalSettings $settings)
    {
        if ($record = GlobalRecord::findOne(1)) {
            $record->password = $settings->password;
        } else {
            $record = new GlobalRecord();
            $record->password = $settings->password;
        }

        return $record->save();
    }

    public function get()
    {
        return GlobalRecord::findOne(1);
    }
}
