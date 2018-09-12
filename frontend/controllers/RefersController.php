<?php

namespace frontend\controllers;
use yii;

class RefersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionReferout_all(){
          $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';
    $sql = "SELECT hospid, hosp_name, count(hospid) AS 'Total' FROM mb_referout_all_list 
        WHERE  rf_dt between '$date1' AND '$date2' GROUP BY hospid ORDER BY Total DESC";

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
       return $this->render('referout_all', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql, 
                   'date1'=>$date1, 
                   'date2'=>$date2,

       ]);
   }
   public function actionReferout_all_list($hospid){
       $date1 = Yii::$app->session['date1'];
       $date2 = Yii::$app->session['date2'];
        $sql = "SELECT * FROM mb_referout_all_list WHERE hospid = $hospid 
        AND rf_dt between '$date1' AND '$date2'";

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
       return $this->render('referout_all_list', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferipd(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  UNIT_ID,UNIT_NAME, COUNT(UNIT_NAME) AS AMOUNT
FROM  mb_refer_ipd WHERE RF_DT BETWEEN '$date1' AND '$date2' GROUP BY UNIT_NAME ";
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
       Yii::$app->session['date1'] =$date1;
       Yii::$app->session['date2'] =$date2;
       return $this->render('referipd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
         public function actionReferipd_list($UNIT_ID){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_refer_ipd
            WHERE  UNIT_ID = '$UNIT_ID' AND rf_dt  BETWEEN '$date1' AND '$date2'";
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
        return $this->render('referipd_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionReferopd(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  UNIT_ID,UNIT_NAME, COUNT(UNIT_NAME) AS AMOUNT
FROM  mb_referout_all_list WHERE RF_DT BETWEEN '$date1' AND '$date2' GROUP BY UNIT_NAME  ORDER BY AMOUNT DESC";
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
       Yii::$app->session['date1'] =$date1;
       Yii::$app->session['date2'] =$date2;
       return $this->render('referopd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
         public function actionReferopd_list($UNIT_ID){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_referout_all_list
            WHERE  UNIT_ID = '$UNIT_ID' AND rf_dt  BETWEEN '$date1' AND '$date2'";
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
        return $this->render('referopd_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionReferin(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT hospid, hosp_name, COUNT(VISIT_ID) AS TOTAL
FROM mb_referin_list WHERE referdate BETWEEN '$date1' AND '$date2'
GROUP BY HOSP_NAME ORDER BY TOTAL DESC";
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
       return $this->render('referin', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
        public function actionReferin_list($hospid){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_referin_list
            WHERE hospid = $hospid AND referdate BETWEEN '$date1' AND '$date2' ORDER BY VISIT_ID DESC";
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
        return $this->render('referin_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
}
