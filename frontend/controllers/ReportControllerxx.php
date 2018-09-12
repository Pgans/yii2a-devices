<?php

namespace frontend\controllers;
use yii;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDeathdx59() {
      $sql = "SELECT CDEATH , COUNT(CDEATH) AS TOTAL FROM  mb_deaths5859
WHERE  DEATH_DATE BETWEEN '20151001' AND '20160930' GROUP BY CDEATH ORDER BY TOTAL DESC";

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
        return $this->render('deathdx59', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDeathdx_list59($cdeath){
     $sql= "SELECT * FROM mb_deaths5859 WHERE cdeath = $cdeath AND deathdate BETWEEN '20151001' AND '20160930'";
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
    return $this->render('deathdx_list59', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
}
    public function actionDeath59() {
      $sql = "SELECT UNIT_ID as 'unit_id', unit_name as 'แผนกที่รับบริการ', COUNT( unit_id)as 'จำนวนผู้ป่วย'
FROM view_death WHERE deathdate BETWEEN '20151001' AND '20160930' group by unit_id";

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
        return $this->render('death59', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDeath_list59($unit_id){
     $sql= "SELECT * FROM view_death WHERE unit_id = $unit_id AND deathdate BETWEEN '20151001' AND '20160930'";
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
    return $this->render('death_list59', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
}
public function actionDeath58() {
      $sql = "SELECT UNIT_ID as 'unit_id', unit_name as 'แผนกที่รับบริการ', COUNT( unit_id)as 'จำนวนผู้ป่วย'
FROM view_death WHERE deathdate BETWEEN '20141001' AND '20150930' group by unit_id";

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
        return $this->render('death58', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDeath_list58($unit_id){
     $sql= "SELECT * FROM view_death WHERE unit_id = $unit_id AND deathdate BETWEEN '20141001' AND '20150930'";
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
    return $this->render('death_list58', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
}
public function actionDeath57() {
      $sql = "SELECT UNIT_ID as 'unit_id', unit_name as 'แผนกที่รับบริการ', COUNT( unit_id)as 'จำนวนผู้ป่วย'
FROM view_death WHERE deathdate BETWEEN '20131001' AND '20140930' group by unit_id";

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
        return $this->render('death57', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDeath_list57($unit_id){
     $sql= "SELECT * FROM view_death WHERE unit_id = $unit_id AND deathdate BETWEEN '20131001' AND '20140930'";
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
    return $this->render('death_list57', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
}
    public function actionDsc59() {
      $sql = "SELECT UNIT_ID as 'unit_id', dapartments as 'แผนกที่รับบริการ', COUNT( unit_id)as 'จำนวนผู้ป่วย'
FROM view_dsc59 group by dapartments";

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
        return $this->render('dsc59', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDsc_list59($unit_id){
     $sql= "SELECT * FROM view_dsc59 WHERE unit_id = $unit_id ";
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
    return $this->render('dsc_list57', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
}
     public function actionReferout59(){
$sql = "SELECT hosp_id, hosp_name, count(hosp_name) as 'Total' FROM mb_referout_list59
       group by hosp_id order by Total DESC";

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
       return $this->render('referout59', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferout59_list($hosp_id){
        $sql = "SELECT * FROM mb_referout_list59 WHERE hosp_id = $hosp_id";
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
        $sql = "SELECT *FROM view_10dxopd59";
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
       return $this->render('opddx59', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
    public function actionDxipd59(){
        $sql = "SELECT * FROM view_dxipd59";
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
       return $this->render('ipddx59', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
    public function actionRpt_dep59(){
        $sql = "SELECT * FROM view_unitreg59 Order By Total DESC";
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
       return $this->render('dep59', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
    public function actionReferin59_list($hospid){
         $sql = "SELECT * FROM mb_referin_list
         WHERE hospid = $hospid
         ORDER BY VISIT_ID DESC";
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
       return $this->render('report8', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
    public function actionDsc57() {
      $sql = "SELECT service_units.UNIT_ID as 'unit_id',service_units.UNIT_NAME as 'แผนกที่รับบริการ', COUNT( service_units.unit_name)as 'จำนวนผู้ป่วย'
FROM ipd_reg, service_units
WHERE ipd_reg.WARD_NO = service_units.UNIT_ID
AND ipd_reg.DSC_DT BETWEEN '20131001' AND '20140930'
AND ipd_reg.IS_CANCEL = 0
GROUP BY service_units.unit_name";

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
        return $this->render('dsc57', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDsc_list57($unit_id){
     $sql= "SELECT DISTINCT  cid_hn.CID AS 'เลขประชาชน', ADM_ID AS 'เลขภายใน',
cid_hn.HN AS 'เลขรพ.' ,FNAME AS 'ชื่อ', LNAME AS 'สกุล',
IF(population.SEX=1,'ชาย','หญิง') AS 'เพศ', FLOOR(datediff(NOW(),population.BIRTHDATE)/365.25) AS 'อายุ',
DATE_FORMAT(ipd_reg.ADM_DT,'%Y-%m-%d') AS 'วันที่รับ',
DATE_FORMAT(ipd_reg.DSC_DT,'%Y-%m-%d') AS 'วันจำหน่าย',
service_units.UNIT_NAME as 'แผนก'
FROM population, cid_hn,opd_visits
INNER JOIN ipd_reg ON opd_visits.VISIT_ID = ipd_reg.VISIT_ID
AND ipd_reg.DSC_DT BETWEEN '20131001' AND '20140930'
AND ipd_reg.IS_CANCEL = 0
INNER JOIN service_units ON service_units.UNIT_ID = ipd_reg.WARD_NO
WHERE opd_visits.HN = cid_hn.HN
AND population.CID = cid_hn.CID
AND service_units.UNIT_ID = $unit_id
ORDER BY ipd_reg.ADM_DT, ipd_reg.DSC_DT";
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
    return $this->render('dsc_list57', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
}
    public function actionDsc58() {
      $sql = "SELECT service_units.UNIT_ID as 'unit_id',service_units.UNIT_NAME as 'แผนกที่รับบริการ', COUNT( service_units.unit_name)as 'จำนวนผู้ป่วย'
FROM ipd_reg, service_units
WHERE ipd_reg.WARD_NO = service_units.UNIT_ID
AND ipd_reg.DSC_DT BETWEEN '20141001' AND '20150930'
AND ipd_reg.IS_CANCEL = 0
GROUP BY service_units.unit_name";

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
        return $this->render('dsc58', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionDsc_list58($unit_id){
     $sql= "SELECT DISTINCT  cid_hn.CID AS 'เลขประชาชน', ADM_ID AS 'เลขภายใน',
cid_hn.HN AS 'เลขรพ.' ,FNAME AS 'ชื่อ', LNAME AS 'สกุล',
IF(population.SEX=1,'ชาย','หญิง') AS 'เพศ', FLOOR(datediff(NOW(),population.BIRTHDATE)/365.25) AS 'อายุ',
DATE_FORMAT(ipd_reg.ADM_DT,'%Y-%m-%d') AS 'วันที่รับ',
DATE_FORMAT(ipd_reg.DSC_DT,'%Y-%m-%d') AS 'วันจำหน่าย',
service_units.UNIT_NAME as 'แผนก'
FROM population, cid_hn,opd_visits
INNER JOIN ipd_reg ON opd_visits.VISIT_ID = ipd_reg.VISIT_ID
AND ipd_reg.DSC_DT BETWEEN '20141001' AND '20150930'
AND ipd_reg.IS_CANCEL = 0
INNER JOIN service_units ON service_units.UNIT_ID = ipd_reg.WARD_NO
WHERE opd_visits.HN = cid_hn.HN
AND population.CID = cid_hn.CID
AND service_units.UNIT_ID = $unit_id
ORDER BY ipd_reg.ADM_DT, ipd_reg.DSC_DT";
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
    return $this->render('dsc_list57', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
    }
    public function actionReferout57(){
$sql = "SELECT hosp_id, hosp_name, count(hosp_name) as 'Total' FROM mb_referout_list
       group by hosp_id order by Total DESC";

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
       return $this->render('referout57', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferout57_list($hosp_id){
        $sql = "SELECT * FROM mb_referout_list WHERE hosp_id = $hosp_id";
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
       return $this->render('referout57_list', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
    public function actionReferout58(){
$sql = "SELECT hosp_id, hosp_name, count(hosp_name) as 'Total' FROM mb_referout_list58
       group by hosp_id order by Total DESC";

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
       return $this->render('referout58', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferout58_list($hosp_id){
        $sql = "SELECT * FROM mb_referout_list58 WHERE hosp_id = $hosp_id";
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
       return $this->render('referout58_list', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionDxopd57(){
        $sql = "SELECT *FROM mb_dxopd57  ORDER BY TOTAL DESC";
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
       return $this->render('opddx57', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionDxopd58(){
        $sql = "SELECT *FROM mb_dxopd58  ORDER BY TOTAL DESC";
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
       return $this->render('opddx58', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionDxipd57(){
        $sql = "SELECT icd10new.ICD10_TM AS 'รหัสโรค', icd10new.ICD_NAME AS 'ชื่อโรค', COUNT(icd10new.ICD10_TM)AS 'จำนวน'
FROM ipd_reg,opd_diagnosis, icd10new
WHERE ipd_reg.ADM_DT BETWEEN '20131001' AND '20140930'
AND ipd_reg.IS_CANCEL = 0
AND ipd_reg.VISIT_ID = opd_diagnosis.VISIT_ID
AND icd10new.ICD10 = opd_diagnosis.ICD10
AND icd10new.ICD10_TM NOT BETWEEN 'z00' AND 'z99'
AND icd10new.ICD10_TM NOT BETWEEN 'o00' AND 'o99'
AND opd_diagnosis.DXT_ID = 1
GROUP BY icd10new.ICD10_TM ORDER BY COUNT(icd10new.ICD10_TM)DESC
LIMIT 10";
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
       return $this->render('ipddx57', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionDxipd58(){
        $sql = "SELECT icd10new.ICD10_TM AS 'รหัสโรค', icd10new.ICD_NAME AS 'ชื่อโรค', COUNT(icd10new.ICD10_TM)AS 'จำนวน'
FROM ipd_reg,opd_diagnosis, icd10new
WHERE ipd_reg.ADM_DT BETWEEN '20141001' AND '20150930'
AND ipd_reg.IS_CANCEL = 0
AND ipd_reg.VISIT_ID = opd_diagnosis.VISIT_ID
AND icd10new.ICD10 = opd_diagnosis.ICD10
AND icd10new.ICD10_TM NOT BETWEEN 'z00' AND 'z99'
AND icd10new.ICD10_TM NOT BETWEEN 'o00' AND 'o99'
AND opd_diagnosis.DXT_ID = 1
GROUP BY icd10new.ICD10_TM ORDER BY COUNT(icd10new.ICD10_TM)DESC
LIMIT 10";
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
       return $this->render('ipddx58', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionRpt_dep57(){
        $sql = "SELECT * FROM mb_deppt57 Order By Total DESC";
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
       return $this->render('dep57', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionRpt_dep58(){
        $sql = "SELECT * FROM mb_deppt58 Order By Total DESC";
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
       return $this->render('dep58', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferin57(){
        $sql = "SELECT hospid, hosp_name, COUNT(VISIT_ID) AS TOTAL
FROM mb_referin57
GROUP BY hospid ORDER BY TOTAL DESC";
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
       return $this->render('referin57', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferin58(){
        $sql = "SELECT hospid, hosp_name, COUNT(VISIT_ID) AS TOTAL
 FROM mb_referin58
 GROUP BY hospid ORDER BY TOTAL DESC";
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
       return $this->render('referin58', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferin57_list($hospid){
        $sql = "SELECT * FROM mb_referin57
        WHERE hospid = $hospid
        ORDER BY VISIT_ID DESC;T";
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
       return $this->render('report7', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionReferin58_list($hospid){
         $sql = "SELECT * FROM mb_referin58
         WHERE hospid = $hospid
         ORDER BY VISIT_ID DESC";
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
       return $this->render('report8', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }
   public function actionVisits_ipd58(){
         $sql = "SELECT '' as 'แผนกที่รับบริการผู้ป่วยใน',count(VISIT_ID) AS 'จำนวนผู้ป่วยใน(ครั้ง)'
FROM ipd_reg
WHERE  ipd_reg.ADM_DT BETWEEN '20141001'  AND '20150930'
AND ipd_reg.IS_CANCEL = 0 ";
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
        return $this->render('visits_ipd58', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionVisits_opd58(){
         $sql = "SELECT '' as 'แผนกที่รับบริการผู้ป่วยนอก',count(VISIT_ID) AS 'จำนวนผู้ป่วยนอก(ครั้ง)'
  FROM opd_visits
  WHERE opd_visits.REG_DATETIME BETWEEN '20141001' AND '20150930'
  AND opd_visits.IS_CANCEL = 0";

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
        return $this->render('visits_opd58', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionVisits_ipd57(){
         $sql = "SELECT '' as 'แผนกที่รับบริการผู้ป่วยใน',count(VISIT_ID) AS 'จำนวนผู้ป่วยใน(ครั้ง)'
FROM ipd_reg
WHERE  ipd_reg.ADM_DT BETWEEN '20131001'  AND '20140930'
AND ipd_reg.IS_CANCEL = 0 ";
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
        return $this->render('visits_ipd57', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionVisits_opd57(){
         $sql = "SELECT '' as 'แผนกที่รับบริการผู้ป่วยนอก',count(VISIT_ID) AS 'จำนวนผู้ป่วยนอก(ครั้ง)'
  FROM opd_visits
  WHERE opd_visits.REG_DATETIME BETWEEN '20131001' AND '20140930'
  AND opd_visits.IS_CANCEL = 0";

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
        return $this->render('visits_opd57', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionVisits_ipd59(){
         $sql = "SELECT '' as 'แผนกที่รับบริการผู้ป่วยใน',count(VISIT_ID) AS 'จำนวนผู้ป่วยใน(ครั้ง)'
FROM ipd_reg
WHERE  ipd_reg.ADM_DT BETWEEN '20151001'  AND '20160930'
AND ipd_reg.IS_CANCEL = 0 ";
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
        return $this->render('visits_ipd59', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionVisits_opd59(){
         $sql = "SELECT '' as 'แผนกที่รับบริการผู้ป่วยนอก',count(VISIT_ID) AS 'จำนวนผู้ป่วยนอก(ครั้ง)'
  FROM view_opd_visits";

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
        return $this->render('visits_opd59', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,

        ]);
    }
    public function actionReferin59(){
        $sql = "SELECT hospid, hosp_name, COUNT(VISIT_ID) AS TOTAL
FROM mb_referin_list
GROUP BY hospid ORDER BY TOTAL DESC";
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
       return $this->render('referin59', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,

       ]);
   }

  }
