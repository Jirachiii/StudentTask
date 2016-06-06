<?php

namespace app\models;

use Yii;
use yii\db\Query;
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
    public function getIteminfo(){
        return $this->hasMany(Items::className(), ['id' => 'item_id']);
    }
    /**
     * 获取成员数组
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
    public function getItemChineseName($members){
        $chinesename=array();
        foreach ($members as $value) {
            $theone=Users::find()->where(['st_id'=>$value])->one();
            $chinesename[]=$theone->st_name;
        }
        return $chinesename;
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

    /**
     * 获取发布者的中文名
     * @param $name
     * @return array|bool
     */
    public function getChineseName($name){
        $Cname=(new Query())->select('st_name')->from('users')->where(['st_id'=>$name])->one();
        return $Cname;
    }
    public function getStudentAdmins($id){
        $adminStr='';
        $admins=(new Query())->select('st_id')->from('item_users')->where(['item_id'=>$id])->all();
        foreach($admins as $key=>$arr){
            $Cnmae=(new Query())->select('st_name')->from('users')->where(['st_id'=>$arr['st_id']])->one();
            $adminStr.='   '.$Cnmae['st_name'];
        }
        return $adminStr;
    }
}
