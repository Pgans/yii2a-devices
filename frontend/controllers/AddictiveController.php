<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;

class AddictiveController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['asth'],
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
    public function actionMental(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  a.CID , a.FNAME, a.LNAME,
        CASE 
        WHEN a.SEX = 1 THEN 'ชาย'
        WHEN a.SEX = 2 THEN 'หญิง'
        END AS SEX, 
        floor(DATEDIFF(NOW(),a.BIRTHDATE)/365.25) AS AGE,
        e.ICD10_TM, a.HOME_ADR AS 'HOME', f.TOWN_NAME AS 'MOOBAN',g.town_name AS 'TUMBON', h.town_name AS 'AMPOR'
        FROM population a 
        INNER JOIN cid_hn b ON a.cid = b.cid
        INNER JOIN opd_visits c  ON b.hn = c.hn
        INNER JOIN opd_diagnosis d ON c.visit_id = d.visit_id AND d.is_cancel =0
        INNER JOIN icd10new e ON d.icd10 = e.icd10 AND (e.icd10_tm BETWEEN 'F11' AND 'F16' OR e.icd10_tm BETWEEN 'F18' AND 'F19')
        INNER JOIN towns f ON a.town_id = f.town_id 
        INNER JOIN towns g ON CONCAT(LEFT(a.town_id,6),'00')= g.TOWN_ID
        INNER JOIN towns h ON CONCAT(LEFT(a.town_id,4),'0000')= h.TOWN_ID
        WHERE  c.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND c.is_cancel = 0
        AND a.cid NOT IN (SELECT cid FROM deaths)
        GROUP BY c.HN ";
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
       return $this->render('mental', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);
    }
      
    public function actionDepress(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
     
      $sql = "SELECT  a.icd10_tm  , b.icd_name, COUNT(a.HN) AS amount
      FROM mb_addictive a
      INNER JOIN icd10new b ON a.ICD10_TM = b.ICD10_TM
      WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
      GROUP BY a.ICD10_TM ";
                    
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
        return $this->render('depress', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' =>$date1,
                    'date2' =>$date2,

        ]);
    }
    public function actionDepress_list($code) {
    
       $date1 = Yii::$app->session['date1'];
       $date2 = Yii::$app->session['date2'];
      
       $sql = "SELECT *
       FROM mb_addictive
       WHERE REG_DATETIME BETWEEN '$date1' AND '$date2'
       AND ICD10_TM ='$code'";
    
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
    return $this->render('depress_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
    
    ]);
  }
  public function actionSpecailpp(){
      $data = Yii::$app->request->post();
        $townid = isset($data['townid']) ? $data['townid'] : 'null';
 
  $sql = "SELECT a.CID ,b.HN, CONCAT(trim(a.FNAME),'   ',trim(a.LNAME)) as FULLNAME,
  CASE 
      WHEN a.SEX=1 THEN 'ชาย'
      WHEN a.SEX=2 THEN 'หญิง'
  END as SEX, a.BIRTHDATE ,
	TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE()) as CNT_YEAR,
	TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) as CNT_MONTH,
	TIMESTAMPDIFF(DAY,DATE_ADD(a.BIRTHDATE,INTERVAL (TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())) month),curdate()) as CNT_DAY,
  c.TOWN_NAME AS 'MOOBAN', d.TOWN_NAME AS 'TUMBON', e.TOWN_NAME as 'AMPUR'
  FROM population a
  INNER JOIN cid_hn b ON a.CID = b.CID
  INNER JOIN towns c ON a.TOWN_ID = c.TOWN_ID
  INNER JOIN towns d ON CONCAT(left(a.town_id,6),'00') = d.town_id
  INNER JOIN towns e ON CONCAT(left(a.town_id,4),'0000') = e.TOWN_ID
  WHERE TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())= 0
	AND TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) = 8
    AND left(a.TOWN_ID,6)=$townid ";
                
 $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

    Yii::$app->session['townid']=$townid;
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db2\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => FALSE,
    ]);
    
    return $this->render('specailpp', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'townid'=>$townid,
                

     ]);
    }
    public function actionSpecailpp18(){
        $townid = Yii::$app->session['townid'];
    $sql = "SELECT a.CID ,b.HN, CONCAT(trim(a.FNAME),'   ',trim(a.LNAME)) as FULLNAME,
    CASE 
        WHEN a.SEX=1 THEN 'ชาย'
        WHEN a.SEX=2 THEN 'หญิง'
    END as SEX, a.BIRTHDATE ,
      TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE()) as CNT_YEAR,
      TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) as CNT_MONTH,
      TIMESTAMPDIFF(DAY,DATE_ADD(a.BIRTHDATE,INTERVAL (TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())) month),curdate()) as CNT_DAY,
    c.TOWN_NAME AS 'MOOBAN', d.TOWN_NAME AS 'TUMBON', e.TOWN_NAME as 'AMPUR'
    FROM population a
    INNER JOIN cid_hn b ON a.CID = b.CID
    INNER JOIN towns c ON a.TOWN_ID = c.TOWN_ID
    INNER JOIN towns d ON CONCAT(left(a.town_id,6),'00') = d.town_id
    INNER JOIN towns e ON CONCAT(left(a.town_id,4),'0000') = e.TOWN_ID
    WHERE TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())= 1
      AND TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) = 6
      AND left(a.TOWN_ID,6)=$townid ";
                  
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
      
      return $this->render('specailpp18', [
                  'dataProvider' => $dataProvider,
                  'sql'=>$sql,
                  'townid'=>$townid,              
      ]);
  }
  public function actionSpecailpp30(){
    $townid = Yii::$app->session['townid'];
$sql = "SELECT a.CID ,b.HN, CONCAT(trim(a.FNAME),'   ',trim(a.LNAME)) as FULLNAME,
CASE 
    WHEN a.SEX=1 THEN 'ชาย'
    WHEN a.SEX=2 THEN 'หญิง'
END as SEX, a.BIRTHDATE ,
  TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE()) as CNT_YEAR,
  TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) as CNT_MONTH,
  TIMESTAMPDIFF(DAY,DATE_ADD(a.BIRTHDATE,INTERVAL (TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())) month),curdate()) as CNT_DAY,
