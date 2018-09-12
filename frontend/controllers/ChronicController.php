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
}
