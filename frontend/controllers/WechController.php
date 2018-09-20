<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;


class WechController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAsthma(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

    $sql = "SELECT
                
                a.REGDATE,
                a.CID,
                a.FNAME,
                a.LNAME,
                #a.SEX,
                a.AGE,
                a.ICD10_TM,
                a.UNIT_NAME,
                #a.TOWN_ID,
                #a.HOME_ADR,
                b.TOWN_NAME AS 'MOOBAN',
                c.TOWN_NAME AS 'TUMBOL',
                d.TOWN_NAME AS 'AUMPUR',
                e.TOWN_NAME AS 'JUNGWAT'
            FROM
                mb_dxopd a,
                towns b,
                towns c,
                towns d,
                towns e
            WHERE
                a.REGDATE  between '$date1' and '$date2'
            AND a.UNIT_REG = '12'
            AND a.ICD10_TM BETWEEN 'J45' AND 'J46'
            AND a.TOWN_ID = b.TOWN_ID
            AND CONCAT(LEFT(a.TOWN_ID, 6), '00') = c.TOWN_ID
            AND CONCAT(LEFT(a.TOWN_ID, 4), '0000') = d.TOWN_ID
            AND CONCAT(LEFT(a.TOWN_ID, 2), '000000') = e.TOWN_ID
            GROUP BY
                a.HN
            ORDER BY
                REGDATE ";
   $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

  // print_r($rawData);
   try {
       $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
   } catch (\yii\db2\Exception $e) {
       throw new \yii\web\ConflictHttpException('sql error');
   }
   Yii::$app->session['date1']=$date1;
   Yii::$app->session['date2']=$date2;
   $dataProvider = new \yii\data\ArrayDataProvider([
       'allModels' => $rawData,
       'pagination' => FALSE,
   ]);
   return $this->render('asthma', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,

   ]);   
}
}
