<?php

namespace app\controllers;
use app\models\StoreRecord;
use app\models\StoreTab;
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
                            return Yii::$app->user->identity->status == 3;
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
        $stores=StoreTab::find()->asArray()->all();
        echo '{"success":true,"stores":'.json_encode($stores,JSON_UNESCAPED_UNICODE).'}';

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
     * 删除库存
     */
    public  function  actionDelstore(){
        if (empty($_POST["store_id"]) || !isset($_POST["store_id"])) {
            echo '{"success":false,"msg":"出现错误，请按规范操作"}';
            return;
        }
        $theStore=StoreTab::findOne($_POST['store_id']);
        $theStore->delete();
        echo '{"success":true}';
    }

}
