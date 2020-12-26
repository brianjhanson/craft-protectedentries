<?php

namespace brianjhanson\protectedentries\migrations;

use brianjhanson\protectedentries\records\GlobalRecord;
use Craft;
use craft\db\Migration;

/**
 * Install migration.
 */
class Install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableName = GlobalRecord::tableName();
        if (!$this->db->tableExists($tableName)) {
            $this->createTable($tableName, [
                'id' => $this->primaryKey(),
                'password' => $this->string()->notNull(),
                'dateCreated' => $this->dateTime()->notNull(),
                'dateUpdated' => $this->dateTime()->notNull(),
                'uid' => $this->uid(),
            ]);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $tableName = GlobalRecord::tableName();
        if ($this->db->tableExists($tableName)) {
            $this->dropTable($tableName);
        }
        return true;
    }
}
