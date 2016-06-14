<?php

namespace app\controllers;

use app\models\Items;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ItemSearch;
use app\models\ItemUsers;
use app\models\Users;
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','view'],
                'rules' => [
                    [
                        'actions' => ['logout','index','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
//        return $this->render('index');
    }
    public function actionView($id)
    {
        //获取成员
        $model = Items::findOne($id);
        $user=new ItemUsers();
        $members=$user->getItemMembers($model);
        $members=$user->getItemChineseName($members);
        //获取中文名
        $author=Items::findOne($id);
        $creater=Users::find()->where(['st_id'=>$author->create_by])->one();
        $updater=Users::find()->where(['st_id'=>$author->update_by])->one();
//        return $this->render('@app/views/item/view', [
//            'model' => $model,
//            'members'=>$members,
//        ]);
        if($creater && $updater){
            return $this->render('@app/views/item/view', [
                'model' => $model,
                'creater'=>$creater,
                'updater'=>$updater,
                'members'=>$members,
            ]);
        }elseif($creater){
            return $this->render('@app/views/item/view', [
                'model' => $model,
                'creater'=>$creater,
                'members'=>$members,
            ]);
        }else{
            return $this->render('@app/views/item/view', [
                'model' => $model,
                'members'=>$members,
            ]);
        }

    }


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
