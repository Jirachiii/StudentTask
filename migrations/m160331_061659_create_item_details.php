<?php

use yii\db\Migration;

class m160331_061659_create_item_details extends Migration
{
    public function up()
    {
        $this->createTable('item_details', [
            'id' => $this->primaryKey(),
            'item_id'=>$this->integer(11)->notNull(),
            'item_detail'=>$this->string(50)->notNull(),
            'detail_status'=>$this->integer(11)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('item_details');
    }
}
