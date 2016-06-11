<?php

namespace app\controllers;
use app\models\StoreRecord;
use app\models\StoreTab;
use app\models\Users;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii;
use app\models\Items;
use app\models\StoreReq;
class StoreController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['index'],
                'rules' => [
                    //只有3级管理员有权限

                    [
                        'actions'       => ['index'],
                        'allow'         => true,
                        'roles'         => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->status == '物料管理员';
                        }
                    ],

                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $status='';
        $items=Items::find()->all();
        $stores=StoreReq::find()->all();
        foreach($stores as $store){
            $user=Users::find()->where(['st_id'=>$store->apply_user])->one();
            $store->apply_user=$user->st_name;
        }
        return $this->render('index',[
            'items'=>$items,
            'stores'=>$stores
        ]);
    }

    /**
     *
     * 更改申请状态
     */
    public function actionReqstatus(){

        if(isset($_POST['id'])&&!empty($_POST['id'])&&isset($_POST['status'])&&!empty($_POST['status'])){
            $id=$_POST['id'];
            $status=$_POST['status'];
            $result=StoreReq::changeStatus($id,$status);
            echo $result;
        }else{
            echo '{"success":false,"msg":"请按规范操作"}';

        }


    }

    /**
     * 获取所有库存
     */
    public function actionGetstores(){
        if(!empty($_GET['searchName'])&&isset($_GET['searchName'])){
            $stores=StoreTab::find()->where(['like','store_name',$_GET['searchName']])->asArray()->all();
            echo '{"success":true,"stores":'.json_encode($stores,JSON_UNESCAPED_UNICODE).'}';
        }else{
            $stores=StoreTab::find()->asArray()->all();
            echo '{"success":true,"stores":'.json_encode($stores,JSON_UNESCAPED_UNICODE).'}';
        }


    }
    /**
     * 获取所有操作记录
     */
    public function actionGetrecords(){
        $stores=StoreRecord::find()->asArray()->all();
        echo '{"success":true,"records":'.json_encode($stores,JSON_UNESCAPED_UNICODE).'}';

    }

    /**
     * 添加物料
     */
    public function actionAddstore(){
        if (empty($_POST["store_name"]) || !isset($_POST["store_name"])) {
            echo '{"success":false,"msg":"请填写完整"}';
            return;
        }
        if (empty($_POST["store_num"]) || !isset($_POST["store_num"])||!is_numeric($_POST["store_num"])) {
            echo '{"success":false,"msg":"数量填写错误"}';
            return;
        }
        $store_name=$_POST["store_name"];
        $store_num=$_POST["store_num"];
        $newone=new StoreTab();
        $newone->store_name=$store_name;
        $newone->store_num=$store_num;
        if($newone->save(false)){
            $addRecord=StoreRecord::addRecord($newone,'新增');
        }
        echo '{"success":true,"msg":"操作成功"}';
    }

    /**
     * 修改库存数量
     */
    public function actionChangenum(){
        if (empty($_POST["change_num"]) || !isset($_POST["change_num"])) {
            echo '{"success":false,"msg":"填写错误"}';
            return;
        }
        if (empty($_POST["change_id"]) || !isset($_POST["change_id"])||empty($_POST["changetype"]) || !isset($_POST["changetype"])) {
            echo '{"success":false,"msg":"信息获取错误，尝试刷新重试"}';
            return;
        }
        $result=StoreTab::changeStoreNum($_POST["change_id"],$_POST["changetype"],$_POST["change_num"]);

        echo $result;
    }
    /**
     * 删除库存
     */
    public  function  actionDelstore(){
        if (empty($_POST["store_id"]) || !isset($_POST["store_id"])) {
            echo '{"success":false,"msg":"出现错误，请按规范操作"}';
            return;
        }
        $theStore=StoreTab::findOne($_POST['store_id']);
        if($theStore->delete()){
            $addRecord=StoreRecord::addRecord($theStore,'删除');
        };
        echo '{"success":true}';
    }

}
