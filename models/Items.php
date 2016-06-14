<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $create_at
 * @property string $update_at
 * @property string $create_by
 * @property string $update_by
 * @property string $status
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
            [['status'], 'string'],
            [['create_at', 'update_at', 'create_by', 'update_by','title'], 'string', 'max' => 20],
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

    public function addDetailTask($item_id,$tasks,$members,$item_id){
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            foreach($tasks as $key => $task){
                $item_detail=new ItemDetail();
                $item_detail->item_id=$item_id;
                $item_detail->task_content=$task;
                $item_detail->create_at=date('Y-m-d H:i',time());
//                $item_detail->update_at='2016';
                $item_detail->create_by=Yii::$app->user->identity->st_id;
//                $item_detail->update_by='F';
                $taskMembers=array();
                foreach($members[$key] as $member){
                    array_push($taskMembers,$member);
                }
                $item_detail->members=implode(',',$taskMembers);
                $item_detail->save(false);

            }
            $transaction->commit();
        } catch(Exception $e) {
            $transaction->rollBack();
        }
    }

    /**
     * 个人任务查看
     * @return array
     */
    public  function getMyItems(){
        $usernow=Yii::$app->user->identity->st_id;
        $task_in=ItemDetail::find()->select('item_id')->where(['like','members',$usernow])->asArray()->all();
        $items=array();
        foreach($task_in as $item){
            array_push($items,$item['item_id']);
        }
        $items=array_unique($items);
        return $items;
    }

    /**
     * @param $id
     */
    public function showItemDetails($itemid){
        $details=ItemDetail::find()->where(['item_id'=>$itemid])->asArray()->all();
        foreach($details as $key=>$one){
            $members=array();
            $members=explode(',',$one['members']);
            $memArr=array();
            foreach($members as $personid){
                $student=Users::find()->select('st_name')->where(['st_id'=>$personid])->one();
                array_push($memArr,$student->st_name);
            }
            $memStr=implode(',',$memArr);
            $details[$key]['members']= $memStr;

        }

        $stores=StoreReq::find()->where(['item_id'=>$itemid])->asArray()->all();
        foreach($stores as $key=>$one){
            $person=Users::find()->where(['st_id'=>$one['apply_user']])->one();
            $stores[$key]['apply_user']=$person->st_name;
        }
        $item=Items::find()->where(['id'=>$itemid])->asArray()->one();
        return '{"success":true,"item":'.json_encode($item,JSON_UNESCAPED_UNICODE).',"details":'.json_encode($details,JSON_UNESCAPED_UNICODE).',"store":'.json_encode($stores,JSON_UNESCAPED_UNICODE).'}';
    }

    /**
     * 我参与的项目详情
     * @param $itemid
     */
    public function myItemDetail($itemid){
        $usernow=Yii::$app->user->identity->st_id;
        $item=Items::find()->where(['id'=>$itemid])->asArray()->one();
        $details=ItemDetail::find()->where(['and',['item_id'=>$itemid],['like','members',$usernow]])->asArray()->all();
//        $pubisher=Users::find()->where(['st_id'=>$item['s']])->one();
//        $details[$key]['members']=implode(',',$membersArr);
        foreach($details as $key=>$value){
            $pubisher=Users::find()->where(['st_id'=>$value['create_by']])->one();
            $details[$key]['create_by']=$pubisher->st_name;
            $membersArr=array();
            $members=explode(',',$value['members']);
            foreach($members as $one){
                $user=Users::find()->where(['st_id'=>$one])->one();
                array_push($membersArr,$user->st_name);
            }
            $details[$key]['members']=implode(',',$membersArr);
        }

        return '{"success":true,"item":'.json_encode($item,JSON_UNESCAPED_UNICODE).',"details":'.json_encode($details,JSON_UNESCAPED_UNICODE).'}';
    }
}
