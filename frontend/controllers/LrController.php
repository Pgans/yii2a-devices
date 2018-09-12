<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\web\Controller;


class LrController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['newborn','anc','dxg','admitt', 'admitt22'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionNewborn(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  * FROM mb_nbb WHERE DSC BETWEEN '$date1' AND '$date2' GROUP BY ADM_ID ORDER  BY ADM_ID";
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
       return $this->render('newborn', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
   public function actionAnc(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  CID ,REG_DATETIME, GA , GRAVIDA, WEIGHT, HEIGHT, CID_FATHER FROM mb_anc WHERE lmp BETWEEN '$date1' AND '$date2'
        AND is_cancel = 0";
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
       return $this->render('anc', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
     public function actionDxg(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT * FROM  mb_medicine WHERE  ADM_DT  BETWEEN '$date1' AND '$date2'
        AND ward_no = 22 AND LOCATE('Z380',P_DIAG) GROUP BY ADM_ID ORDER BY DSC_DT";
       $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       //Yii::$app->session['date1']=$date1;
       //Yii::$app->session['date2']=$date2;
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
   public function actionAdmitt(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  a.VISIT_ID, a.ADM_ID, a.ADM_DT, a.DSC_DT, a.DSC_STATUS,DSC_TYPE, b.UNIT_NAME,a.P_DIAG, a.ADJRW
                FROM ipd_reg a, service_units b
                WHERE a.DSC_DT BETWEEN '$date1' AND '$date2'
                AND WARD_NO = 22
                AND a.WARD_NO = b.UNIT_ID
                GROUP BY a.ADM_ID,a.VISIT_ID";
        
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
       return $this->render('admitt', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionAdmitt22(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT YEAR(DSC_DT) AS YYYY, MONTH(DSC_DT) AS MM, UNIT_NAME , COUNT(CID) AS AMOUNT
                FROM mb_ipdreg
                WHERE ADM_DT BETWEEN '$date1' AND '$date2'
                AND UNIT_ID = 22
                GROUP BY YYYY,MM  ORDER BY YYYY,MM ";
     
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


      /* //เตรียมข้อมูลให้กราฟ
       for($i=0;$i<sizeof($data);$i++){
            $yyyy[] = $data[$i]['YYYY'];
            $mm[] = $data[$i]['YYYY'].'-'.$data[$i]['MM'];
            $amount[] = $data[$i]['AMOUNT'];
        }
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            'sort'=>[
                'attributes'=>['YYYY','MM','AMOUNT']
            ],
        ]);

        */
       return $this->render('regipd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,'date1'=>$date1,'date2'=>$date2,
                   

       ]);   
   }
   public function actionAdmit_list($MM) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];

     $sql= "SELECT VISIT_ID,HN, CID,ADM_ID, ADM_DT , DSC_DT,UNIT_NAME,P_DIAG ,ADJRW
            FROM mb_ipdreg
            WHERE  ADM_DT BETWEEN '$date1' AND '$date2'
            AND UNIT_ID = 22 AND $MM = MM" ;
                
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db2\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => FALSE,
    ]);
    return $this->render('admit_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
    ]);
  }
   public function actionOutcome(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT DISTINCT YEAR(BDATE) AS YYYY, MONTH(BDATE) AS MM ,CID_BABY, COUNT(DISTINCT CID_BABY) AS AMOUNT
                FROM mb_nbb
                WHERE  BDATE BETWEEN  '$date1' AND '$date2'
                GROUP BY YYYY,MM ";
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
       return $this->render('outcome', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
       
   }
   public function actionOutcome_list($MM) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];

     $sql= "SELECT CID_BABY,HN,FNAME,LNAME,SEX,CID_MOM,BDATE,GA,GRAVIDA,BWEIGHT
            FROM mb_nbb where BDATE BETWEEN '$date1' AND '$date2'
            AND $MM = MM" ;
                
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db2\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => FALSE,
    ]);
    return $this->render('outcome_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
    ]);
  }
}
