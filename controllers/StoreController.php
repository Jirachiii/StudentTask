<?php

namespace app\controllers;
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
        $items=Items::find()->all();
        $stores=StoreReq::find()->all();
        return $this->render('index',[
            'items'=>$items,
            'stores'=>$stores
        ]);
    }

}
