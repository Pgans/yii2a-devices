<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;

class DeathsController extends \yii\web\Controller
{ 
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['death_all','deathipd','persondisc'],
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
    public function actionDeath_all(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.CID,b.HN, a.DEATH_DATE, a.DEATH_DT,a.STAFF_ID , a.AN, a.CDEATH,a.CDEATH_A,a.CDEATH_B,a.CDEATH_C,a.CDEATH_D
FROM deaths a, cid_hn b
WHERE  a.cid = b.cid
AND a.is_cancel = 0
AND a.CID = b.CID
AND a.IS_HOSP = 1
AND a.CDEATH_A != ' '
AND a.DEATH_DT BETWEEN '$date1' AND  '$date2' GROUP BY a.CID ORDER BY a.DEATH_DT";
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
       return $this->render('deathall', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
   public function actionDeathipd() {
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
     
      $sql = "SELECT  K.WARD_NO , K.UNIT_NAME, COUNT( K.UNIT_NAME) AS AMOUNT
FROM (
SELECT DISTINCT a.VISIT_ID,c.HN , a.ADM_ID AS AN, DATE_FORMAT(a.ADM_DT,'%Y-%m-%d') AS 'ADMIT', DATE_FORMAT(a.DSC_DT,'%Y-%m-%d') AS 'DSC' ,f.DEATH_DATE, b.BIRTHDATE,
b.FNAME, b.LNAME,b.SEX,a.DSC_STATUS,a.DSC_TYPE,a.WARD_NO,g.UNIT_NAME,i.ICD10_TM, i.ICD_NAME
FROM ipd_reg a, population b, cid_hn c,opd_visits e,deaths f,service_units g,opd_diagnosis h, icd10new i
WHERE a.DSC_DT BETWEEN '$date1'  AND '$date2'
AND a.IS_CANCEL = 0
AND a.DSC_STATUS > 7
AND b.CID = c.CID
AND a.VISIT_ID = e.VISIT_ID
AND e.HN = c.HN
AND f.CID = c.CID
AND a.WARD_NO = g.UNIT_ID
AND e.VISIT_ID = h.VISIT_ID
AND h.ICD10 = i.ICD10
GROUP BY a.VISIT_ID) AS K   GROUP BY K.UNIT_NAME ";
                    
     $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

        //print_r($rawData);
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
        return $this->render('deathipd', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' =>$date1,
                    'date2' =>$date2,

        ]);
    }
    public function actionDeathipd_list($wardno) {
    
       $date1 = Yii::$app->session['date1'];
       $date2 = Yii::$app->session['date2'];
      
     $sql= "SELECT DISTINCT a.VISIT_ID,c.HN , a.ADM_ID AS AN, DATE_FORMAT(a.ADM_DT,'%Y-%m-%d') AS 'ADMIT', DATE_FORMAT(a.DSC_DT,'%Y-%m-%d') AS 'DSC' ,
b.FNAME, b.LNAME,b.SEX,a.WARD_NO,g.UNIT_NAME,i.ICD10_TM, i.ICD_NAME
FROM ipd_reg a, population b, cid_hn c,opd_visits e,deaths f,service_units g,opd_diagnosis h, icd10new i
WHERE a.DSC_DT BETWEEN '$date1'  AND '$date2'
AND a.IS_CANCEL = 0
AND a.DSC_STATUS > 7
AND b.CID = c.CID
AND a.VISIT_ID = e.VISIT_ID
AND e.HN = c.HN
AND f.CID = c.CID
AND a.WARD_NO= g.UNIT_ID
AND a.WARD_NO = $wardno
AND e.VISIT_ID = h.VISIT_ID
AND h.ICD10 = i.ICD10
GROUP BY a.VISIT_ID ";
    
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        // print_r($rawData);
    } catch (\yii\db2\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => FALSE,
    ]);
    return $this->render('deathipd_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1, 
                'date2'=>$date2,
    ]);
  }
   public function actionDeathdx59() {
        $data = Yii::$app->request->post();
        $date1 =isset($data['date1'])  ? $data['date1'] : '';
        $date2 =isset($data['date2'])  ? $data['date2'] : '';
     
      $sql = "SELECT CDEATH ,CDEATH_A,COUNT(CDEATH) AS TOTAL FROM  deaths
WHERE  is_hosp = 1 AND DEATH_DATE BETWEEN '$date1' AND '$date2' GROUP BY CDEATH ORDER BY TOTAL DESC";
       $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

        //print_r($rawData);
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
        return $this->render('deathdx59',[
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
            'date1'=>$date1,
            'date2'=>$date2
            
        ]);
    }
    public function actionDeath_list($cdeath){
        $date1 =Yii::$app->session['date1'];
        $date2 =Yii::$app->session['date2'];
     $sql= "SELECT CID,DEATH_DATE, DEATH_DT,STAFF_ID,AN, CDEATH, CDEATH_A, CDEATH_B, CDEATH_C,IS_HOSP
     FROM deaths WHERE CDEATH = '$cdeath' AND is_hosp = 1
     AND DEATH_DATE BETWEEN'$date1' AND '$date2'";
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
    return $this->render('death_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
  }
  public function actionPersondisc() {
        $data = Yii::$app->request->post();
        $date1 =isset($data['date1'])  ? $data['date1'] : '';
        $date2 =isset($data['date2'])  ? $data['date2'] : '';
     
      $sql = "SELECT a.PID , a.CID,b.DDEATH, a.NAME , a.LNAME, a.DISCHARGE
                FROM person a, death b
                WHERE a.PID = b.PID
                AND a.DISCHARGE =9
                AND b.DDEATH BETWEEN '$date1' AND '$date2'
                GROUP BY a.CID,a.PID ORDER BY b.DDEATH";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

        //print_r($rawData);
        try {
            $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
        } catch (\yii\db2\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
            Yii::$app->session['date1'] = $date1;
            Yii::$app->session['date2'] = $date2;
        return $this->render('persondisc',[
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
            'date1'=>$date1,
            'date2'=>$date2
            
        ]);
    }
}
