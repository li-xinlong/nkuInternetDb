<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use common\models\Story;
use common\models\Guestbook;
use common\models\Statistics;

class StoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'], // 只对 create action 应用规则
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'], // 只允许登录用户
                    ],
                ],
            ],
        ];
    }
    public function actionCreate()
    {
        $model = new Story();

        if ($model->load(Yii::$app->request->post())) {
            $member = Yii::$app->user->identity;
            $model->author = $member->username; // 假设用用户名作为作者
            $model->status = 0; // 0 表示待审核

            if ($model->save()) {
                Yii::$app->session->setFlash('success', '您的故事已成功提交，正在等待审核。');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionIndex()
    {
        $query = Story::find()->where(['status' => 1]); // 只显示已批准的故事

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 12],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_ASC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        // 评论列表
        $commentQuery = Guestbook::find()
            ->where([
                'related_model' => 'story',
                'related_id' => $model->id,
                'status' => 1, // 只显示已批准的
            ])
            ->orderBy(['created_at' => SORT_DESC]);

        $commentDataProvider = new ActiveDataProvider([
            'query' => $commentQuery,
            'pagination' => ['pageSize' => 10],
        ]);

        // 新建评论
        $commentModel = new Guestbook([
            'related_model' => 'story',
            'related_id' => $model->id,
            'category' => 'comment',
        ]);

        if ($commentModel->load(Yii::$app->request->post())) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error', '请先登录后再发表评论。');
                return $this->redirect(['/site/login', 'returnUrl' => Yii::$app->request->url]);
            }

            $member = Yii::$app->user->identity;
            $commentModel->name = $member->username;
            $commentModel->email = $member->email;

            if ($commentModel->save()) {
                Yii::$app->session->setFlash('success', '评论已提交，等待审核。');
                return $this->refresh('#story-comments');
            }
        }

        return $this->render('view', [
            'model' => $model,
            'commentModel' => $commentModel,
            'commentDataProvider' => $commentDataProvider,
        ]);
    }

    /**
     * 点赞故事本身
     */
    public function actionLikeStory($id)
    {
        $this->checkLogin();
        $story = $this->findModel($id);
        Statistics::recordLike('story', $story->id);
        $likes = Statistics::getLikeCount('story', $story->id);

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true, 'likes' => $likes];
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * 点赞故事下的评论
     */
    public function actionLikeComment($id)
    {
        $this->checkLogin();
        $comment = Guestbook::findOne($id);
        if (!$comment) {
            throw new NotFoundHttpException('评论不存在。');
        }

        Statistics::recordLike('guestbook', $comment->id);
        $likes = Statistics::getLikeCount('guestbook', $comment->id);

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true, 'likes' => $likes];
        }
        return $this->redirect(['view', 'id' => $comment->related_id, '#' => 'comment-' . $comment->id]);
    }

    protected function findModel($id)
    {
        // 在前台，只允许查看已批准的故事
        if (($model = Story::findOne(['id' => $id, 'status' => 1])) !== null) {
            return $model;
        }
        // 如果故事存在但未获批准，对于普通用户来说，也应视为“不存在”
        throw new NotFoundHttpException('您所访问的故事不存在或正在审核中。');
    }

    protected function checkLogin()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('error', '请先登录后再进行操作。');
            return $this->redirect(['/site/login', 'returnUrl' => Yii::$app->request->referrer ?: Yii::$app->homeUrl]);
        }
    }
}
