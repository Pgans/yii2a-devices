<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;


include Yii::getAlias('@common').'/config/thai_date.php';
class ReportController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['operation','deathdx59','deathipd','dsc59','referout59','visit_opd','outstan'],
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

    public function actionOperation() {
        $data = Yii::$app->request->post();
        $date1 =isset($data['date1'])  ? $data['date1'] : '';
        $date2 =isset($data['date2'])  ? $data['date2'] : '';

      $sql = "SELECT `CODE`, NICKNAME, COUNT(`CODE`) AS total
 FROM mb_operation WHERE REG_DATETIME BETWEEN '$date1' AND '$date2' GROUP BY `CODE`  ORDER BY total DESC LIMIT 100";

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
        Yii::$app->session['date1'] =$date1;
        Yii::$app->session['date2'] =$date2;
        return $this->render('operation', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,

        ]);
    }
    public function actionOperation_list($code){
        $date1 =Yii::$app->session['date1'];
        $date2 =Yii::$app->session['date2'];
     $sql= "SELECT *  FROM mb_operation WHERE CODE = '$code' AND reg_datetime BETWEEN'$date1' AND '$date2'";
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
    return $this->render('operation_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

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
     public function actionDeathipd() {
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
     
      $sql = "SELECT DISTINCT a.WARD_NO , b.UNIT_NAME, COUNT(a.WARD_NO) AS amount
                FROM mb_deathipd a, service_units b
                WHERE  a.DEATH_DATE BETWEEN '$date1' AND '$date2'
                AND  a.ward_no= b.unit_id
                GROUP BY  a.WARD_NO ORDER BY amount DESC ";
                    
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
      // echo $date1;
     $sql= "SELECT * FROM mb_deathipd WHERE WARD_NO = $wardno and DEATH_DATE BETWEEN '$date1' and '$date2'";
    // $sql.= "AND (DSC_DATE between '$date1' and '$date2')";
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

    public function actionDsc59() {
        $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';
      $sql = "SELECT a.UNIT_ID as 'unit_id', b.UNIT_NAME as 'แผนก', COUNT(a.UNIT_ID ) as 'จำนวนผู้ป่วย'
              FROM mb_dsc a, service_units b WHERE a.dsc_date between '$date1' and '$date2'
              AND a.UNIT_ID = b.UNIT_ID GROUP BY a.UNIT_ID ORDER BY COUNT(a.UNIT_ID ) DESC;";
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

        Yii::$app->session['date1'] = $date1;
        Yii::$app->session['date2'] = $date2;

        return $this->render('dsc59', ['dataProvider' => $dataProvider,
                     'sql'=>$sql, 
                     'date1'=>$date1, 
                     'date2'=>$date2,
        ]);
        
    }
    public function actionDsc_list($unit_id) {
    
       $date1 = Yii::$app->session['date1'];
       $date2 = Yii::$app->session['date2'];
      // echo $date1;
     $sql= "SELECT  VISIT_ID, ADM_ID, ADM_DATE, DSC_DATE, DSC_TYPE, DSC_STATUS, UNIT_ID, DSC_DR, ADM_DR,P_DIAG
     FROM mb_dsc 
     WHERE UNIT_ID = $unit_id and dsc_date between '$date1' and '$date2'";
    // $sql.= "AND (DSC_DATE between '$date1' and '$date2')";
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
    return $this->render('dsc_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1, 
                'date2'=>$date2,
    ]);
}
     public function actionReferout59(){
          $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';
$sql = "SELECT hospid, hosp_name, count(hosp_name) as 'Total' FROM mb_referout_list
        WHERE  refer_date between '$date1' and '$date2'
       group by hospid order by Total DESC";

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
       return $this->render('referout59', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql, 
                   'date1'=>$date1, 
                   'date2'=>$date2,

       ]);
   }
   public function actionReferout59_list($hospid){
       $date1 = Yii::$app->session['date1'];
       $date2 = Yii::$app->session['date2'];
        $sql = "SELECT * FROM mb_referout_list WHERE hospid = $hospid 
        and refer_date between '$date1' and '$date2'";
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
       return $this->render('referout59_list', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
    public function actionDxopd59(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT icd10_TM, icd_name , COUNT(icd_name) AS amount
        FROM mb_dxopd WHERE REGDATE between '$date1' AND '$date2' 
        AND icd10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY ICD10_TM ORDER BY amount DESC LIMIT 15";
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
       return $this->render('dxopd59', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
   }
     public function actionDxopd_list($icd10_TM) {

       $date1 = Yii::$app->session['date1'];
       $date2 = Yii::$app->session['date2'];

        $sql = "SELECT visit_id,hn,regdate, sex, age,unit_reg,inscl,icd10_tm,town_id
        FROM mb_dxopd WHERE icd10_TM = '$icd10_TM'
        AND REGDATE between '$date1' AND '$date2'" ;
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
       return $this->render('dxopd_list', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
    public function actionDxipd(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';


        $sql = "SELECT ICD10_TM,ICD_NAME, COUNT(ICD_NAME) AS  amount
FROM mb_ipddx
WHERE DSC_DT between '$date1' and '$date2'
GROUP BY ICD_NAME ORDER BY amount DESC LIMIT 15";
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
       return $this->render('ipddx', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2' =>$date2,

       ]);
   }
   public function actionDxipd_reg(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT P_DIAG, COUNT(P_DIAG) AS amount FROM mb_ipdreg
        WHERE DSC_DT between '$date1' and '$date2'
        AND NOT  LEFT(P_DIAG,2)= '[O' AND NOT LEFT(P_DIAG,2) = '[z'
        GROUP BY P_DIAG ORDER BY amount DESC LIMIT 15";

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
       return $this->render('ipddx_reg', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2' =>$date2,

       ]);
   }
    public function actionRpt_dep59(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  b.unit_id ,b.unit_name , COUNT(b.UNIT_NAME) AS amount
FROM  mb_dxopd a , service_units b WHERE a.REG_DATETIME between '$date1' and '$date2'
AND a.UNIT_REG = b.UNIT_ID GROUP BY b.UNIT_ID ORDER BY amount DESC";
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
       return $this->render('dep-reg', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
       
   }
   public function actionDep_list($unit_id) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];

     $sql= "SELECT * FROM mb_dxopd WHERE unit_reg = $unit_id AND reg_datetime between '$date1' and '$date2'";
     //$sql.= "AND (reg_datetime between '$date1' and '$date2')";
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
    public function actionVisits_ipd(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

         $sql = "SELECT 'Visitsผู้นอนโรงพยาบาล' as 'แผนกที่รับบริการผู้ป่วยใน',count(VISIT_ID) AS 'จำนวนผู้ป่วยใน(ครั้ง)'
                FROM ipd_reg WHERE ADM_DT BETWEEN '$date1' AND '$date2'AND IS_CANCEL = 0 ";
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
        return $this->render('visits_ipd', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1'=>$date1,
                    'date2'=>$date2,

        ]);
    }
    public function actionVisits_opd(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

         $sql = "SELECT 'visitsผู้มารับบริการ' as 'แผนกที่รับบริการผู้ป่วยนอก',count(VISIT_ID) AS 'จำนวนผู้ป่วยนอก(ครั้ง)'
                FROM opd_visits WHERE reg_datetime BETWEEN '$date1' AND '$date2' AND is_cancel = 0 
                AND VISIT_ID NOT IN(SELECT VISIT_ID FROM ipd_reg)"; 

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
        return $this->render('visits_opd', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1'=>$date1,
                    'date2'=>$date2,

        ]);
    }
    public function actionReferin(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT hospid, hosp_name, COUNT(VISIT_ID) AS TOTAL
FROM mb_referin_list WHERE referdate BETWEEN '$date1' AND '$date2'
GROUP BY hospid ORDER BY TOTAL DESC";
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
       return $this->render('referin', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
        public function actionReferin_list($hospid){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_referin_list
            WHERE hospid = $hospid AND referdate BETWEEN '$date1' AND '$date2' ORDER BY VISIT_ID DESC";
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
        return $this->render('referin_list', [
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
        public function actionOutstan_list($unit_id){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_outstan
            WHERE unit_id = $unit_id AND mu_date BETWEEN '$date1' AND '$date2'";
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
      public function actionExamination(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT ICD10_TM, ICD_NAME , COUNT(ICD10_TM) AS AMOUNT
                FROM mb_visitsdx
                WHERE REG_DATETIME BETWEEN '$date1' AND '$date2' AND UNIT_ID = '02' AND ICD10_TM NOT BETWEEN 'z00' AND 'z99'
                GROUP BY ICD10_TM  ORDER BY AMOUNT DESC LIMIT 10";
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
       return $this->render('examination', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
         public function actionExamination_list($icd10tm){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_visitsdx
            WHERE ICD10_TM = '$icd10tm' AND UNIT_ID = '02' AND reg_datetime BETWEEN '$date1' AND '$date2' 
            AND ICD10_TM NOT BETWEEN 'z00' AND 'z99' ";
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
        return $this->render('examination_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
     public function actionEr5dx(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT ICD10_TM, ICD_NAME , COUNT(ICD10_TM) AS AMOUNT
                FROM mb_visitsdx
                WHERE REG_DATETIME BETWEEN '$date1' AND '$date2' AND UNIT_ID = '11' AND ICD10_TM NOT BETWEEN 'z00' AND 'z99'
                GROUP BY ICD10_TM  ORDER BY AMOUNT DESC LIMIT 10";
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
       return $this->render('er5dx', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
         public function actionEr5dx_list($icd10tm){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_visitsdx
            WHERE ICD10_TM = '$icd10tm' AND UNIT_ID = '11' AND reg_datetime BETWEEN '$date1' AND '$date2'
            AND ICD10_TM NOT BETWEEN 'z00' AND 'z99'";
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
        return $this->render('er5dx_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDxg(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT * FROM  mb_medicine WHERE  DSC_DT  BETWEEN '$date1' AND '$date2'GROUP BY ADM_ID ORDER BY DSC_DT";
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
   public function actionReferipd(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  UNIT_ID,UNIT_NAME, COUNT(UNIT_NAME) AS AMOUNT
FROM  mb_refer_ipd WHERE RF_DT BETWEEN '$date1' AND '$date2' GROUP BY UNIT_NAME ";
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
       Yii::$app->session['date1'] =$date1;
       Yii::$app->session['date2'] =$date2;
       return $this->render('referipd', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=>$date1,
                   'date2'=>$date2,

       ]);   
   }
         public function actionReferipd_list($UNIT_ID){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_refer_ipd
            WHERE  UNIT_ID = '$UNIT_ID' AND rf_dt  BETWEEN '$date1' AND '$date2'";
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
        return $this->render('referipd_list', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionIpddx59(){
        $connection = Yii::$app->db2;
        $data = $connection->createCommand('
            SELECT year(t.DSC_DT) as yy,
            month(t.DSC_DT) as mm,
            COUNT(t.ADM_DT) as cnt
            FROM ipd_reg t
            WHERE t.DSC_DT BETWEEN "20151001" AND "20160930"
            AND t.IS_CANCEL =0
            GROUP BY yy,mm
            ORDER BY yy,mm
            ')->queryAll();
        //เตรียมข้อมูลส่งให้กราฟ
        for($i=0;$i<sizeof($data);$i++){
            $yy[] = $data[$i]['yy'];
            $mm[] = $data[$i]['yy'].'-'.$data[$i]['mm'];
            $cnt[] =intval($data[$i]['cnt']);
        }
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            'sort'=>[
                'attributes'=>['yy','mm','cnt']
            ],
        ]);
        return $this->render('graphipd59',[
            'dataProvider'=>$dataProvider,
            'yy'=>$yy,'mm'=>$mm,'cnt'=>$cnt,
        ]);
    }
    public function actionAccidents(){
        $connection = Yii::$app->db2;
        $data = $connection->createCommand('
            SELECT  YEAR(a.datetime_ae) AS yy, MONTH(a.datetime_ae) AS mm, COUNT(a.visit_id) AS accidents
            FROM accidents  a
            WHERE a.is_cancel = 0
            GROUP BY yy,mm 
            ORDER BY yy,mm
            ')->queryAll();
        //เตรียมข้อมูลส่งให้กราฟ
        for($i=0;$i<sizeof($data);$i++){
            $yy[] = $data[$i]['yy'];
            $mm[] = $data[$i]['yy'].'-'.$data[$i]['mm'];
            $accidents[] =intval($data[$i]['accidents']);
        }
        
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            'sort'=>[
                'attributes'=>['yy','mm','accidents']
            ],
        ]);
        return $this->render('accident',[
            'dataProvider'=>$dataProvider,
            'yy'=>$yy,'mm'=>$mm,'accidents'=>$accidents,
        ]);
    }
  }
