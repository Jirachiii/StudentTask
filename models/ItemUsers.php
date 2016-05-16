<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_users".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $st_id
 */
class ItemUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'st_id'], 'required'],
            [['item_id'], 'integer'],
//            [['st_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => '项目id',
            'st_id' => '成员',
        ];
    }

    /**
     * 虎丘成员数组
     * @param $model
     * @return array
     */
    public function getItemMembers($model){
        $persons=$model->persons;
        $members=array();
        foreach($persons as $person){
            $members[]=$person['st_id'];
        }
        return $members;
    }
    public function insertMembers($users,$itemid){
        self::deleteAll('item_id = :item_id ', [':item_id' => $itemid]);
        foreach($users as $value){
            $member=new ItemUsers();
            $member->item_id=$itemid;
            $member->st_id=$value;
            $member->save(false);

        }
    }
}
