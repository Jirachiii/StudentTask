<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_users".
 *
 * @property integer $id
 * @property integer $detail_id
 * @property string $st_id
 */
class DetailUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'detail_id', 'st_id'], 'required'],
            [['id', 'detail_id'], 'integer'],
            [['st_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail_id' => 'Detail ID',
            'st_id' => 'St ID',
        ];
    }
}
