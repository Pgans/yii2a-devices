<?php

namespace frontend\controllers;
use yii;

class CheckController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCheck_opdvisit(){
       // $cid = \Yii::$app->request->post('cid');
        //Yii::$app->session['cid'] = $cid;
    $sql = "SELECT a.REG_DATETIME, a.FINISH_DATETIME , a.HN , a.VISIT_ID, a.UNIT_REG
    FROM opd_visits a
    WHERE a.REG_DATETIME >=CURDATE()-1
    AND a.IS_CANCEL = 0 ORDER BY a.REG_DATETIME DESC";
   $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
   //Yii::$app->session['cid'] =$cid;
   // print_r($rawData);
   try {
       $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
   } catch (\yii\db2\Exception $e) {
       throw new \yii\web\ConflictHttpException('sql error');
   }
   
    //Yii::$app->session['date2']=$date2;
   $dataProvider = new \yii\data\ArrayDataProvider([
       'allModels' => $rawData,
       'pagination' => [
           'pagesize'=> 8
       ],
   ]);
   return $this->render('check-data', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'cid'=>$cid,
        
         ]);
    }
    public function actionCheck_ipdvisit(){
     $sql = "SELECT VISIT_ID, ADM_ID, ADM_DT, DSC_DT, WARD_NO, ADM_DR,BED_NO
     FROM ipd_reg
     WHERE ADM_DT > CURDATE()-1
     ORDER BY ADM_DT DESC";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    //Yii::$app->session['cid'] =$cid;
    // print_r($rawData);
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db2\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 8
        ],
    ]);
    return $this->render('check-data', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'cid'=>$cid,
         
          ]);
     }
}
    
