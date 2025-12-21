<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Statistics;
use common\models\Guestbook;
use common\models\Story;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [ 'actions'=>['login','error'],  'allow'=>true ],
                    [ 'actions'=>['logout','index'],'allow'=>true,'roles'=>['@'] ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [ 'logout'=>['post'] ],
            ],
        ];
    }

    public function actions()
    {
        return [ 'error'=>['class'=>'yii\\web\\ErrorAction'] ];
    }

    /*=========== 后台首页 ===========*/
    public function actionIndex()
    {
        // 今日与昨日访问
        $todayVisitCount     = Statistics::getTodayVisitCount();
        $yesterdayVisitCount = Statistics::getTodayVisitCount(date('Y-m-d',strtotime('-1 day')));

        // 当天时间戳区间
        $start = strtotime('today');
        $end   = $start + 86400;

        // 评论
        $todayCommentCount     = Guestbook::find()->where(['between','created_at',$start,$end-1])->count();
        $yesterdayCommentCount = Guestbook::find()->where(['between','created_at',$start-86400,$start-1])->count();

        // 故事
        $todayStoryCount     = Story::find()->where(['between','created_at',$start,$end-1])->count();
        $yesterdayStoryCount = Story::find()->where(['between','created_at',$start-86400,$start-1])->count();

        return $this->render('index', [
            'todayVisitCount'       => $todayVisitCount,
            'yesterdayVisitCount'   => $yesterdayVisitCount,
            'todayCommentCount'     => $todayCommentCount,
            'yesterdayCommentCount' => $yesterdayCommentCount,
            'todayStoryCount'       => $todayStoryCount,
            'yesterdayStoryCount'   => $yesterdayStoryCount,
        ]);
    }

    /*=========== 认证 ===========*/
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest){return $this->goHome();}
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->goBack();
        }
        $model->password='';
        return $this->render('login',['model'=>$model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}