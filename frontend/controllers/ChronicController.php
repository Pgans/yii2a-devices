<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;


class ChronicController extends \yii\web\Controller
{
  public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['asthma','copd','dm','ht','capd'],
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
    public function actionAsthma(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT DISTINCT cid_hn.HN
GROUP BY opd_visits.HN ORDER BY opd_visits.REG_DATETIME,icd10new.ICD10";
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
       return $this->render('asthma', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionAsthma_list(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT DISTINCT cid_hn.HN
GROUP BY opd_visits.HN ORDER BY opd_visits.REG_DATETIME,icd10new.ICD10";
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
       return $this->render('asthma_list', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionCopd(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.HN, a.REGDATE, a.FNAME,a.LNAME,a.SEX,a.AGE, a.ICD10_TM, a.UNIT_NAME,a.HOME_ADR,
                b.TOWN_NAME AS 'MOOBAN', c.TOWN_NAME AS 'TUMBOL', d.TOWN_NAME AS 'AUMPUR', e.TOWN_NAME AS 'JUNGWAT'
                FROM mb_dxopd a, towns b, towns c, towns d,towns e
                WHERE a.REGDATE BETWEEN '$date1' AND '$date2'
                AND LOCATE('J44',a.ICD10_TM)>0
                AND a.UNIT_REG = '12'
                AND a.TOWN_ID = b.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,6),'00')= c.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,4),'0000') = d.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,2),'000000') = e.TOWN_ID
                GROUP BY a.HN ORDER BY REGDATE";
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
       return $this->render('copd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionDm(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.HN, a.REGDATE, a.FNAME,a.LNAME,a.SEX,a.AGE, a.ICD10_TM, a.UNIT_NAME,a.HOME_ADR,
                b.TOWN_NAME AS 'MOOBAN', c.TOWN_NAME AS 'TUMBOL', d.TOWN_NAME AS 'AUMPUR', e.TOWN_NAME AS 'JUNGWAT'
                FROM mb_dxopd a, towns b, towns c, towns d,towns e
                WHERE a.REGDATE BETWEEN '$date1' AND '$date2'
                AND LOCATE('E1',a.ICD10_TM)>0
                AND a.UNIT_REG = '15'
                AND a.TOWN_ID = b.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,6),'00')= c.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,4),'0000') = d.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,2),'000000') = e.TOWN_ID
                GROUP BY a.HN ORDER BY REGDATE";
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
       return $this->render('dm', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionHt(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.HN, a.REGDATE, a.FNAME,a.LNAME,a.SEX,a.AGE, a.ICD10_TM, a.UNIT_NAME,a.HOME_ADR,
                b.TOWN_NAME AS 'MOOBAN', c.TOWN_NAME AS 'TUMBOL', d.TOWN_NAME AS 'AUMPUR', e.TOWN_NAME AS 'JUNGWAT'
                FROM mb_dxopd a, towns b, towns c, towns d,towns e
                WHERE a.REGDATE BETWEEN '$date1' AND '$date2'
                AND LOCATE('I',a.ICD10_TM)>0
                AND a.UNIT_REG = '16'
                AND a.TOWN_ID = b.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,6),'00')= c.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,4),'0000') = d.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,2),'000000') = e.TOWN_ID
                GROUP BY a.HN ORDER BY REGDATE";
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
       return $this->render('ht', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }

   public function actionThyroid(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.HN, a.REGDATE, a.FNAME,a.LNAME,a.SEX,a.AGE, a.ICD10_TM, a.UNIT_NAME,a.HOME_ADR,
                b.TOWN_NAME AS 'MOOBAN', c.TOWN_NAME AS 'TUMBOL', d.TOWN_NAME AS 'AUMPUR', e.TOWN_NAME AS 'JUNGWAT'
                FROM mb_dxopd a, towns b, towns c, towns d,towns e
                WHERE a.REGDATE BETWEEN '$date1' AND '$date2'
                AND a.ICD10_TM BETWEEN 'E050' AND 'E059'
                AND a.UNIT_REG = '14'
                AND a.TOWN_ID = b.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,6),'00')= c.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,4),'0000') = d.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,2),'000000') = e.TOWN_ID
                GROUP BY a.HN ORDER BY REGDATE";
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
       return $this->render('thyroid', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionCapd(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.HN, a.REGDATE, a.FNAME,a.LNAME,a.SEX,a.AGE, a.ICD10_TM, a.UNIT_NAME,a.HOME_ADR,
                b.TOWN_NAME AS 'MOOBAN', c.TOWN_NAME AS 'TUMBOL', d.TOWN_NAME AS 'AUMPUR', e.TOWN_NAME AS 'JUNGWAT'
                FROM mb_dxopd a, towns b, towns c, towns d,towns e
                WHERE a.REGDATE BETWEEN '$date1' AND '$date2'
                AND a.ICD10_TM BETWEEN 'N181' AND 'N189'
                AND a.UNIT_REG = '34'
                AND a.TOWN_ID = b.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,6),'00')= c.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,4),'0000') = d.TOWN_ID
                AND CONCAT(LEFT(a.TOWN_ID,2),'000000') = e.TOWN_ID
                GROUP BY a.HN ORDER BY REGDATE";
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
       return $this->render('capd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
   public function actionCa(){
    $data = Yii::$app->request->post();
    $date1 = isset($data['date1']) ? $data['date1'] : '';
    $date2 = isset($data['date2']) ? $data['date2'] : '';

$sql = "SELECT date(a.REG_DATETIME) as REGDATE, p.CID, a.HN, p.FNAME, p.LNAME,
CASE
	WHEN p.SEX = 1 THEN 'ชาย'
	WHEN p.SEX = 2 THEN 'หญิง'
END as SEX, p.BIRTHDATE, FLOOR(DATEDIFF(NOW(),p.BIRTHDATE)/365.25) as AGE, c.ICD10_TM,p.TOWN_ID
FROM opd_visits a
INNER JOIN opd_diagnosis b ON a.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0
INNER JOIN icd10new c ON b.ICD10 = c.ICD10 AND c.ICD10_TM  BETWEEN 'C00' AND 'D48'
INNER JOIN cid_hn d ON a.HN = d.HN
INNER JOIN population p ON d.CID = p.CID
WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
AND a.IS_CANCEL =0
GROUP BY p.CID ";
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
return $this->render('ca', [
           'dataProvider' => $dataProvider,
           'sql'=>$sql,
           'date1'=>$date1,
           'date2'=>$date2,

]);   
}
public function actionSura(){
    $data = Yii::$app->request->post();
    $date1 = isset($data['date1']) ? $data['date1'] : '';
    $date2 = isset($data['date2']) ? $data['date2'] : '';

$sql = "SELECT  MONTH(a.reg_datetime) as month2562 ,
COUNT(CASE WHEN(b.ppspecial in ( '1B601','1B602', '1B603','1B604', '1B609', '1B6010', '1B611', '1B612')) THEN '1' END) AS 'TOTAL' ,
COUNT(CASE WHEN (b.ppspecial= '1B600') THEN '2' END) AS  '1B600',
COUNT(CASE WHEN(b.ppspecial = '1B601') THEN '3' END) AS '1B601' ,
COUNT(CASE WHEN(b.ppspecial = '1B602') THEN '4' END) AS '1B602' ,
COUNT(CASE WHEN(b.ppspecial = '1B603') THEN '5' END) AS '1B603' ,
COUNT(CASE WHEN(b.ppspecial= '1B604') THEN '6' END) AS '1B604' ,
COUNT(CASE WHEN(b.ppspecial = '1B609') THEN '7' END) AS '1B609' ,
COUNT(CASE WHEN(b.ppspecial = '1B610') THEN '8' END) AS '1B610' ,
COUNT(CASE WHEN(b.ppspecial = '1B611') THEN '9' END) AS '1B611' ,
COUNT(CASE WHEN(b.ppspecial = '1B612') THEN '10' END) AS '1B612' 

FROM  opd_visits a
INNER JOIN specialpp b ON a.visit_id = b.visit_id and b.is_cancel = 0
WHERE a.reg_datetime  BETWEEN '$date1' AND '$date2'
AND a.is_cancel = 0
GROUP BY month2562 ";
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
return $this->render('sura', [
           'dataProvider' => $dataProvider,
           'sql'=>$sql,
           'date1'=>$date1,
           'date2'=>$date2,

]);   
}   
}
