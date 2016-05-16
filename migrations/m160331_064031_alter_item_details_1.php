<?php

use yii\db\Migration;

class m160331_064031_alter_item_details_1 extends Migration
{
    public function up()
    {
    	 $this->addColumn('item_details', 'detail_id', $this->integer(11));
    }

    public function down()
    {
        echo "m160331_064031_alter_item_details_1 cannot be reverted.\n";

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
