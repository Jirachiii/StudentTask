<?php

use yii\db\Migration;

class m160331_062339_create_item_detail_person extends Migration
{
    public function up()
    {
        $this->createTable('item_detail_person', [
            'id' => $this->primaryKey(),
            'item_and_detail'=>$this->string(20)->notNull(),
            'st_id'=>$this->string(15)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('item_detail_person');
    }
}
