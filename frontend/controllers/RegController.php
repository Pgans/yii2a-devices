<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;
use frontend\models\MbIpdreg;
use frontend\controllers\ArrayDataProvider;


class RegController extends \yii\web\Controller
{ 
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['regipd','register','deathipd','outstan'],
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
    public function actionRegipd(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT YEAR(DSC_DT) AS YYYY, MONTH(DSC_DT) AS MM, UNIT_NAME , COUNT(CID) AS AMOUNT
                FROM mb_ipdreg
                WHERE ADM_DT BETWEEN '$date1' AND '$date2' GROUP BY YYYY,MM,UNIT_ID";
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
       return $this->render('regipd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
       
   }
   public function actionRegipd_list($MM,$unitname) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];

     $sql= "SELECT VISIT_ID,HN, CID,ADM_ID, ADM_DT , DSC_DT,UNIT_NAME,P_DIAG ,ADJRW
            FROM mb_ipdreg
            WHERE  ADM_DT BETWEEN '$date1' AND '$date2' AND MM = $MM 
            AND UNIT_NAME = '$unitname'";
                
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
    return $this->render('regipd_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
    ]);
  }
  public function actionRegister(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT DISTINCT UNIT_REG, UNIT_NAME, COUNT(UNIT_REG) AS 'AMOUNT'
                FROM mb_dxopd WHERE REGDATE BETWEEN '$date1' AND '$date2'
                GROUP BY UNIT_NAME ORDER BY AMOUNT DESC";
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
       return $this->render('register', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
       
   }
   public function actionDep_list($unit_id) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];

     $sql= "SELECT a.HN, a.REGDATE, a.FNAME,a.LNAME,a.SEX,a.AGE, a.ICD10_TM, a.UNIT_NAME,a.HOME_ADR,
            b.TOWN_NAME AS 'MOOBAN', c.TOWN_NAME AS 'TUMBOL'
            FROM mb_dxopd a, towns b, towns c, towns d,towns e
            WHERE a.REGDATE BETWEEN '$date1' AND '$date2'
            AND a.UNIT_REG = '$unit_id'
            AND a.TOWN_ID= b.TOWN_ID
            AND CONCAT(LEFT(a.TOWN_ID,6),'00')= c.TOWN_ID
            AND CONCAT(LEFT(a.TOWN_ID,4),'0000') = d.TOWN_ID
            AND CONCAT(LEFT(a.TOWN_ID,2),'000000') = e.TOWN_ID";
                
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
    return $this->render('dep_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
    ]);
  }
  public function actionOutstan(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT UNIT_ID,UNIT_NAME, COUNT(UNIT_ID) AS amount
FROM mb_outstan  WHERE mu_date BETWEEN '$date1' AND '$date2'
GROUP BY UNIT_NAME ORDER BY amount";
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
       return $this->render('outstan', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionOutstan_list($mudate){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_outstan
            WHERE mu_date = $mudate AND mu_date BETWEEN '$date1' AND '$date2' GROUP BY VISIT_ID";
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
        return $this->render('outstan_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
     public function actionDepregipd(){
        $data = Yii::$app->request->post();
        $unitid = isset($data['unitid']) ? $data['unitid'] : 'null';
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';


        $sql = "SELECT *
                FROM mb_ipdreg
                WHERE ADM_DT BETWEEN '$date1' AND '$date2' 
                AND UNIT_ID = $unitid GROUP BY ADM_ID";

       $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      // Yii::$app->session['unitname'] = $unitname;
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
    
       return $this->render('dep_regipd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2' =>$date2,
                   'unitid' =>$unitid,
                  
       ]);
       
   }
   public function actionRfgraph(){
        $connection = Yii::$app->db2;
        $data = $connection->createCommand('
            SELECT year(t.DSC_DT) as yy,
            month(t.DSC_DT) as mm,
            COUNT(t.ADM_ID) as cnt
            FROM ipd_reg t
            GROUP BY yy,mm
            ORDER BY yy,mm
            ')->queryAll();
        //เตรียมข้อมูลส่งให้กราฟ
        for($i=0;$i<sizeof($data);$i++){
            $yy[] = $data[$i]['yy'];
            $mm[] = $data[$i]['yy'].'-'.$data[$i]['mm'];
            $cnt[] = intval($data[$i]['cnt']);
        }
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            'sort'=>[
                'attributes'=>['yy','mm','cnt']
            ],
        ]);
        return $this->render('rfgraph',[
            'dataProvider'=>$dataProvider,
            'yy'=>$yy,'mm'=>$mm,'cnt'=>$cnt,
        ]);
    }
}

