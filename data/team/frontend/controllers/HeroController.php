<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\Hero;

class HeroController extends Controller
{
    /**
     * 英雄列表
     */
    public function actionIndex()
    {
        $query = Hero::find()->where(['status' => 1]);

        $keyword = Yii::$app->request->get('keyword');
        if ($keyword) {
            $query->andFilterWhere(['like', 'name', $keyword]);
        }

        $category = Yii::$app->request->get('category');
        if ($category) {
            $query->andWhere(['category' => $category]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 16],
            'sort' => [
                'defaultOrder' => ['death_date' => SORT_ASC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'keyword' => $keyword,
            'category' => $category,
        ]);
    }

    /**
     * 英雄详情
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Hero::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('请求的英雄不存在。');
    }
}
