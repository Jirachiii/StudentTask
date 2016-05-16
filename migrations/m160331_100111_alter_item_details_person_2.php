<?php

use yii\db\Migration;

class m160331_100111_alter_item_details_person_2 extends Migration
{
    public function up()
    {
        $this->renameColumn('item_detail_person', ' item_details_id','item_details_id');
    }

    public function down()
    {
        echo "m160331_100111_alter_item_details_person_2 cannot be reverted.\n";

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
