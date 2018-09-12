<?php

namespace frontend\controllers;
use yii;

class DentalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionReg_dent(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT DISTINCT a.REG_DATETIME,a.HN,a.FNAME, a.LNAME, a.SEX, a.AGE ,a.`CODE`,
a.HOME_ADR, c.TOWN_NAME AS 'MOOBAN', d.TOWN_NAME AS 'TUMBOL',e.TOWN_NAME AS 'AUMPUR',a.PROVIDER
FROM mb_oper_dent a, towns c ,towns d, towns e
WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
AND FLOOR(DATEDIFF(now(),a.BIRTHDATE)/365.25) >= '60'
AND a.TOWN_ID = c.TOWN_ID
AND CONCAT(left(a.TOWN_ID,6),'00') = d.TOWN_ID
AND CONCAT(left(a.TOWN_ID,4),'0000') = e.TOWN_ID GROUP BY a.HN ORDER BY a.REG_DATETIME,a.HN";

      $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       Yii::$app->session['date1'] = $date1;
       Yii::$app->session['date2'] = $date2;
       return $this->render('regis_dent', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]); 
   }
   public function actionBrush(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT REG_DATETIME , HN ,FNAME, LNAME, SEX , AGE, `CODE`,PROVIDER
                FROM mb_oper_dent
                WHERE REG_DATETIME BETWEEN '$date1' AND '$date2'
                AND `CODE` = '2338610'";

      $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       Yii::$app->session['date1'] = $date1;
       Yii::$app->session['date2'] = $date2;
       return $this->render('brush', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]); 
   }
   
}
