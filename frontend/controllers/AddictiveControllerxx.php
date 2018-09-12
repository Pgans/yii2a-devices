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

    $sql = "SELECT   c.icd10_tm ,c.icd_name, COUNT(DISTINCT a.HN ) as amount
    FROM  opd_visits a
    INNER JOIN opd_diagnosis b ON a.visit_id = b.visit_id AND b.is_cancel = 0
    INNER JOIN icd10new c ON b.icd10 = c.icd10 AND c.icd10_tm BETWEEN 'F320' AND 'F329'
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
    AND a.is_cancel = 0
    GROUP BY c.icd10_tm";
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
   return $this->render('depress', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,

   ]);   
}
public function actionDepress_list($code){
    $data = Yii::$app->request->post();
       $date1 = Yii::$app->session['date1'];
       $date2 = Yii::$app->session['date2'];
        
        $sql = "SELECT DISTINCT a.REG_DATETIME , a.VISIT_ID,  a.HN, e.FNAME, e.LNAME,
    CASE
    WHEN e.SEX = 1 THEN 'ชาย'
    WHEN e.SEX = 2 THEN 'หญิง'
    END AS SEX, floor(DATEDIFF(a.REG_DATETIME,e.BIRTHDATE)/365.25) AS AGE,c.ICD10_TM
    FROM  opd_visits a
    INNER JOIN opd_diagnosis b ON a.visit_id = b.visit_id AND b.is_cancel = 0
    INNER JOIN icd10new c ON b.icd10 = c.icd10 AND c.icd10_tm ='$code'
    INNER JOIN cid_hn d ON a.hn = d.hn 
    INNER JOIN population e ON d.cid = e.cid 
    WHERE a.REG_DATETIME BETWEEN '$date1'  AND '$date2'
    AND a.is_cancel = 0
    GROUP BY a.VISIT_ID ORDER BY a.VISIT_ID";
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
  // Yii::$app->session['date1'] = $date1;
  // Yii::$app->session['date2'] = $date2;
   return $this->render('depress_list', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,

   ]);   
    }
}