c.TOWN_NAME AS 'MOOBAN', d.TOWN_NAME AS 'TUMBON', e.TOWN_NAME as 'AMPUR'
FROM population a
INNER JOIN cid_hn b ON a.CID = b.CID
INNER JOIN towns c ON a.TOWN_ID = c.TOWN_ID
INNER JOIN towns d ON CONCAT(left(a.town_id,6),'00') = d.town_id
INNER JOIN towns e ON CONCAT(left(a.town_id,4),'0000') = e.TOWN_ID
WHERE TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())= 2
  AND TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) = 6
  AND left(a.TOWN_ID,6)=$townid ";
              
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
  
  return $this->render('specailpp30', [
              'dataProvider' => $dataProvider,
              'sql'=>$sql,
              'townid'=>$townid,              
  ]);
 }
 public function actionSpecailpp42(){
    $townid = Yii::$app->session['townid'];
$sql = "SELECT a.CID ,b.HN, CONCAT(trim(a.FNAME),'   ',trim(a.LNAME)) as FULLNAME,
CASE 
    WHEN a.SEX=1 THEN 'ชาย'
    WHEN a.SEX=2 THEN 'หญิง'
END as SEX, a.BIRTHDATE ,
  TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE()) as CNT_YEAR,
  TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) as CNT_MONTH,
  TIMESTAMPDIFF(DAY,DATE_ADD(a.BIRTHDATE,INTERVAL (TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())) month),curdate()) as CNT_DAY,
c.TOWN_NAME AS 'MOOBAN', d.TOWN_NAME AS 'TUMBON', e.TOWN_NAME as 'AMPUR'
FROM population a
INNER JOIN cid_hn b ON a.CID = b.CID
INNER JOIN towns c ON a.TOWN_ID = c.TOWN_ID
INNER JOIN towns d ON CONCAT(left(a.town_id,6),'00') = d.town_id
INNER JOIN towns e ON CONCAT(left(a.town_id,4),'0000') = e.TOWN_ID
WHERE TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())= 3
  AND TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) = 6
  AND left(a.TOWN_ID,6)=$townid ";
              
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
  
  return $this->render('specailpp42', [
              'dataProvider' => $dataProvider,
              'sql'=>$sql,
              'townid'=>$townid,              
     ]);
    }
    public function actionSpecailpp60(){
        $townid = Yii::$app->session['townid'];
    $sql = "SELECT a.CID ,b.HN, CONCAT(trim(a.FNAME),'   ',trim(a.LNAME)) as FULLNAME,
    CASE 
        WHEN a.SEX=1 THEN 'ชาย'
        WHEN a.SEX=2 THEN 'หญิง'
    END as SEX, a.BIRTHDATE ,
      TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE()) as CNT_YEAR,
      TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) as CNT_MONTH,
      TIMESTAMPDIFF(DAY,DATE_ADD(a.BIRTHDATE,INTERVAL (TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())) month),curdate()) as CNT_DAY,
    c.TOWN_NAME AS 'MOOBAN', d.TOWN_NAME AS 'TUMBON', e.TOWN_NAME as 'AMPUR'
    FROM population a
    INNER JOIN cid_hn b ON a.CID = b.CID
    INNER JOIN towns c ON a.TOWN_ID = c.TOWN_ID
    INNER JOIN towns d ON CONCAT(left(a.town_id,6),'00') = d.town_id
    INNER JOIN towns e ON CONCAT(left(a.town_id,4),'0000') = e.TOWN_ID
    WHERE TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())= 5
      AND TIMESTAMPDIFF(MONTH,a.BIRTHDATE,CURDATE())-(TIMESTAMPDIFF(YEAR,a.BIRTHDATE,CURDATE())*12) = 0
      AND left(a.TOWN_ID,6)=$townid ";
                  
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
      
      return $this->render('specailpp60', [
                  'dataProvider' => $dataProvider,
                  'sql'=>$sql,
                  'townid'=>$townid,              
      ]);
    }
}

