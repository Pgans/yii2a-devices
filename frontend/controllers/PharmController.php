<?php

namespace frontend\controllers;
use yii;

class PharmController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAllergy(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.CID, a.FNAME, a.LNAME, a.SEX, a.AGE, b.TOWN_NAME AS 'MOOBAN' , c.TOWN_NAME AS 'TUMBOL',
a.DRUG_NAME, a.ALLERGY_DATE , a.`LEVEL`, a.ALLERGY_NOTE
FROM mb_drug_allergy a, towns b, towns c ,towns d
WHERE a.ALLERGY_DATE BETWEEN '$date1' AND '$date2'
AND a.TOWN_ID = b.TOWN_ID
AND CONCAT(left(a.TOWN_ID,6),'00') = c.TOWN_ID
AND CONCAT(left(a.TOWN_ID,4),'0000') = d.TOWN_ID
GROUP BY a.DRUG_NAME  ORDER BY a.ALLERGY_DATE";

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
       return $this->render('allergy', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]); 
   }
}
