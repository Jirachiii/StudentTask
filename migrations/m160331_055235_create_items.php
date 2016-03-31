<?php

use yii\db\Migration;

class m160331_055235_create_items extends Migration
{
    public function up()
    {
        $this->createTable('items', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(20)->notNull(),
            'content'=>$this->text()->notNull(),
            'file_path'=>$this->string(50),
            'crate_at'=>$this->integer(20)->notNull(),
            'update_at'=>$this->integer(20),
            'crate_by'=>$this->integer(20)->notNull(),
            'update_by'=>$this->integer(20),
            'status'=>$this->integer(10)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('items');
    }
}
