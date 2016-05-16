<?php

use yii\db\Migration;

class m160331_093417_alter_item_details_2 extends Migration
{
    public function up()
    {
        $this->renameColumn('item_detail_person', 'item_and_detail',' item_details_id');
    }

    public function down()
    {
        echo "m160331_093417_alter_item_details_2 cannot be reverted.\n";

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
