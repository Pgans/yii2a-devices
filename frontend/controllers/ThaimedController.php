<?php

namespace frontend\controllers;
use yii;
use yii\data\ArrayDataProvider;

class ThaimedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionOperation() {
        $data = Yii::$app->request->post();
        $date1 =isset($data['date1'])  ? $data['date1'] : '';
        $date2 =isset($data['date2'])  ? $data['date2'] : '';

      $sql = "SELECT date(a.REG_DATETIME), 
      COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'ฝังเข็ม', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
      COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
      COUNT(CODE) AS Total 
    FROM mb_opd_operations a
    WHERE  DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
	AND a.CGD_ID = 15 AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
   GROUP BY DATE(a.REG_DATETIME) ORDER BY DATE(a.REG_DATETIME)";

     $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

        //print_r($rawData);
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db2\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => [
                'pagesize' => 15
            ],
        ]);
        Yii::$app->session['date1'] =$date1;
        Yii::$app->session['date2'] =$date2;
        return $this->render('operation', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,

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
        return $this->render('outstan_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
     public function actionCormore(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT * FROM mb_common_cold WHERE REG_DATETIME BETWEEN '$date1' AND '$date2'";

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
       return $this->render('cormore', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
     }
     public function actionSmonpri_replace(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT month(a.REG_DATETIME) AS month, 
        COUNT(CASE WHEN(c.DRUG_ID = '0262') THEN '1' END) AS 'ฟ้าทะลายโจร' ,
        COUNT(CASE WHEN(c.DRUG_ID = '0263') THEN '2' END) AS 'ขมิ้นชัน',
        COUNT(CASE WHEN(c.DRUG_ID = '2280') THEN '3' END) AS 'แก้ไอมะขาม',
        COUNT(CASE WHEN(c.DRUG_ID = '0266') THEN '4' END) AS 'น้ำมันไพล',
        COUNT(CASE WHEN(c.DRUG_ID = '0261') THEN '5' END) AS 'เพชรสังฆาต',
        COUNT(CASE WHEN(c.DRUG_ID = '2359') THEN '6' END) AS 'ยาเขียวหอม',
        COUNT(CASE WHEN(c.DRUG_ID IN (0262,0263,2280,0266,0261,2359) ) THEN '7' END) AS 'รวม'
        FROM opd_visits a, prescriptions b, drugs c
        WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND a.VISIT_ID = b.VISIT_ID
        AND a.IS_CANCEL =0
        AND b.DRUG_ID = c.DRUG_ID
        AND a.VISIT_ID NOT IN (SELECT VISIT_ID FROM ipd_reg)
        GROUP BY month";

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
       return $this->render('smonpri_replace', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
     }
        public function actionOperation_month(){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        $sql = "SELECT MONTH(REG_DATETIME)AS MONTH, 
      COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'ฝังเข็ม', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
      COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
      COUNT(CODE) AS Total  
        FROM mb_opd_operations 
        WHERE REG_DATETIME BETWEEN  '$date1' AND '$date2'
        AND VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
        GROUP BY MONTH(REG_DATETIME) ORDER BY MONTH(REG_DATETIME)";

       $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $iidataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => [
               'pagesize'=> 15
           ],
       ]);
       $sql = "SELECT MONTH(REG_DATETIME)AS MONTH, 
      COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'ฝังเข็ม', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
      COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
      COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
      COUNT(CODE) AS Total  
        FROM mb_opd_operations 
        WHERE REG_DATETIME BETWEEN  '$date1' AND '$date2'
        AND VISIT_ID in (SELECT VISIT_ID FROM mobile_visits)
        GROUP BY MONTH(REG_DATETIME) ORDER BY MONTH(REG_DATETIME)";
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       $oodataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => [
               'pagesize'=> 15
           ],
       ]);
       return $this->render(operation_monthlist, [
                   'imonthData' => $iidataProvider,
                   'omonthData' => $oodataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
     }
     public function actionStaff_operation(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

    $sql = "SELECT a.STAFF_ID,CONCAT(c.FNAME,'',TRIM(c.LNAME))AS Provider,
    COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'ฝังเข็ม', 
    COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
    COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
    COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
    COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
    COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
    COUNT(CODE) AS Total 
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.STAFF_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
    AND a.CGD_ID = 15
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    GROUP BY a.STAFF_ID ORDER BY a.STAFF_ID";
   $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

  // print_r($rawData);
   try {
       $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
   } catch (\yii\db\Exception $e) {
       throw new \yii\web\ConflictHttpException('sql error');
   }
   Yii::$app->session['date1']=$date1;
   Yii::$app->session['date2']=$date2;
   $dataProvider = new \yii\data\ArrayDataProvider([
       'allModels' => $rawData,
       'pagination' => FALSE,
   ]);
   return $this->render('staff_operation', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,

   ]);   
}
    public function actionStaff_operation_list($staffid){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT a.REG_DATETIME,a.VISIT_ID,a.HN ,a.NICKNAME,a.CODE ,a.STAFF_ID
        FROM mb_opd_operations a
        INNER JOIN staff b ON a.STAFF_ID = b.STAFF_ID
        LEFT JOIN population c ON b.CID = c.CID
        WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
        AND a.STAFF_ID = $staffid ORDER BY a.NICKNAME";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

    // print_r($rawData);
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => FALSE,
    ]);
    return $this->render('staff_operation_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
} 
public function actionSurgeon_operation(){
    $data = Yii::$app->request->post();
    $date1 = isset($data['date1']) ? $data['date1'] : '';
    $date2 = isset($data['date2']) ? $data['date2'] : '';

$sql = "SELECT a.SURGEON_ID,CONCAT(c.FNAME,'',TRIM(c.LNAME))AS Provider,
COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'ฝังเข็ม', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
COUNT(CODE) AS Total 
FROM mb_opd_operations a
INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
LEFT JOIN population c ON b.CID = c.CID
WHERE DATE(a.REG_DATETIME) between '$date1' AND '$date2'
AND a.CGD_ID = 15
AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
GROUP BY a.SURGEON_ID ORDER BY a.SURGEON_ID";
$iData = \yii::$app->db2->createCommand($sql)->queryAll();
Yii::$app->session['date1']=$date1;
Yii::$app->session['date2']=$date2;
$dataProvider = new \yii\data\ArrayDataProvider([
   'allModels' => $iData,
   'pagination' => [
       'pagesize'=> 15
   ],
]);
return $this->render('surgeon_operation', [
           'dataProvider' => $dataProvider,
           //'outData' => $outdataProvider,
           'sql'=>$sql,
           'date1'=>$date1,
           'date2'=>$date2,

 ]);   
}
public function actionSurgeon_operation_list($surgeonid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT a.REG_DATETIME,a.VISIT_ID,a.HN ,a.NICKNAME,a.CODE, a.SURGEON_ID
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    AND a.SURGEON_ID = $surgeonid ORDER BY a.NICKNAME";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();

// print_r($rawData);
try {
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
} catch (\yii\db\Exception $e) {
    throw new \yii\web\ConflictHttpException('sql error');
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 15
    ],
]);
return $this->render('surgeon_operation_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,

    ]);
  } 
  public function actionSurgeon_songserm($surgeonid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT  DISTINCT a.REG_DATETIME,a.VISIT_ID,a.HN ,a.NICKNAME,a.CODE, a.SURGEON_ID
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    AND a.SURGEON_ID = $surgeonid AND SUBSTR(a.NICKNAME,4,8) = 'ส่งเสริม' ORDER BY a.NICKNAME";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();

// print_r($rawData);
try {
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
} catch (\yii\db\Exception $e) {
    throw new \yii\web\ConflictHttpException('sql error');
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 15
     ],
    ]);
    return $this->render('surgeon_operation_list', [
        'dataProvider' => $dataProvider,
        'sql'=>$sql,

]);
} 
public function actionSurgeon_acupencture($surgeonid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT DISTINCT a.REG_DATETIME,a.VISIT_ID,a.HN ,a.NICKNAME,a.CODE, a.SURGEON_ID
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    AND a.SURGEON_ID = $surgeonid AND a.code= 99.92 ORDER BY a.NICKNAME";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();

// print_r($rawData);
try {
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
} catch (\yii\db\Exception $e) {
    throw new \yii\web\ConflictHttpException('sql error');
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 15
    ],
]);
return $this->render('surgeon_operation_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,

    ]);
  } 
  public function actionSurgeon_nursing($surgeonid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT DISTINCT a.REG_DATETIME,a.VISIT_ID, a.HN ,a.NICKNAME,a.CODE, a.SURGEON_ID
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    AND a.SURGEON_ID = $surgeonid AND SUBSTR(a.NICKNAME,4,6) = 'บริบาล' ORDER BY a.NICKNAME";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();

// print_r($rawData);
try {
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
} catch (\yii\db\Exception $e) {
    throw new \yii\web\ConflictHttpException('sql error');
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 15
    ],
]);
return $this->render('surgeon_operation_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,

    ]);
  } 
  public function actionSurgeon_massage($surgeonid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT DISTINCT a.REG_DATETIME,a.VISIT_ID, a.HN ,a.NICKNAME,a.CODE, a.SURGEON_ID
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    AND a.SURGEON_ID = $surgeonid AND left(NICKNAME,6) = 'การนวด' ORDER BY a.NICKNAME";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();

// print_r($rawData);
try {
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
} catch (\yii\db\Exception $e) {
    throw new \yii\web\ConflictHttpException('sql error');
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 15
    ],
]);
return $this->render('surgeon_operation_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,

    ]);
  } 
  public function actionSurgeon_baked($surgeonid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT DISTINCT a.REG_DATETIME,a.VISIT_ID, a.HN ,a.NICKNAME,a.CODE, a.SURGEON_ID
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    AND a.SURGEON_ID = $surgeonid AND SUBSTR(a.NICKNAME,4,2) = 'อบ' ORDER BY a.NICKNAME";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();

// print_r($rawData);
try {
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
} catch (\yii\db\Exception $e) {
    throw new \yii\web\ConflictHttpException('sql error');
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 15
    ],
]);
return $this->render('surgeon_operation_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,

    ]);
  } 
  public function actionSurgeon_compression($surgeonid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT DISTINCT a.REG_DATETIME,a.VISIT_ID, a.HN ,a.NICKNAME,a.CODE, a.SURGEON_ID
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
    LEFT JOIN population c ON b.CID = c.CID
    WHERE DATE(a.REG_DATETIME) BETWEEN '$date1' AND '$date2'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    AND a.SURGEON_ID = $surgeonid AND SUBSTR(a.NICKNAME,4,5) = 'ประคบ' ORDER BY a.NICKNAME";
$rawData = \yii::$app->db2->createCommand($sql)->queryAll();

// print_r($rawData);
try {
    $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
} catch (\yii\db\Exception $e) {
    throw new \yii\web\ConflictHttpException('sql error');
}
$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $rawData,
    'pagination' => [
        'pagesize'=> 15
    ],
]);
return $this->render('surgeon_operation_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,

    ]);
  } 
  public function actionOp_count(){
     $date1 = Yii::$app->session['date1'];
     $date2 = Yii::$app->session['date2'];
     $sql = " SELECT MONTH(REG_DATETIME)AS MONTH, 
     COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'acupencture', 
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'nursing', 
     COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'massage',
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'baked', 
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'compression', 
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'songserm', 
     COUNT(CODE) AS Total  
       FROM mb_opd_operations 
       WHERE REG_DATETIME BETWEEN  '$date1' AND '$date2'
       AND VISIT_ID in (SELECT VISIT_ID FROM mobile_visits)
       GROUP BY MONTH(REG_DATETIME) ORDER BY MONTH(REG_DATETIME)";
 $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
        $top10idataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => [
                'pagesize'=> 8
            ],
        ]);
        
        $sql = " SELECT MONTH(REG_DATETIME)AS MONTH, 
        COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'acupencture', 
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'nursing', 
        COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'massage',
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'baked', 
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'compression', 
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'songserm', 
        COUNT(CODE) AS Total  
          FROM mb_opd_operations 
          WHERE REG_DATETIME BETWEEN  '$date1' AND '$date2'
          AND VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
          GROUP BY MONTH(REG_DATETIME) ORDER BY MONTH(REG_DATETIME)";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
        $topdataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => [
                'pagesize'=> 8
            ],
        ]);

