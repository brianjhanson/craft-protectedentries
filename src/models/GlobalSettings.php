<?php
/**
 * Protected Entries plugin for Craft CMS 3.x
 *
 * Require a password to access certain entries
 *
 * @link      https://brianhanson.net
 * @copyright Copyright (c) 2020 Brian Hanson
 */

namespace brianjhanson\protectedentries\models;

use brianjhanson\protectedentries\ProtectedEntries;

use Craft;
use craft\base\Model;

/**
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 */
class GlobalSettings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $password = '';


    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'string'],
        ];
    }
}
