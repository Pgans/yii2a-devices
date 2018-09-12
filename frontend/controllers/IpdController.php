<?php

namespace frontend\controllers;
use yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use miloschuman\highcharts\Highcharts;


class IpdController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDxg(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT * FROM  mb_medicine WHERE  DSC_DT  BETWEEN '$date1' AND '$date2'
        AND ward_no = 38 GROUP BY ADM_ID ORDER BY DSC_DT";
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
       Yii::$app->session['date1'] =$date1;
       Yii::$app->session['date2'] =$date2;
       return $this->render('dxg', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionRegipd(){

        $connection = Yii::$app->db2;
        $data = $connection->createCommand('
            SELECT YEAR(DSC_DT) AS yy, MONTH(DSC_DT) AS mm,UNIT_NAME, CONVERT(COUNT(CID),INT) AS amount
                FROM mb_ipdreg
                WHERE DSC_DT BETWEEN "20161001" AND "20170130" 
                GROUP BY yy,mm
            ')->queryAll();
        //เตรียมข้อมูลส่งให้กราฟ
        for($i=0;$i<sizeof($data);$i++){
            $yy[] = $data[$i]['yy'];
            $mm[] = $data[$i]['yy'].'-'.$data[$i]['mm'];
            $amount[] = $data[$i]['amount'];
        }
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            'sort'=>[
                'attributes'=>['yy','mm','amount']
            ],
        ]);

        return $this->render('regipd',[
            'dataProvider'=>$dataProvider,
            'yy'=>$yy,'mm'=>$mm, 'amount'=> $amount,
        ]);
    }
}
