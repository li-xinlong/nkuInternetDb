<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\TimelineEvent;

class TimelineController extends Controller
{
    public function actionIndex()
    {
        $events = TimelineEvent::find()
            ->where(['status' => 1])
            ->orderBy(['event_date' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'events' => $events,
        ]);
    }
}
