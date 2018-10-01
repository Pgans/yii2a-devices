<?php

namespace frontend\controllers;
use yii;

class PhisicalController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionOperation_phisical_in(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

    $sql = "SELECT  CONCAT(c.FNAME,'',trim(c.LNAME)) as PROVIDER,a.STAFF_ID,a.NICKNAME, COUNT(a.CODE) as AMOUNT
    FROM mb_opd_operations a
    INNER JOIN staff b ON a.STAFF_ID = b.STAFF_ID
    INNER JOIN population c ON b.CID = c.CID
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
    AND a.NICKNAME BETWEEN 'PT00' AND 'PT75'
    AND a.VISIT_ID NOT in (SELECT VISIT_ID FROM mobile_visits)
    GROUP BY a.STAFF_ID ORDER BY AMOUNT DESC";
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
   return $this->render('oper_phisical_in', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,

   ]);   
}
public function actionOper_phisical_list($staffid){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT a.REG_DATETIME, a.VISIT_ID, a.HN, a.CODE, a.NICKNAME, a.INSCL, a.STAFF_ID
    FROM mb_opd_operations a
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
    AND a.CGD_ID = 14 AND a.STAFF_ID = $staffid
    ORDER BY a.VISIT_ID ";
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
return $this->render('oper_phisical_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,

]);
}
public function actionOperation_month(){
    $data = Yii::$app->request->post();
    $date1 = isset($data['date1']) ? $data['date1'] : '';
    $date2 = isset($data['date2']) ? $data['date2'] : '';

$sql = "SELECT MONTH(a.REG_DATETIME) AS MONTH,a.STAFF_ID, c.FNAME, count(a.VISIT_ID) AS AMOUNT
FROM mb_opd_operations a
INNER JOIN staff b ON a.staff_id = b.staff_id 
INNER JOIN population c ON b.cid = c.cid 
WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
AND a.CGD_ID = 14
GROUP BY MONTH, a.STAFF_ID ";
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
return $this->render('operation_month', [
           'dataProvider' => $dataProvider,
           'sql'=>$sql,
           'date1'=>$date1,
           'date2'=>$date2,

]);   
}
public function actionOperation_month_list($staffid,$month){
$date1 = Yii::$app->session['date1'];
$date2 = Yii::$app->session['date2'];
$sql = "SELECT month(a.REG_DATETIME)  as MONTH, a.VISIT_ID, a.HN, a.CODE, a.NICKNAME, a.INSCL, a.STAFF_ID
FROM mb_opd_operations a
WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
AND a.CGD_ID = 14 AND a.STAFF_ID = $staffid and month(a.REG_DATETIME)= $month
ORDER BY a.VISIT_ID ";
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
return $this->render('operation_month_list', [
        'dataProvider' => $dataProvider,
        'sql'=>$sql,

     ]);
    }  
    public function actionOperation_inscl(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
    
    $sql = "SELECT a.INSCL, b.INSCL_NAME, COUNT(a.INSCL) AS AMOUNT
    FROM mb_opd_operations a
    INNER JOIN main_inscls b ON a.inscl = b.inscl
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
    AND a.CGD_ID = 14
    GROUP BY a.INSCL ORDER BY AMOUNT DESC ";
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
    return $this->render('operation_inscl', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,
    
    ]);   
    }
    public function actionOperation_inscl_list($inscl){
    $date1 = Yii::$app->session['date1'];
    $date2 = Yii::$app->session['date2'];
    $sql = "SELECT a.REG_DATETIME, a.VISIT_ID, a.HN, a.NICKNAME, a.INSCL, a.SURGEON_ID, a.STAFF_ID, a.CGD_ID
    FROM mb_opd_operations a
    WHERE a.REG_DATETIME BETWEEN '$date1' AND '$date2'
    AND a.CGD_ID = 14 and inscl = $inscl";
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
    return $this->render('operation_inscl_list', [
            'dataProvider' => $dataProvider,
            'sql'=>$sql,
    
     ]);
    }  
}
