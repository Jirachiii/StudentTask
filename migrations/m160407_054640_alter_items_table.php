<?php

use yii\db\Migration;

class m160407_054640_alter_items_table extends Migration
{
    public function up()
    {

         $this->alterColumn('items', 'crate_at','string(20)');
         $this->alterColumn('items', 'update_at','string(20)');
    }

    public function down()
    {
        echo "m160407_054640_alter_items_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
