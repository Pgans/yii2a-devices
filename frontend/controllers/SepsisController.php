<?php

namespace frontend\controllers;
use yii;
use yii\data\ArrayDataProvider;


class SepsisController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionSepsis(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

    $sql = "SELECT a.REG_DATETIME ,a.VISIT_ID, a.HN ,c.CID ,CONCAT(trim(c.FNAME),'  ' ,c.LNAME) as FULLNAME,FLOOR(DATEDIFF(NOW(),c.BIRTHDATE)/365.25) as AGE,
    CASE 
        WHEN c.SEX = 1 THEN 'ชาย'
        WHEN c.SEX = 2 THEN 'หญิง'
    END as 'SEX',
     i.ICD10_TM, d.DXT_ID
     FROM opd_visits a
     INNER JOIN cid_hn b ON a.HN = b.HN
    INNER JOIN population c ON b.CID = c.CID
    INNER JOIN opd_diagnosis d ON a.VISIT_ID = d.VISIT_ID AND d.IS_CANCEL =0 AND d.DXT_ID in (1,2)
    INNER JOIN icd10new i ON d.ICD10 = i.ICD10 AND (i.ICD10_TM = 'R611' OR i.ICD10_TM = 'R572')
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
    GROUP BY a.HN ";

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
       'pagination' => [
        'pagesize'=> 10
    ],
   ]);

   return $this->render('sepsis', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,

   ]);   
 }
 
 public function actionRefersepsis(){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT a.VISIT_ID, a.HN ,c.CID ,CONCAT(trim(c.FNAME),'  ' ,c.LNAME) as FULLNAME,FLOOR(DATEDIFF(NOW(),c.BIRTHDATE)/365.25) as AGE,
    CASE 
        WHEN c.SEX = 1 THEN 'ชาย'
        WHEN c.SEX = 2 THEN 'หญิง'
    END as 'SEX',
     i.ICD10_TM, d.DXT_ID,r.HOSP_ID as REFER
     FROM opd_visits a
     INNER JOIN cid_hn b ON a.HN = b.HN
    INNER JOIN population c ON b.CID = c.CID
    INNER JOIN opd_diagnosis d ON a.VISIT_ID = d.VISIT_ID AND d.IS_CANCEL =0 
    INNER JOIN icd10new i ON d.ICD10 = i.ICD10 AND (i.ICD10_TM = 'R617' OR i.ICD10_TM = 'R572')
    INNER JOIN refers r ON a.VISIT_ID = r.VISIT_ID AND r.IS_CANCEL=0
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 10
    ],
]);
return $this->render('refer_sepsis', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
            'date1'=>$date1,
            'date2' =>$date2,

    ]);
  } 
  public function actionDeadsepsis(){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT de.DEATH_DATE ,a.VISIT_ID, a.HN ,c.CID ,CONCAT(trim(c.FNAME),'  ' ,c.LNAME) as FULLNAME,FLOOR(DATEDIFF(NOW(),c.BIRTHDATE)/365.25) as AGE,
    CASE 
        WHEN c.SEX = 1 THEN 'ชาย'
        WHEN c.SEX = 2 THEN 'หญิง'
    END as 'SEX',
     i.ICD10_TM, d.DXT_ID
     FROM opd_visits a
     INNER JOIN cid_hn b ON a.HN = b.HN
    INNER JOIN population c ON b.CID = c.CID
    INNER JOIN opd_diagnosis d ON a.VISIT_ID = d.VISIT_ID AND d.IS_CANCEL =0 AND d.DXT_ID 
    INNER JOIN icd10new i ON d.ICD10 = i.ICD10 AND i.ICD10_TM  in ('R611' ,'R572')
    INNER JOIN deaths de ON c.CID = de.CID
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 10
    ],
]);
return $this->render('dead_sepsis', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
            'date1'=>$date1,
            'date2' =>$date2,

    ]);
  } 
}
