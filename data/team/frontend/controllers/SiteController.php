<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\{Battle,Hero,Memorial,TimelineEvent,Story,Weapon,ContactMessage,Statistics};
use frontend\models\{LoginForm as FrontLoginForm,SignupForm,ContactForm};

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['login','logout','signup'],
                'rules' => [
                    [
                        'actions' => ['login','signup'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class' => VerbFilter::class,
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
                'class' => 'yii\\web\\ErrorAction',
            ],
        ];
    }

    /* ================= 首页 ================= */
    public function actionIndex()
    {
        // 每次访问首页记录一次访问量
        Statistics::recordVisit('frontend', 0);

        $featuredBattles = Battle::find()->where(['status'=>1])->orderBy(['importance_level'=>SORT_DESC])->limit(6)->all();
        $heroes          = Hero::find()->where(['status'=>1])->limit(8)->all();
        $memorials       = Memorial::find()->where(['status'=>1])->limit(4)->all();
        $timelineEvents  = TimelineEvent::find()->where(['status'=>1])->orderBy(['event_date'=>SORT_ASC])->limit(10)->all();
        $stories         = Story::find()->where(['status'=>1])->orderBy(['created_at'=>SORT_DESC])->limit(3)->all();
        $stats = [
            'battles'   => Battle::find()->where(['status'=>1])->count(),
            'heroes'    => Hero::find()->where(['status'=>1])->count(),
            'memorials' => Memorial::find()->where(['status'=>1])->count(),
            'weapons'   => Weapon::find()->where(['status'=>1])->count(),
        ];
        return $this->render('index',[
            'featuredBattles'=>$featuredBattles,
            'heroes'=>$heroes,
            'memorials'=>$memorials,
            'timelineEvents'=>$timelineEvents,
            'stories'=>$stories,
            'stats'=>$stats,
        ]);
    }

    /* ================= 联系我们 ================= */
    public function actionContact()
    {
        $model = new ContactForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $msg = new ContactMessage();
            $msg->user_id = Yii::$app->user->id;
            $msg->body    = $model->body;
            if($msg->save()){
                Yii::$app->session->setFlash('success','留言已提交，感谢您的反馈。');
            }else{
                Yii::$app->session->setFlash('error','保存留言时发生错误。');
            }
            return $this->refresh();
        }
        $messages=[];
        if(!Yii::$app->user->isGuest){
            $messages = ContactMessage::find()->where(['user_id'=>Yii::$app->user->id])->orderBy(['created_at'=>SORT_DESC])->all();
        }
        return $this->render('contact',[
            'model'=>$model,
            'messages'=>$messages,
        ]);
    }

    /* ============== 认证相关 ============== */
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $model = new FrontLoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login',['model'=>$model]);
    }

    public function actionSignup()
    {
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post()) && ($member=$model->signup())){
            Yii::$app->session->setFlash('success','注册成功，请使用账号登录。');
            return $this->redirect(['login']);
        }
        return $this->render('signup',['model'=>$model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
