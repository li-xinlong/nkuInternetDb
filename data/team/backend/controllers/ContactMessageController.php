<?php
namespace backend\controllers;

use Yii;
use common\models\ContactMessage;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ContactMessageController 后台留言管理。
 */
class ContactMessageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * 留言列表
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ContactMessage::find()->with('user')->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 查看留言 + 回覆
     */
    public function actionReply($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->replied_at = time();
            $model->status = ContactMessage::STATUS_REPLIED;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '回复已保存！');
                return $this->redirect(['index']);
            }
        }

        return $this->render('reply', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = ContactMessage::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('留言不存在');
    }
}


