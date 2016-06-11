<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_detail".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $task_content
 * @property string $create_at
 * @property string $update_at
 * @property string $create_by
 * @property string $update_by
 */
class ItemDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'task_content', 'create_at', 'create_by'], 'required'],
            [['id', 'item_id'], 'integer'],
            [['task_content'], 'string', 'max' => 30],
            [['create_at','update_by'], 'string', 'max' => 20],
            [['members'], 'string', 'max' => 200],
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
            'task_content' => 'Task Content',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
        ];
    }
}