return $this->render('op_countlist', [
           'outData' =>$top10idataProvider,
           'inData' => $topdataProvider,
    ]);   
  }
  public function actionSurgeon_inout(){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
$sql = "SELECT a.SURGEON_ID,CONCAT(c.FNAME,'',TRIM(c.LNAME))AS Provider,
COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'ฝังเข็ม', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
COUNT(CODE) AS Total 
FROM mb_opd_operations a
INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
LEFT JOIN population c ON b.CID = c.CID
WHERE DATE(a.REG_DATETIME) between '$date1' AND '$date2'
AND a.CGD_ID = 15
AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
GROUP BY a.SURGEON_ID ORDER BY a.SURGEON_ID";
$iData = \yii::$app->db2->createCommand($sql)->queryAll();
$indataProvider = new \yii\data\ArrayDataProvider([
   'allModels' => $iData,
   'pagination' => [
       'pagesize'=> 15
   ],
]);
$sql = "SELECT a.SURGEON_ID,CONCAT(c.FNAME,'',TRIM(c.LNAME))AS Provider,
COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'ฝังเข็ม', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
COUNT(CODE) AS Total 
FROM mb_opd_operations a
INNER JOIN staff b ON a.SURGEON_ID = b.STAFF_ID
LEFT JOIN population c ON b.CID = c.CID
WHERE DATE(a.REG_DATETIME) between '$date1' AND '$date2'
AND a.CGD_ID = 15
AND a.VISIT_ID  in (SELECT VISIT_ID FROM mobile_visits)
GROUP BY a.SURGEON_ID ORDER BY a.SURGEON_ID";
$oData = \yii::$app->db2->createCommand($sql)->queryAll();
$outdataProvider = new \yii\data\ArrayDataProvider([
   'allModels' => $oData,
   'pagination' => [
       'pagesize'=> 15
   ],
]);
return $this->render('inout', [
           'insData' => $indataProvider,
           'outsData' => $outdataProvider,
           'sql'=>$sql,
           'date1'=>$date1,
           'date2'=>$date2,

 ]);   
}
}

