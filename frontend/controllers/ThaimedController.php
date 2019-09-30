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
            'pagination' => FALSE,
            //'pagination' => ['pagesize' => 5],
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

       $sData = \yii::$app->db2->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $sData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       
       $smondataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $sData,
           'pagination' => FALSE,
       ]);
       return $this->render('smonpri_replace', [
                   'dataProvider' => $smondataProvider,
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
       $iData = \yii::$app->db2->createCommand($sql)->queryAll();
       try {
           $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $iidataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $iData,
           'pagination' => FALSE,
       ]);
       $sql2 = "SELECT MONTH(REG_DATETIME)AS MONTH, 
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
    $oData = \Yii::$app->db2->createCommand($sql2)->queryAll();
       $oodataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $oData,
           'pagination' => FALSE,
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
     #COUNT(CASE WHEN CODE= 99.92 THEN '2' END) AS 'acupencture', 
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'nursing', 
     COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'massage',
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'baked', 
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'compression', 
     COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'songserm', 
     COUNT(CODE) AS Total  
       FROM mb_opd_operations 
       WHERE REG_DATETIME BETWEEN  '$date1' AND '$date2'
       AND CGD_ID = 15  
       GROUP BY MONTH(REG_DATETIME) ORDER BY MONTH(REG_DATETIME)";
 $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
     $itopdataProvider = new \yii\data\ArrayDataProvider([
         'allModels' => $rawData,
         'pagination' => [
             'pagesize'=> 8
         ],
     ]);

        $sql = " SELECT MONTH(REG_DATETIME)AS MONTH, 
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,6) ='บริบาล' THEN '3' END) AS 'nursing', 
        COUNT(case WHEN left(NICKNAME,6) = 'การนวด' THEN '4'END) AS 'massage',
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,2) = 'อบ' THEN '5' END) AS 'baked', 
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,5) = 'ประคบ' THEN '6' END) AS 'compression', 
        COUNT(CASE WHEN SUBSTR(NICKNAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'songserm', 
        COUNT(CODE) AS Total  
          FROM mb_opd_operations 
          WHERE REG_DATETIME BETWEEN  '$date1' AND '$date2'
          AND VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
          AND CGD_ID = 15
          GROUP BY MONTH(REG_DATETIME) ORDER BY MONTH(REG_DATETIME)";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
        $topdataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => [
                'pagesize'=> 8
            ],
        ]);

       $sql = "SELECT DISTINCT MONTH(a.DATE_SERV)AS MONTH,
      # COUNT(CASE WHEN a.PROCEDCODE = 9992 THEN '2' END) AS 'ฝังเข็ม', 
       COUNT(CASE WHEN SUBSTR(b.NAME,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
       COUNT(case WHEN left(b.NAME,6) = 'การนวด' THEN '4'END) AS 'การนวด',
       COUNT(CASE WHEN SUBSTR(b.NAME,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
       COUNT(CASE WHEN SUBSTR(b.NAME,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
       COUNT(CASE WHEN SUBSTR(b.NAME,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
       COUNT(a.PROCEDCODE) AS Total 
       FROM procedure_opd a
       INNER JOIN icd43_planthai1 b ON a.PROCEDCODE = b.CODE
       INNER JOIN service c ON a.SEQ = c.SEQ
       WHERE a.DATE_SERV BETWEEN '$date1' AND '$date2' 
       GROUP BY MONTH(a.DATE_SERV)";
        $fData = \yii::$app->db4->createCommand($sql)->queryAll();
        $procedataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $fData,
            'pagination' => FALSE,
        ]);

        $sql = "SELECT DISTINCT MONTH(a.DATE_SERV)AS MONTH,
        #COUNT(CASE WHEN a.PROCEDCODE = 99.92 THEN '2' END) AS 'ฝังเข็ม', 
        COUNT(CASE WHEN SUBSTR(b.desc_r,4,6) ='บริบาล' THEN '3' END) AS 'บริบาล', 
        COUNT(case WHEN left(b.desc_r,6) = 'การนวด' THEN '4'END) AS 'การนวด',
        COUNT(CASE WHEN SUBSTR(b.desc_r,4,2) = 'อบ' THEN '5' END) AS 'อบ', 
        COUNT(CASE WHEN SUBSTR(b.desc_r,4,5) = 'ประคบ' THEN '6' END) AS 'ประคบ', 
        COUNT(CASE WHEN SUBSTR(b.desc_r,4,8) = 'ส่งเสริม' THEN '7' END) AS 'ส่งเสริม', 
        COUNT(a.PROCEDCODE) AS Total 
        FROM procedure_opd a
        INNER JOIN cicd9ttm_planthai b ON a.PROCEDCODE = b.code
        INNER JOIN service c ON a.SEQ = c.SEQ
        WHERE a.DATE_SERV BETWEEN '$date1' AND '$date2'
        AND a.CLINIC = '00126' AND c.SERVPLACE =2
        GROUP BY MONTH(a.DATE_SERV)";
    $fData = \yii::$app->db4->createCommand($sql)->queryAll();
    $oprocedataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $fData,
        'pagination' => FALSE,
    ]);

return $this->render('op_countlist', [
           'outData' =>$itopdataProvider,
           'inData' => $topdataProvider,
           'oproceData'=>$oprocedataProvider,
           'iproceData'=>$procedataProvider,
           'date1'=> $date1,
           'date2'=>$date2,
           
    ]);   
  }
  public function actionSurgeon_inout(){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
$sql2 = "SELECT a.SURGEON_ID,CONCAT(c.FNAME,'',TRIM(c.LNAME))AS Provider,
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
$iData = \yii::$app->db2->createCommand($sql2)->queryAll();
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
public function actionCheck_operations(){
    $sql = "SELECT a.CODE AS 43F, b.43CODE AS MCODE,b.CODE AS HCODE ,a.NAME, b.NICKNAME,COST,CGD_ID
    FROM icd43_planthai1 a
    RIGHT  JOIN icd9cm_planthai b ON a.CODE = b.43CODE";
    $iData = \yii::$app->db4->createCommand($sql)->queryAll();
    $dataProvider = new \yii\data\ArrayDataProvider([
       'allModels' => $iData,
       'pagination' => [
           'pagesize'=> 8
       ],
    ]);
    return $this->render('check_operations', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               
         ]);      
        }
 public function actionCheck_operation(){
$sql = "SELECT a.CODE AS 43F, b.43CODE AS MCODE,b.CODE AS HCODE ,a.NAME, b.NICKNAME,COST,CGD_ID
FROM icd43_planthai1 a
RIGHT  JOIN icd9cm_planthai b ON a.CODE = b.43CODE";
$iData = \yii::$app->db4->createCommand($sql)->queryAll();
$dataProvider = new \yii\data\ArrayDataProvider([
   'allModels' => $iData,
   'pagination' => [
       'pagesize'=> 8
   ],
]);
return $this->render('ck_operation', [
           'dataProvider' => $dataProvider,
           'sql'=>$sql,
           

     ]);      
    }
    public function actionCheck_procudure(){
        $sql = "SELECT a.CODE AS 43F, b.43CODE AS MCODE,b.CODE AS HCODE ,a.NAME, b.NICKNAME,COST,CGD_ID
        FROM icd43_planthai1 a
        LEFT JOIN icd9cm_planthai b ON a.CODE = b.43CODE";
        $ioData = \yii::$app->db4->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $ioData,
           'pagination' => [
               'pagesize'=> 8
           ],
        ]);
        return $this->render('ck_procudure', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   
        
             ]);      
            }
    public function actionNo_procudure(){
                $sql = "SELECT 
                (CASE WHEN ISNULL(a.CODE) THEN ''
                ELSE a.CODE END) AS 43F,
                 b.43CODE AS MCODE,b.CODE AS HCODE, b.NICKNAME,COST,CGD_ID
                FROM icd43_planthai1 a
                RIGHT  JOIN icd9cm_planthai b ON a.CODE = b.43CODE
                WHERE
                a.CODE  IS NULL";
                $ioData = \yii::$app->db4->createCommand($sql)->queryAll();
                $dataProvider = new \yii\data\ArrayDataProvider([
                   'allModels' => $ioData,
                   'pagination' => [
                       'pagesize'=> 8
                   ],
                ]);
                return $this->render('ck_procudure', [
                           'dataProvider' => $dataProvider,
                           'sql'=>$sql,         
         ]);               
    }
    public function actionSurgeon_9007810(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
    
    $sql = "SELECT DISTINCT k.INSCL, k.INSCL_NAME, COUNT(k.INSCL) as AMOUNT
    FROM (
    SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN , c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID
    FROM opd_visits a
    INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0
    INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code = 9007810 AND c.CGD_ID = 15
    INNER JOIN main_inscls d ON a.inscl = d.inscl
    WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2'
    AND a.visit_id NOT in (SELECT VISIT_ID FROM mobile_visits)
    ) as k 
    GROUP BY k.INSCL ORDER BY COUNT(k.INSCL) DESC";
    $rowData = \yii::$app->db2->createCommand($sql)->queryAll();
    Yii::$app->session['date1']=$date1;
    Yii::$app->session['date2']=$date2;
    $dataProvider = new \yii\data\ArrayDataProvider([
       'allModels' => $rowData,
       'pagination' => [
           'pagesize'=> 15
       ],
    ]);
    return $this->render('surgeon_9007810', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,
     ]);   
    }
    public function actionSurgeon_9007810_list($inscl){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN , c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID
        FROM opd_visits a
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code = 9007810 AND c.CGD_ID = 15
        INNER JOIN main_inscls d ON a.inscl = d.inscl
        WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2'
        AND d.inscl =$inscl
        AND a.visit_id NOT in (SELECT VISIT_ID FROM mobile_visits)";
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
            'pagesize'=> 10
        ],
    ]);
    return $this->render('surgeon_9007810_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2,
    
        ]);
      } 
      public function actionSurgeon_9007810all(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN , c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID
        FROM opd_visits a
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code = 9007810 AND c.CGD_ID = 15
        INNER JOIN main_inscls d ON a.inscl = d.inscl
        WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2'
        AND a.visit_id NOT in (SELECT VISIT_ID FROM mobile_visits) ORDER BY inscl";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('surgeon_9007810_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
    
        ]);
      } 
      public function actionSurgeon_9007810month(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT DISTINCT YEAR(REG_DATETIME) AS YEAR,MONTH(a.REG_DATETIME) as MONTH,
        COUNT(CASE WHEN d.INSCL in(01,12,25) THEN 1 END) AS 'ข้าราชการ',
        COUNT(CASE WHEN d.INSCL in(08,09) THEN 1 END) AS 'ประกันสังคม',
        COUNT(CASE WHEN d.INSCL in(14,36) THEN 1 END) AS 'รัฐวิสาหกิจ/ข้าราชการ กทม',
        COUNT(CASE WHEN d.INSCL =23 THEN 1 END) AS 'มาตรา8',
        COUNT(CASE WHEN d.INSCL =03 THEN 1 END) AS 'ประกันสุขภาพ',
        COUNT(CASE WHEN d.INSCL BETWEEN '01' AND '37' THEN 1 END) AS 'รวม'
        FROM opd_visits a
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code = 9007810 AND c.CGD_ID = 15
        INNER JOIN main_inscls d ON a.inscl = d.inscl
        WHERE a.REG_DATETIME > '2018-10-01' 
        AND a.visit_id NOT in (SELECT VISIT_ID FROM mobile_visits)
        GROUP BY MONTH WITH ROLLUP ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('surgeon_9007810_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      } 
      public function actionU_thaimed(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
    
        $sql = "SELECT 'ประเภทU (ยกเว้นU778)' as 'ICD10_NAME',
        COUNT(k.VISIT_ID) AS VISITS,
        COUNT(DISTINCT k.hn)  AS KON
        FROM
        (SELECT a.REG_DATETIME ,a.VISIT_ID,a.HN ,c.ICD10_TM,c.ICD_NAME
        FROM opd_visits a
        INNER JOIN opd_diagnosis b ON a.VISIT_ID = b.VISIT_ID AND b.is_cancel = 0
        INNER JOIN icd10new c ON b.ICD10 = c.ICD10 AND LEFT(c.icd10_tm,1) = 'U' AND c.icd10_tm not in ('U778','U771')
        WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND a.is_inscl = 0) as k 
         ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    Yii::$app->session['date1']=$date1;
    Yii::$app->session['date2']=$date2;
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('u_thaimed', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      } 
      public function actionU_krung(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT a.REG_DATETIME ,a.VISIT_ID,a.HN ,c.ICD10_TM,c.ICD_NAME
        FROM opd_visits a
        INNER JOIN opd_diagnosis b ON a.VISIT_ID = b.VISIT_ID AND b.is_cancel = 0
        INNER JOIN icd10new c ON b.ICD10 = c.ICD10 AND LEFT(c.icd10_tm,1) = 'U' AND c.icd10_tm not in ('U778','U771')
        WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND a.is_inscl = 0 ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('u_krung', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      } 
      public function actionU_kon(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT a.REG_DATETIME ,a.VISIT_ID,a.HN ,c.ICD10_TM,c.ICD_NAME
        FROM opd_visits a
        INNER JOIN opd_diagnosis b ON a.VISIT_ID = b.VISIT_ID AND b.is_cancel = 0
        INNER JOIN icd10new c ON b.ICD10 = c.ICD10 AND LEFT(c.icd10_tm,1) = 'U' AND c.icd10_tm not in ('U778','U771')
        WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND a.is_inscl = 0 GROUP BY a.HN";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('u_kon', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      }
      public function actionU_list(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT k.ICD10_TM, k.ICD_NAME, COUNT(k.ICD10_TM) AS TOTAL
        FROM 
        (SELECT a.REG_DATETIME ,a.VISIT_ID,a.HN ,c.ICD10_TM,c.ICD_NAME
        FROM opd_visits a
        INNER JOIN opd_diagnosis b ON a.VISIT_ID = b.VISIT_ID AND b.is_cancel = 0
        INNER JOIN icd10new c ON b.ICD10 = c.ICD10 AND LEFT(c.icd10_tm,1) = 'U' AND c.icd10_tm not in ('U778','U771')
        WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND a.is_inscl = 0) as k  GROUP BY k.ICD10_TM  ORDER BY TOTAL DESC";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('u_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      } 
      public function actionU_9007712(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
        $sql = "SELECT k.INSCL, k.INSCL_NAME , COUNT(CODE) AS AMOUNT
        FROM 
        (SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN , c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID 
        FROM opd_visits a 
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0 
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code = '900-77-12' AND c.CGD_ID = 15 
        INNER JOIN main_inscls d ON a.inscl = d.inscl 
        WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2' ) AS k
        GROUP BY k.INSCL_NAME order by AMOUNT DESC ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    Yii::$app->session['date1']=$date1;
    Yii::$app->session['date2']=$date2;
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('9007712', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      } 
      public function actionU_9007712_list($inscl){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN ,a.VISIT_ID ,c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID 
        FROM opd_visits a 
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0 
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code = '900-77-12' AND c.CGD_ID = 15 
        INNER JOIN main_inscls d ON a.inscl = d.inscl 
        WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2' 
        AND d.INSCL =$inscl ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('9007712_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2,
    
        ]);
      } 
      public function actionU_9007712month(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT MONTH(k.REGDATE)AS MONTH, COUNT(CODE) AS AMOUNT 
        FROM (SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN , 
        c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID FROM opd_visits a 
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0 
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code = '900-77-12' AND c.CGD_ID = 15 
        INNER JOIN main_inscls d ON a.inscl = d.inscl 
        WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2' ) AS k 
        GROUP BY MONTH(k.REGDATE) WITH ROLLUP ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('9007712_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      }
      public function actionU_9007800(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
        $sql = "SELECT k.INSCL, k.INSCL_NAME , COUNT(CODE) AS AMOUNT
        FROM 
        (SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN , c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID 
        FROM opd_visits a 
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0 
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code in ('900-78-00','9007800') AND c.CGD_ID = 15 
        INNER JOIN main_inscls d ON a.inscl = d.inscl 
        WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2' ) AS k
        GROUP BY k.INSCL_NAME order by AMOUNT DESC ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    Yii::$app->session['date1']=$date1;
    Yii::$app->session['date2']=$date2;
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('9007800', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      } 
      public function actionU_9007800_list($inscl){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT DISTINCT date(a.REG_DATETIME) as REGDATE, d.INSCL , d.INSCL_NAME,a.HN ,a.VISIT_ID ,c.CODE, c.NICKNAME, b.STAFF_ID ,b.SURGEON_ID 
        FROM opd_visits a 
        INNER JOIN opd_operations b ON a.visit_id = b.visit_id and a.is_cancel = 0 
        INNER JOIN icd9cm c ON b.icd9 = c.icd9 AND c.code in ('900-78-00','9007800') AND c.CGD_ID = 15 
        INNER JOIN main_inscls d ON a.inscl = d.inscl 
        WHERE a.REG_DATETIME BETWEEN '$date1' and '$date2' 
        AND d.INSCL =$inscl ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('9007800_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2,
    
        ]);
      } 
      public function actionInscl_smonpai6(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
        $sql = "SELECT k.DRUG_ID, k.DRUG_NAME,
        COUNT(CASE WHEN(k.INSCL in (01,25,35,37,40)) THEN '1' END) AS 'ข้าราชการ' ,
        COUNT(CASE WHEN(k.INSCL in (08,09,21)) THEN '2' END) AS 'ประกันสังคม' ,
        COUNT(CASE WHEN(k.INSCL in (11,12)) THEN '3' END) AS 'อปท' ,
        COUNT(CASE WHEN(k.INSCL = 23) THEN '4' END) AS 'มาตรา8' ,
        COUNT(CASE WHEN(k.INSCL  = 00) THEN '5' END) AS 'สิทธิ์ว่าง' ,
COUNT(CASE WHEN(k.INSCL IN(00,08,09,11,12,21,23,01,25,35,37,40)) THEN '6' END) AS 'รวม'
FROM (
SELECT a.VISIT_ID,a.HN, f.CID, CONCAT(trim(f.FNAME),'   ',f.LNAME) as FULLNAME,FLOOR(DATEDIFF(a.REG_DATETIME,f.BIRTHDATE)/365.25) as AGE,
d.INSCL, d.INSCL_NAME,c.DRUG_ID,c. DRUG_NAME
FROM opd_visits a
INNER JOIN prescriptions b ON a.VISIT_ID = b.VISIT_ID
INNER JOIN drugs c ON  b.DRUG_ID = c.DRUG_ID
                INNER JOIN main_inscls d ON a.INSCL = d.INSCL AND d.inscl IN(00,08,09,11,12,21,23,01,25,35,37,40)
                INNER JOIN cid_hn e on a.HN = e.HN
                INNER JOIN population f ON e.CID = f.CID
        WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
        AND a.IS_CANCEL =0
        AND a.VISIT_ID NOT IN (SELECT VISIT_ID FROM ipd_reg)
        AND c.DRUG_ID in (0664,2358,0491,2443,2280,1393,2364,2282,0262,0263,0266,2362,2359,2363,2295,2314,0261,1392,2289,
                1389,2294,1395,2419,0666,0265,1394,1388,2360,2354,2311)
        ) as k  GROUP BY k.DRUG_ID ";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    Yii::$app->session['date1']=$date1;
    Yii::$app->session['date2']=$date2;
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => false
    ]);
    return $this->render('inscl_smonpai6', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      }  
      public function actionInscl_drugttm_list($drugid){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT a.VISIT_ID,a.HN, f.CID, CONCAT(trim(f.FNAME),'   ',f.LNAME) as FULLNAME,FLOOR(DATEDIFF(a.REG_DATETIME,f.BIRTHDATE)/365.25) as AGE,
        d.INSCL, d.INSCL_NAME,c.DRUG_ID,c. DRUG_NAME
                FROM opd_visits a
                        INNER JOIN prescriptions b ON a.VISIT_ID = b.VISIT_ID
                        INNER JOIN drugs c ON  b.DRUG_ID = c.DRUG_ID
                        INNER JOIN main_inscls d ON a.INSCL = d.INSCL AND d.inscl IN(00,08,09,11,12,21,23,01,25,35,37,40)
                        INNER JOIN cid_hn e on a.HN = e.HN
                        INNER JOIN population f ON e.CID = f.CID
                WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
                AND a.IS_CANCEL =0
                AND c.DRUG_ID = $drugid
                AND a.VISIT_ID NOT IN (SELECT VISIT_ID FROM ipd_reg)
                AND c.DRUG_ID in (0664,2358,0491,2443,2280,1393,2364,2282,0262,0263,0266,2362,2359,2363,2295,2314,0261,1392,2289,
                        1389,2294,1395,2419,0666,0265,1394,1388,2360,2354,2311)
                ORDER BY d.inscl";
    $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
    try {
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
    } catch (\yii\db\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => [
            'pagesize'=> 10
        ],
    ]);
    return $this->render('drugttm_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2,
    
        ]);
      }  
}

