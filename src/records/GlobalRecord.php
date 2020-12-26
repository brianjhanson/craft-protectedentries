<?php
/**
 * Protected Entries plugin for Craft CMS 3.x
 *
 * Require a password to access certain entries
 *
 * @link      https://brianhanson.net
 * @copyright Copyright (c) 2020 Brian Hanson
 */


namespace brianjhanson\protectedentries\records;

use craft\db\ActiveRecord;

/**
 * GlobalRecord
 *
 *
 * @author    Brian Hanson
 * @package   ProtectedEntries
 * @since     1.0.0
 *
 * @property string $password;
 */
class GlobalRecord extends ActiveRecord
{
  public static function tableName()
  {
      return '{{%protectedentries_global}}';
  }
}
