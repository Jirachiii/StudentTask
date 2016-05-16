<?php

namespace app\controllers;

use app\models\ItemUsers;
use app\models\User;
use app\models\Users;
use Yii;
use app\models\Items;
use app\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\db\Query;
/**
 * ItemController implements the CRUD actions for Items model.
 */
class ItemController extends Controller
{
    /**
     * @inheritdoc
     */
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
                'only'  => ['create','index','view','update'],
                'rules' => [
                    //只有1级管理员有权限
                    [
                        'actions'       => ['create','index','view','update'],
                        'allow'         => true,
                        'roles'         => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->status == 1;
                        }
                    ],

                ],
            ],
        ];
    }

    /**
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $author=Items::findOne($id);
        $creater=Users::find()->where(['st_id'=>$author->create_by])->one();
        $updater=Users::find()->where(['st_id'=>$author->update_by])->one();
        if( $creater){
           return $this->render('view', [
             'model' => $this->findModel($id),
             'creater'=>$creater,
             'updater'=>$updater,
            ]);
        }else{
            return $this->render('view', [
             'model' => $this->findModel($id),
            ]);
        }
        
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Items();
        $user=new ItemUsers();
        $allusers=Users::find()->all();
        $model->create_by=Yii::$app->user->identity->st_id;
        $model->status=1;
        $model->create_at=date('Y-m-d H:i',time());
        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            $model->save(false);
            $user->insertMembers($user->st_id,$model->id);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'user'=>$user,
                'allusers'=>$allusers,
            ]);
        }
    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user=new ItemUsers();
        $members=$user->getItemMembers($model);
//        print_r($members);die;
        $user->st_id=$members;
        $allusers=Users::find()->all();
        $model->update_by=Yii::$app->user->identity->st_id;
        $model->status=1;
        $model->update_at=date('Y-m-d-H:i',time());
        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            $model->save();
            $user->insertMembers($user->st_id,$id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'user'=>$user,
                'allusers'=>$allusers,
            ]);
        }
    }

    /**
     * Deletes an existing Items model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    public function actionMobile($id){
        // print_r(Yii::$app->user->identity->st_id );die;
        $info=(new Query)->from('items')->where(['id'=>$id])->one();
        $item=Items::findOne($id);
        $users=$item->persons;
        $members=array();
        foreach ($users as $value) {
            $members[]=$value['st_id'];
        }
        $info['members']=$members;
        $result=json_encode($info,JSON_UNESCAPED_UNICODE);


        // foreach ($info as $key => $value) {
        //     if(!is_array($value)){
        //         $info[$key]=htmlspecialchars($value); 
        //         // print_r($value);
        //     }
            
        // }

        $result=json_encode($info,JSON_UNESCAPED_UNICODE);
        print_r($result);
    }

    public function  actionMobileitemcreate($title,$content,$st_id,$publisher){
        $connection = \Yii::$app->db;
        try {
            $model = new Items();
            $user=new ItemUsers();
            $allusers=Users::find()->all();
            $model->title=$title;
            $model->content=$content;
            $model->create_by=$publisher;
            $model->status=1;
            $model->create_at=date('Y-m-d-H:i',time());
            $model->save(false);
            $memberArray=explode(',',$st_id);
            $user->insertMembers($memberArray,$model->id);
            $transaction = $connection->beginTransaction();
            $transaction->commit();
        } catch(Exception $e) {
            $transaction->rollBack();
        }



    }

    /**
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
