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
}
