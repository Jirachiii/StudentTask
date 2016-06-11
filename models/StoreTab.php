<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store_tab".
 *
 * @property integer $id
 * @property string $store_name
 * @property integer $store_num
 */
class StoreTab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_tab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'store_name', 'store_num'], 'required'],
            [['id', 'store_num'], 'integer'],
            [['store_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_name' => 'Store Name',
            'store_num' => 'Store Num',
        ];
    }

    public static function changeStoreNum($id,$type,$num){
        if($type=='plus'){
            $store=StoreTab::findOne($id);
            $store->store_num=$store->store_num+intval($num);
            if($store->save(false)){
                $addRecord=StoreRecord::addRecord($store,'进库',$num);
                return '{"success":true,"msg":"操作成功"}';
            }
        }else{
            $store=StoreTab::findOne($id);
            //要减去的数量大于剩余数量
            if(intval($num)>$store->store_num){
                return '{"success":false,"msg":"剩余没有这么多了"}';
            }
            $store->store_num=$store->store_num-intval($num);
            if($store->save(false)){
                $addRecord=StoreRecord::addRecord($store,'出库',$num);
                return '{"success":true,"msg":"操作成功"}';
            }
        }
    }
}
