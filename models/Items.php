<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $file_path
 * @property string $create_at
 * @property string $update_at
 * @property string $create_by
 * @property string $update_by
 * @property integer $status
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'create_at', 'create_by', 'status'], 'required'],
            [['content'], 'string'],
            [['status'], 'integer'],
            [['create_at', 'update_at', 'create_by', 'update_by','title'], 'string', 'max' => 20],
            [['file_path'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'file_path' => '附件路径',
            'create_at' => '发表于',
            'update_at' => '更新于',
            'create_by' => '发布者',
            'update_by' => '更新者',
            'status' => '状态',
        ];
    }
    //获取成员
    public function getPersons(){
        // 第一个参数为要关联的子表模型类名，
        // 第二个参数指定 通过子表的item_id，关联主表的id字段
        return $this->hasMany(ItemUsers::className(), ['item_id' => 'id']);
    }
    //中间表关联，获取项目所有的参与者
//    public function getItemdetailperson()
//    {
//        return $this->hasMany(ItemDetailPerson::className(), ['item_details_id' => 'id'])
//            ->viaTable('item_details', ['item_id' => 'id']);
//    }
}