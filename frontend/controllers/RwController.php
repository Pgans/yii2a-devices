<?php

namespace frontend\controllers;

use yii;
use yii\data\ArrayDataProvider;

class RwController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionRw_sss(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
        $sql = "SELECT 'ผู้ป่วยในRW>1.8' as 'สิทธิ์ประกันสังคม'  ,COUNT(s.HN) as visits,SUM(s.DAYS+s.HOUR) AS  sleep
        FROM
        (SELECT a.VISIT_ID, b.HN, a.ADM_DT, a.ADM_ID ,a.DSC_DT, a.RW, a.DRG, a.ADJRW , p.TOWN_ID, b.INSCL,
        ((to_days(a.DSC_DT)*24)- (to_days(a.ADM_DT)*24))/24 AS DAYS, abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600)) as Times,
        CASE
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))>= 6  THEN '1'
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))< 6  THEN '0'
        END AS HOUR
        FROM ipd_reg a 
        INNER JOIN opd_visits b on a.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 
        INNER JOIN cid_hn c ON b.HN = c.HN
        INNER JOIN population p ON c.CID = p.CID  
        INNER JOIN main_inscls m ON b.INSCL = m.INSCL AND m.STD_CODE = '4200'
        INNER JOIN hosp_sss s ON p.CID = s.CID AND (s.DATE_ABORT >= date(a.ADM_DT) OR date(s.DATE_ABORT) =0) AND trim(s.HOSP_ID) <>'' 
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.IS_CANCEL = 0
        AND a.RW > 1.8
        GROUP BY a.VISIT_ID) AS s
        UNION
        SELECT 'ผู้ป่วยในRW>1.2-1.8' as 'สิทธิ์ประกันสังคม'  ,COUNT(s.HN) as visits,SUM(s.DAYS+s.HOUR) AS  sleep
        FROM
        (SELECT a.VISIT_ID, b.HN, a.ADM_DT, a.ADM_ID ,a.DSC_DT, a.RW, a.DRG, a.ADJRW , p.TOWN_ID, b.INSCL,
        ((to_days(a.DSC_DT)*24)- (to_days(a.ADM_DT)*24))/24 AS DAYS, abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600)) as Times,
        CASE
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))>= 6  THEN '1'
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))< 6  THEN '0'
        END AS HOUR
        FROM ipd_reg a 
        INNER JOIN opd_visits b on a.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 
        INNER JOIN cid_hn c ON b.HN = c.HN
        INNER JOIN population p ON c.CID = p.CID  
        INNER JOIN main_inscls m ON b.INSCL = m.INSCL AND m.STD_CODE = '4200'
        INNER JOIN hosp_sss s ON p.CID = s.CID AND (s.DATE_ABORT >= date(a.ADM_DT) OR date(s.DATE_ABORT) =0) AND trim(s.HOSP_ID) <>'' 
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.IS_CANCEL = 0
        AND LEFT(a.RW,3) IN (1.3,1.4,1.5,1.6,1.7,1.8)
        GROUP BY a.VISIT_ID) AS s 
        UNION
        SELECT 'ผู้ป่วยในRW>0.6-1.2' as 'สิทธิ์ประกันสังคม'  ,COUNT(s.HN) as visits,SUM(s.DAYS+s.HOUR) AS  sleep
        FROM
        (SELECT a.VISIT_ID, b.HN, a.ADM_DT, a.ADM_ID ,a.DSC_DT, a.RW, a.DRG, a.ADJRW , p.TOWN_ID, b.INSCL,
        ((to_days(a.DSC_DT)*24)- (to_days(a.ADM_DT)*24))/24 AS DAYS, abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600)) as Times,
        CASE
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))>= 6  THEN '1'
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))< 6  THEN '0'
        END AS HOUR
        FROM ipd_reg a 
        INNER JOIN opd_visits b on a.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 
        INNER JOIN cid_hn c ON b.HN = c.HN
        INNER JOIN population p ON c.CID = p.CID  
        INNER JOIN main_inscls m ON b.INSCL = m.INSCL AND m.STD_CODE = '4200'
        INNER JOIN hosp_sss s ON p.CID = s.CID AND (s.DATE_ABORT >= date(a.ADM_DT) OR date(s.DATE_ABORT) =0) AND trim(s.HOSP_ID) <>'' 
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.IS_CANCEL = 0
        AND LEFT(a.RW,3) IN (0.6,0.7,0.8,0.9,1.0,1.1,1.2)
        GROUP BY a.VISIT_ID) AS s 
        UNION
        SELECT 'ผู้ป่วยในRW<0.6' as 'สิทธิ์ประกันสังคม'  ,COUNT(s.HN) as visits,SUM(s.DAYS+s.HOUR) AS  sleep
        FROM
        (SELECT a.VISIT_ID, b.HN, a.ADM_DT, a.ADM_ID ,a.DSC_DT, a.RW, a.DRG, a.ADJRW , p.TOWN_ID, b.INSCL,
        ((to_days(a.DSC_DT)*24)- (to_days(a.ADM_DT)*24))/24 AS DAYS, abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600)) as Times,
        CASE
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))>= 6  THEN '1'
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))< 6  THEN '0'
        END AS HOUR
        FROM ipd_reg a 
        INNER JOIN opd_visits b on a.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 
        INNER JOIN cid_hn c ON b.HN = c.HN
        INNER JOIN population p ON c.CID = p.CID  
        INNER JOIN main_inscls m ON b.INSCL = m.INSCL AND m.STD_CODE = '4200'
        INNER JOIN hosp_sss s ON p.CID = s.CID AND (s.DATE_ABORT >= date(a.ADM_DT) OR date(s.DATE_ABORT) =0) AND trim(s.HOSP_ID) <>'' 
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.IS_CANCEL = 0
        AND a.RW <0.6
        GROUP BY a.VISIT_ID) AS s 
        UNION
        SELECT 'รวม' as 'สิทธิ์ประกันสังคม'  ,COUNT(s.HN) as visits,SUM(s.DAYS+s.HOUR) AS  sleep
        FROM
        (SELECT a.VISIT_ID, b.HN, a.ADM_DT, a.ADM_ID ,a.DSC_DT, a.RW, a.DRG, a.ADJRW , p.TOWN_ID, b.INSCL,
        ((to_days(a.DSC_DT)*24)- (to_days(a.ADM_DT)*24))/24 AS DAYS, abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600)) as Times,
        CASE
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))>= 6  THEN '1'
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))< 6  THEN '0'
        END AS HOUR
        FROM ipd_reg a 
        INNER JOIN opd_visits b on a.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 
        INNER JOIN cid_hn c ON b.HN = c.HN
        INNER JOIN population p ON c.CID = p.CID  
        INNER JOIN main_inscls m ON b.INSCL = m.INSCL AND m.STD_CODE = '4200'
        INNER JOIN hosp_sss s ON p.CID = s.CID AND (s.DATE_ABORT >= date(a.ADM_DT) OR date(s.DATE_ABORT) =0) AND trim(s.HOSP_ID) <>'' 
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.IS_CANCEL = 0
        GROUP BY a.VISIT_ID) AS s 
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
    return $this->render('rw_sss', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
               'date2'=>$date2
    
        ]);
      } 
      public function actionRw_sss_list(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT a.VISIT_ID, b.HN, a.ADM_DT, a.ADM_ID ,a.DSC_DT, a.RW, a.DRG, a.ADJRW , b.INSCL,
        ((to_days(a.DSC_DT)*24)- (to_days(a.ADM_DT)*24))/24 AS DAYS, abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600)) as Times,
        CASE
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))>= 6  THEN '1'
            WHEN abs((time_to_sec(a.DSC_DT)/3600) - (time_to_sec(a.ADM_DT)/3600))< 6  THEN '0'
        END AS HOUR
        FROM ipd_reg a 
        INNER JOIN opd_visits b on a.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 
        INNER JOIN cid_hn c ON b.HN = c.HN
        INNER JOIN population p ON c.CID = p.CID  
        INNER JOIN main_inscls m ON b.INSCL = m.INSCL AND m.STD_CODE = '4200'
        INNER JOIN hosp_sss s ON p.CID = s.CID AND (s.DATE_ABORT >= date(a.ADM_DT) OR date(s.DATE_ABORT) =0) AND trim(s.HOSP_ID) <>'' 
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.IS_CANCEL = 0
        GROUP BY a.VISIT_ID ";
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
    return $this->render('visit_sss_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
 }
        public function actionUc10953(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT 'ผู้ป่วยในRW>1.8' as 'สิทธิ์UCของโรงพยาบาลรหัส10953' ,COUNT(s.HN) as visits, SUM(s.days+s.hour) as sleep
        FROM
        (SELECT * FROM mb_uc10953  a
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.RW >1.8
        GROUP BY a.VISIT_ID) as s
        UNION
        SELECT 'ผู้ป่วยในRW>1.2-1.8' as 'สิทธิ์UCของโรงพยาบาลรหัส10953' ,COUNT(s.HN) as visits, SUM(s.days+s.hour) as sleep
        FROM
        (SELECT * FROM mb_uc10953  a
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND LEFT(a.RW,3) IN (1.3,1.4,1.5,1.6,1.7,1.8)
        GROUP BY a.VISIT_ID) as s
        UNION
        SELECT 'ผู้ป่วยในRW>=0.6-1.2' as 'สิทธิ์UCของโรงพยาบาลรหัส10953' ,COUNT(s.HN) as visits, SUM(s.days+s.hour) as sleep
        FROM
        (SELECT * FROM mb_uc10953  a
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND LEFT(a.RW,3) IN (0.6,0.7,0.8,0.9,1.0,1.1,1.2)
        GROUP BY a.VISIT_ID) as s
        UNION
        SELECT 'ผู้ป่วยในRW<0.6' as 'สิทธิ์UCของโรงพยาบาลรหัส10953' ,COUNT(s.HN) as visits, SUM(s.days+s.hour) as sleep
        FROM
        (SELECT * FROM mb_uc10953  a
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        AND a.RW <0.6
        GROUP BY a.VISIT_ID) as s
        UNION
        SELECT 'รวม' as 'สิทธิ์UCของโรงพยาบาลรหัส10953' ,COUNT(s.HN) as visits, SUM(s.days+s.hour) as sleep
        FROM
        (SELECT * FROM mb_uc10953  a
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        GROUP BY a.VISIT_ID) as s ";
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
        return $this->render('uc10953', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,
                'date1'=>$date1,
                'date2'=>$date2,

        ]);   
    }
    public function actionUc10953_list(){
        $date1 = Yii::$app->session['date1'];
        $date2 = Yii::$app->session['date2'];
        $sql = "SELECT * FROM mb_uc10953  a
        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
        GROUP BY a.VISIT_ID ";
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
    return $this->render('uc10953_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
  }
                public function actionUc_nokampur(){
                    $data = Yii::$app->request->post();
                    $date1 = isset($data['date1']) ? $data['date1'] : '';
                    $date2 = isset($data['date2']) ? $data['date2'] : '';

                $sql = "SELECT 'ผู้ป่วยในRW>1.8' as 'สิทธิ์UCนอกอำเภอในจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
                FROM
                (SELECT * FROM mb_uc_nokampur a
                WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
                AND a.RW> 1.8) AS s
                UNION
                SELECT 'ผู้ป่วยในRW>1.2-1.8' as 'สิทธิ์UCนอกอำเภอในจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
                FROM
                (SELECT * FROM mb_uc_nokampur a
                WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
                AND LEFT(a.RW,3) IN (1.3,1.4,1.5,1.6,1.7,1.8) ) AS s
                UNION
                SELECT 'ผู้ป่วยในRW>=0.6-1.2' as 'สิทธิ์UCนอกอำเภอในจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
                FROM
                (SELECT * FROM mb_uc_nokampur a
                WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
                AND LEFT(a.RW,3) IN (0.6,0.7,0.8,0.9,1.0,1.1,1.2) ) AS s
                UNION
                SELECT 'ผู้ป่วยในRW<0.6' as 'สิทธิ์UCนอกอำเภอในจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
                FROM
                (SELECT * FROM mb_uc_nokampur a
                WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
                AND a.rw <0.6) AS s
                UNION
                SELECT 'รวม' as 'สิทธิ์UCนอกอำเภอในจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
                FROM
                (SELECT * FROM mb_uc_nokampur a
                WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
                 ) AS s
                ";
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
                return $this->render('uc_nokampur', [
                        'dataProvider' => $dataProvider,
                        'sql'=>$sql,
                        'date1'=>$date1,
                        'date2'=>$date2,

                ]);   
       }
             public function actionUc_nokampur_list(){
                        $date1 = Yii::$app->session['date1'];
                        $date2 = Yii::$app->session['date2'];
                        $sql = "SELECT * FROM mb_uc_nokampur  a
                        WHERE a.ADM_DT BETWEEN '$date1' AND '$date2' ";
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
                    return $this->render('uc_nokampur_list', [
                                'dataProvider' => $dataProvider,
                                'sql'=>$sql,

                    ]);
                }
                public function actionNokchangwat(){
                    $data = Yii::$app->request->post();
                    $date1 = isset($data['date1']) ? $data['date1'] : '';
                    $date2 = isset($data['date2']) ? $data['date2'] : '';
        
                $sql = "SELECT 'ผู้ป่วยในRW>1.8' as 'สิทธิ์UCนอกจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
                FROM
             (SELECT * FROM mb_uc_nokchangwat a 
             WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
             AND a.RW >1.8
             GROUP BY a.VISIT_ID) as s
             UNION
             SELECT 'ผู้ป่วยในRW>1.2-1.8' as 'สิทธิ์UCนอกจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
            FROM
            (SELECT * FROM mb_uc_nokchangwat a 
            WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
            AND LEFT(a.RW,3) IN (1.3,1.4,1.5,1.6,1.7,1.8)
            GROUP BY a.VISIT_ID) as s
            UNION
             SELECT 'ผู้ป่วยในRW>0.6-1.2' as 'สิทธิ์UCนอกจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
            FROM
            (SELECT * FROM mb_uc_nokchangwat a 
            WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
            AND LEFT(a.RW,3) IN (0.6,0.7,0.8,0.9,1.0,1.1,1.2)
            GROUP BY a.VISIT_ID) as s
            UNION
             SELECT 'ผู้ป่วยในRW<0.6' as 'สิทธิ์UCนอกจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
            FROM
            (SELECT * FROM mb_uc_nokchangwat a 
            WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
            AND a.RW <0.6
            GROUP BY a.VISIT_ID) as s
            UNION
             SELECT 'รวม' as 'สิทธิ์UCนอกจังหวัด' , COUNT(s.visit_id) as visits, SUM(s.days+s.hour) as sleep
            FROM
            (SELECT * FROM mb_uc_nokchangwat a 
            WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
            GROUP BY a.VISIT_ID) as s ";
        
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
               return $this->render('nokchangwat', [
                           'dataProvider' => $dataProvider,
                           'sql'=>$sql,
                           'date1'=>$date1,
                           'date2'=>$date2,
        
               ]);   
             }
             public function actionNokchangwat_list(){
                $date1 = Yii::$app->session['date1'];
                $date2 = Yii::$app->session['date2'];
                $sql = "SELECT * FROM mb_uc_nokchangwat a 
                WHERE a.ADM_DT BETWEEN '$date1' AND '$date2'
                GROUP BY a.VISIT_ID";
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
            return $this->render('uc_nokchangwat_list', [
                        'dataProvider' => $dataProvider,
                        'sql'=>$sql,

            ]);
        }
}
