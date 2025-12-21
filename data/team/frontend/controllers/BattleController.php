<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\Battle;

class BattleController extends Controller
{
    /**
     * 战役列表
     */
    public function actionIndex()
    {
        $query = Battle::find()->where(['status' => 1]);

        // 搜索
        $keyword = Yii::$app->request->get('keyword');
        if ($keyword) {
            $query->andFilterWhere(['like', 'name', $keyword]);
        }

        // 结果筛选
        $result = Yii::$app->request->get('result');
        if ($result) {
            $query->andWhere(['result' => $result]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 12],
            'sort' => [
                'defaultOrder' => ['start_date' => SORT_ASC]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'keyword' => $keyword,
            'result' => $result,
        ]);
    }

    /**
     * 战役详情
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * 查找模型
     */
    protected function findModel($id)
    {
        if (($model = Battle::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('请求的战役不存在。');
    }
}
