<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\Memorial;

class MemorialController extends Controller
{
    public function actionIndex()
    {
        $query = Memorial::find()->where(['status' => 1]);

        $keyword = Yii::$app->request->get('keyword');
        if ($keyword) {
            $query->andFilterWhere(['like', 'name', $keyword]);
        }

        $type = Yii::$app->request->get('type');
        if ($type) {
            $query->andWhere(['type' => $type]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 12],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'keyword' => $keyword,
            'type' => $type,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Memorial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('请求的纪念馆不存在。');
    }
}
