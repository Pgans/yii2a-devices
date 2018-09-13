<?php

namespace frontend\controllers;

class MeetingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCountmeeting() {
      $sql = "SELECT k.room_id, k.room_name , COUNT(k.room_name) AS 'จำนวน'
FROM 
(SELECT a.detail AS 'กิจกรรม', a.date_book AS 'วันประชุม' ,
CASE 
WHEN a.period = 0 THEN 'ช่วงเช้า'
WHEN a.period = 1 THEN 'ช่วงบ่าย'
ELSE 'ทั้งวัน'
END AS 'ช่วงเวลา', b.room_id, b.room_name, a.By_user AS 'ผู้จอง', c.user_detail AS 'ฝ่าย',a.num AS 'จำนวนคน' 
FROM book a, meeting_room b, puser c
WHERE  a.room_id = b.room_id 
AND a.user_name = c.user_name
ORDER BY a.date_book DESC)  AS k  GROUP BY k.room_name";

     $rawData = \yii::$app->db3->createCommand($sql)->queryAll();

        //print_r($rawData);
        try {
            $rawData = \Yii::$app->db3->createCommand($sql)->queryAll();
        } catch (\yii\db2\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('countmeeting', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
}
