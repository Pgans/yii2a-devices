<?php

namespace frontend\controllers;

use yii;

class SearchController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionM_search(){
        $cid = \Yii::$app->request->post('cid');
        Yii::$app->session['cid'] = $cid;

    $sql = "SELECT  b.HN ,a.CID , a.FNAME ,a.LNAME ,a.BIRTHDATE, s.STAFF_ID
    FROM population a
    INNER JOIN cid_hn b ON a.CID = b.cid
    LEFT JOIN staff s ON a.CID = s.CID
    WHERE a.cid = $cid";
   $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
   Yii::$app->session['cid'] =$cid;
  // print_r($rawData);
   try {
       $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
   } catch (\yii\db2\Exception $e) {
       throw new \yii\web\ConflictHttpException('sql error');
   }
   
   //Yii::$app->session['date2']=$date2;
   $dataProvider = new \yii\data\ArrayDataProvider([
       'allModels' => $rawData,
       'pagination' => FALSE,
   ]);
   return $this->render('person', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'cid'=>$cid,
        
   ]);
}
}
