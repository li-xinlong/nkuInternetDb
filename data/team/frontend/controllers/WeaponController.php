<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Weapon;

class WeaponController extends Controller
{
    public function actionIndex()
    {
        $query = Weapon::find()->where(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 12],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Weapon::findOne($id);
        if (!$model) {
            throw new \yii\web\NotFoundHttpException('武器不存在');
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
