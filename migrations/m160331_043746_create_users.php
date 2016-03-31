<?php

use yii\db\Migration;

class m160331_043746_create_users extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'st_id'=>$this->string(15)->notNull(),
            'st_name'=>$this->string(15)->notNull(),
            'password'=>$this->string(50)->notNull(),
            'status'=>$this->string(10)->notNull(),
            'authKey'=>$this->string(50),
            'accessToken'=>$this->string(50),
        ]);
        $this->insert('users', [
            'st_id' => '031513218',
            'st_name' => '金永辉',
            'password' => md5(123456),
            'status' => '1',
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
