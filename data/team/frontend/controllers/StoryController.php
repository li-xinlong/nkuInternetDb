<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Story;

class StoryController extends Controller
{
    public function actionIndex()
    {
        $query = Story::find()->where(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 12],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Story::findOne($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('故事不存在');
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
