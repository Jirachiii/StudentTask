<?php

namespace app\models;

use Yii;

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

    public function insertStoreReq($req,$item_id){
        $store_req=new StoreReq();
        $store_req->item_id=$item_id;
        $store_req->apply_text=$req;
        $store_req->apply_time=date('Y-m-d H:i',time());
        $store_req->apply_status='待审核';
        $store_req->save(false);

    }
}
