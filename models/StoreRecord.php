<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_record".
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $changeinfo
 * @property string $change_time
 * @property string $change_user
 * @property string $change_type
 */
class StoreRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'changeinfo', 'change_time', 'change_user', 'change_type'], 'required'],
            [['store_id'], 'integer'],
            [['changeinfo', 'change_time'], 'string', 'max' => 30],
            [['change_user'], 'string', 'max' => 20],
            [['change_type'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'changeinfo' => 'Changeinfo',
            'change_time' => 'Change Time',
            'change_user' => 'Change User',
            'change_type' => 'Change Type',
        ];
    }
    public static function addRecord($store,$change_info){
        $record=new StoreRecord();
        $user=yii::$app->user->identity->st_id;
        switch ($change_info){
            case '新增':
                $info='新增了新物料：'.$store->store_name;
                break;
            case '进库':
                $info='添加了新物料：'.$store->store_name;//xxx：新进了xx个
                break;
            case '出库':
                $info='添加了新物料：'.$store->store_name;
                break;
        }
        $record->store_id=$store->id;
        $record->changeinfo=$info;
        $record->change_time=date('Y-m-d H:i',time());
        $record->change_user=$user;
        $record->change_type=$change_info;
        $record->save();
        return true;
    }
}
