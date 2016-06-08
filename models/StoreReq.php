<?php

namespace app\models;

use Yii;
use app\models\Users;


/**
 * This is the model class for table "store_req".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $apply_time
 * @property string $apply_status
 */
class StoreReq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_req';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'apply_time', 'apply_status','apply_text'], 'required'],
            [['item_id'], 'integer'],
            [['apply_time'], 'string', 'max' => 20],
            [['apply_user'], 'string', 'max' => 15],
            [['apply_text'], 'string', 'max' => 50],
            [['apply_status'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'apply_time' => 'Apply Time',
            'apply_status' => 'Apply Status',
        ];
    }

    /**
     * 插入物料
     * @param $req
     * @param $item_id
     */
    public function insertStoreReq($req,$item_id){
        $store_req=new StoreReq();
        $store_req->item_id=$item_id;
        $store_req->apply_text=$req;
        $store_req->apply_time=date('Y-m-d H:i',time());
        $store_req->apply_status='待审核';
        $store_req->apply_user=Yii::$app->user->identity->st_id;
        $store_req->save(false);

    }
    public static function  getStores($item_id){
        $stores=StoreReq::find()->where(['item_id'=>$item_id])->all();
        foreach($stores as $store){
            $user=Users::find()->where(['st_id'=>$store->apply_user])->one();
            $store->apply_user=$user->st_name;
        }
        return $stores;
    }
    /**
     * 更改物料申请状态
     * @param $id
     * @param $status
     * @return string
     */
    public static function changeStatus($id,$status){
        $thereq=self::findOne($id);
        $thereq->apply_status=$status;
        $thereq->save();
        $result= '{"success":true,"msg":"更新成功","status":'.json_encode($status,JSON_UNESCAPED_UNICODE).'}';
        return $result;
    }
}
