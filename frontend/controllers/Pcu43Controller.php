<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii;
class Pcu43Controller extends \yii\web\Controller
{
   public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['ancman','chronic','dmht','cancerscreen'],
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
       $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
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
        public function actionOutstan_list($mudate){
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
            $sql = "SELECT * FROM mb_outstan
            WHERE mu_date = $mudate AND mu_date BETWEEN '$date1' AND '$date2'";
        $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

        // print_r($rawData);
        try {
            $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
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
    public function actionChronic(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.cid,b.name, b.lname, a.birth,a.age_y,a.sex, a.p_typearea, a.diagcode, a.date_dx, a.p_pt_vhid AS address
FROM t_chronic a ,person b
WHERE a.date_dx BETWEEN '$date1' AND '$date2'AND a.cid = b.cid ";
       $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('chronic-address', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' => $date1,
                   'date2' => $date2,
                   

       ]);   
    }
    public function actionDm(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.cid,b.name, b.lname, a.birth,a.age_y,a.sex, a.p_typearea, a.diagcode, a.date_dx, a.p_pt_vhid AS address
FROM t_chronic a ,person b
WHERE a.date_dx BETWEEN '$date1' AND '$date2'AND a.cid = b.cid  AND left(a.diagcode,1) = 'E' GROUP BY a.cid " ;
       $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('dm', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' => $date1,
                   'date2' => $date2,
                   

       ]);   
    }
     public function actionHt(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.cid,b.name, b.lname, a.birth,a.age_y,a.sex, a.p_typearea, a.diagcode, a.date_dx, a.p_pt_vhid AS address
FROM t_chronic a ,person b
WHERE a.date_dx BETWEEN '$date1' AND '$date2'AND a.cid = b.cid  AND left(a.diagcode,1) = 'I' GROUP BY a.cid " ;
       $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('ht', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' => $date1,
                   'date2' => $date2,
                   

       ]);   
    }
    public function actionDmht(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.cid,b.name, b.lname, a.birth,a.age_y,a.sex, a.p_typearea, a.diagcode, a.date_dx, a.p_pt_vhid AS address
FROM t_chronic a ,person b
WHERE a.date_dx BETWEEN '$date1' AND '$date2'AND a.cid = b.cid  AND (left(a.diagcode,1) = 'E'OR left(a.diagcode,1) = 'I' )
GROUP BY a.cid " ;
       $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('dm-ht', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' => $date1,
                   'date2' => $date2,
                   

       ]);   
    }
    public function actionCancerscreen(){
            $data = Yii::$app->request->post();
            $date1 = isset($data['date1']) ? $data['date1'] : '';
            $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT a.PID ,a.SEQ, a.DATE_SERV , a.PPSPECIAL, b.CID, b.TYPEAREA,b.NATION, FLOOR(DATEDIFF(NOW(),b.BIRTH)/365.25) AS AGE
                FROM specialpp a, person b
                WHERE a.PPSPECIAL IN ('1B0030','1B0031','1B0034','1B0035')
                AND a.DATE_SERV BETWEEN '$date1' AND '$date2'
                AND a.PID = b.PID
                AND FLOOR(DATEDIFF(NOW(),b.BIRTH)/365.25) NOT BETWEEN '30' AND '70' 
                GROUP BY a.PID ORDER BY a.DATE_SERV DESC";
       $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
      
       $dataProvider = new \yii\data\ArrayDataProvider([
           'allModels' => $rawData,
           'pagination' => FALSE,
       ]);
       return $this->render('cancer_screen', [
                   'dataProvider' => $dataProvider,
                   'sql'=>$sql,
                   'date1' => $date1,
                   'date2' => $date2,
                   

       ]);   
    }
    public function actionDeaths(){
                 $data = Yii::$app->request->post();
                 $date1 = isset($data['date1']) ? $data['date1'] : '';
                 $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT c.CID, b.PID , a.DDEATH , b.DATE_SERV
                FROM death a, service b, person c
                WHERE b.DATE_SERV BETWEEN '$date1' AND '$date2' 
                AND a.PID = b.PID AND a.PID = c.PID AND b.DATE_SERV > a.DDEATH GROUP BY c.CID ";
       $rawData = \yii::$app->db5->createCommand($sql)->queryAll();

      // print_r($rawData);
       try {
           $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
       } catch (\yii\db2\Exception $e) {
           throw new \yii\web\ConflictHttpException('sql error');
       }
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
}
