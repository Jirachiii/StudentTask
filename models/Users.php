<?php

/*
 * 用户表
 */

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $st_id
 * @property string $st_name
 * @property string $password
 * @property string $status
 * @property string $authKey
 * @property string $accessToken
 */
class Users extends \yii\db\ActiveRecord {

    /**
     * @return string 返回该AR类关联的数据表名
     */
    public static function tableName() {
        return 'users';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['st_id', 'st_name', 'password', 'status'], 'required'],
            [['st_id', 'st_name'], 'string', 'max' => 15],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 10],
            [['st_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'st_id' => 'St ID',
            'st_name' => 'St Name',
            'password' => 'Password',
            'status' => 'Status',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

}