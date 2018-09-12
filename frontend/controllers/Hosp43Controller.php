<?php

namespace frontend\controllers;
use yii;
use yii\filters\AccessControl;
class Hosp43Controller extends \yii\web\Controller
{ 
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['ancman','servicesdeath','newborn','person100'],
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
    public function actionAncman(){
            //$data = Yii::$app->request->post();
            // $date1 = isset($data['date1']) ? $data['date1'] : '';
           //$date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT pa.hospcode,h.hosname,COUNT(DISTINCT pa.pid,pa.hospcode) AS 'จำนวนที่ถูกระบุเป็นเพศชายแต่มา ANC' 
        from t_person_anc pa
        INNER JOIN t_person_cid pc On pc.cid=pa.cid and pc.HOSPCODE=pa.hospcode
        LEFT OUTER JOIN chospital h ON h.hoscode=pa.hospcode
        WHERE pa.sex='1' and h.provcode='34' and h.distcode='14'
        GROUP BY pa.hospcode";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      // Yii::$app->session['date1']=$date1;
       //Yii::$app->session['date2']=$date2;
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('ancman', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   //'date1'=>$date1,
                   //'date2'=>$date2,

       ]);   
   }
   public function actionServicesdeaths(){
                 $data = Yii::$app->request->post();
                 $date1 = isset($data['date1']) ? $data['date1'] : '';
                 $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT c.CID, b.PID , a.DDEATH , b.DATE_SERV
                FROM death a, service b, person c
                WHERE b.DATE_SERV BETWEEN '$date1' AND '$date2' 
                AND a.PID = b.PID AND a.PID = c.PID AND b.DATE_SERV > a.DDEATH GROUP BY c.CID ";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      // Yii::$app->session['date1']=$date1;
       //Yii::$app->session['date2']=$date2;
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('service_death', [
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
            WHERE mu_date = $mudate AND mu_date BETWEEN '$date1' AND '$date2'";
        $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

        // print_r($rawData);
        try {
            $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
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
        public function actionNewborn(){
                 $data = Yii::$app->request->post();
                 $date1 = isset($data['date1']) ? $data['date1'] : '';
                 $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT b.CID,a.PID,a.MPID,a.BDATE, b.BIRTH,FLOOR(DATEDIFF(NOW(),b.BIRTH)/365.25) AS AGE
                FROM newborn a, person b
                WHERE a.BDATE BETWEEN '$date1' AND '$date2'
                AND a.PID = b.PID AND a.BDATE != b.BIRTH";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('newborn', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
   public function actionNewborn_ssj(){
                 $data = Yii::$app->request->post();
                 $date1 = isset($data['date1']) ? $data['date1'] : '';
                 $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  * FROM mb_newborn_diag WHERE BDATE BETWEEN '$date1' AND '$date2'AND DIAGCODE = 'Z380' GROUP BY PID";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('rpt_newborn_ssj', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
   public function actionNewborn_60(){
                 $data = Yii::$app->request->post();
                 $date1 = isset($data['date1']) ? $data['date1'] : '';
                 $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT 'จำนวนทารกเกิด ' AS 'ข้อมูลปี2560',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2016-10-01' AND '2016-10-31') AS 'Oct',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2016-11-01' AND '2016-11-30') AS 'Sep',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2016-12-01' AND '2016-12-31') AS 'Dec',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-01-01' AND '2017-01-31') AS 'Jan',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-02-01' AND '2017-02-28') AS 'Feb',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-03-01' AND '2017-03-31') AS 'March',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-04-01' AND '2017-04-30') AS 'April',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-05-01' AND '2017-05-31') AS 'May',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-06-01' AND '2017-06-30') AS 'June',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-07-01' AND '2017-07-31') AS 'July',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-08-01' AND '2017-08-31') AS 'August',
(SELECT COUNT(PID) FROM newborn WHERE BDATE BETWEEN '2017-09-01' AND '2017-09-30') AS 'September'

-- sum(bill_amt) as Total
from newborn
where BDATE BETWEEN '2016-10-01' AND '2017-09-30'
group by 'จำนวนทารก'
order by PID";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('rpt_newborn_60', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
   public function actionDeath_all(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT  *
FROM death
WHERE  DDEATH BETWEEN '$date1' AND '$date2'
GROUP BY PID  ORDER BY DDEATH ";
        $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

       // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('deathall', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
   public function actionPerson100(){
                 $data = Yii::$app->request->post();
                 $date1 = isset($data['date1']) ? $data['date1'] : '';
                 $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT HOSPCODE,HN, `NAME`, LNAME, SEX, BIRTH,FLOOR(DATEDIFF(NOW(),BIRTH)/365.25) AS 'AGE',NATION, TYPEAREA
FROM person
WHERE FLOOR(DATEDIFF(NOW(),BIRTH)/365.25) >'100'
AND D_UPDATE BETWEEN '$date1' AND '$date2'";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('person100', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1'=> $date1,
                   'date2'=> $date2,
       ]);   
   }
   public function actionNewborn43(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT DISTINCT YEAR(BDATE) AS YYYY, MONTH(BDATE) AS MM , COUNT(BDATE) AS AMOUNT
                FROM newborn
                WHERE BDATE BETWEEN '$date1' AND '$date2' 
                AND BHOSP = '10953'
                GROUP BY YYYY,MM ";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       Yii::$app->session['date1'] = $date1;
       Yii::$app->session['date2'] = $date2;
       return $this->render('newborn43', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
       
   }
   public function actionBweight(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.PID, a.MPID, a.BDATE, a.BTIME, a.BHOSP,a.BPLACE,a.GA ,a.GRAVIDA , a.BWEIGHT
                FROM newborn a
                WHERE a.BDATE BETWEEN  '$date1' AND '$date2'
                AND(a.BWEIGHT <1000 OR a.BWEIGHT> 4000)
                GROUP BY a.PID ";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       Yii::$app->session['date1'] = $date1;
       Yii::$app->session['date2'] = $date2;
       return $this->render('bweight', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
   }
   public function actionAncresult(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT PID, SEQ, DATE_SERV, GRAVIDA, ANCNO, GA,ANCRESULT , PROVIDER
                FROM anc
                WHERE DATE_SERV BETWEEN '$date1' AND '$date2'
                AND ANCRESULT = 2
                GROUP BY PID  ";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       Yii::$app->session['date1'] = $date1;
       Yii::$app->session['date2'] = $date2;
       return $this->render('ancresult', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
   }
   public function actionDxopdw(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT * FROM mb_dxopd_wrong WHERE date_serv BETWEEN '$date1' AND '$date2'";
       $rawData = \yii::$app->db4->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       Yii::$app->session['date1'] = $date1;
       Yii::$app->session['date2'] = $date2;
       return $this->render('dxopd_wrong', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' =>$date1,
                   'date2' =>$date2,

       ]);
   }
}
