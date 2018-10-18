<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


include Yii::getAlias('@common').'/config/thai_date.php';

class ComputerController extends \yii\web\Controller
{
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['countdevices','saledevices','serviceout','devicenew'],
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
    public function actionCountdevices(){
                $sql = "SELECT DISTINCT categories.category_id AS 'cateid',category_name AS 'ประเภท' ,COUNT(category_name) AS 'จำนวน'
FROM devices, departments,categories
WHERE devices.dep_id = departments.dep_id
AND devices.category_id = categories.category_id
AND devices.sale_date = '0000-00-00'
AND devices.sale_date = ''
GROUP BY categories.category_name ORDER BY COUNT(category_name) DESC";
        $rawData = \yii::$app->db->createCommand($sql)->queryAll();
 $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        
       // print_r($rawData);
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('countdevices', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                   
        ]);
        
    }
    public function actionDevicelist($cateid) {
    		$sql = "SELECT DISTINCT device_serial AS 'หมายเลขครุภัณฑ์' , departments.dep_name AS 'แผนก', categories.category_name AS 'ประเภท',
spec AS 'รุ่นยี่ห้อ', purchase_date AS 'วันที่ซื้อ', due_date AS 'วันครบกำหนด', price AS 'ราคา' 
FROM devices , departments,categories 
WHERE  devices.dep_id = departments.dep_id
AND devices.category_id = categories.category_id
AND categories.category_id = $cateid
AND devices.sale_date = '0000-00-00'
ORDER BY  device_serial, purchase_date";
		 $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        
       // print_r($rawData);
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('devicelist', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                   
        ]);
        
    }
        
    public function actionSaledevices(){
       $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';

    	$sql = "SELECT DISTINCT device_serial , departments.dep_name ,
        categories.category_name ,spec ,purchase_date ,sale_date, price , orther 
        FROM devices , departments,categories 
        WHERE  devices.dep_id = departments.dep_id
        AND devices.category_id = categories.category_id
        AND devices.sale_date != '0000-00-00'
        AND (devices.sale_date between '$date1' AND '$date2')
        ORDER BY  sale_date DESC";
        /* if (!empty($date1) && !empty($date2)) {
            $sql.= " AND (devices.sale_date between '$date1' AND '$date2')";
        }
            $sql.= "ORDER BY  sale_date DESC";
        
         $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        
       // print_r($rawData);
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        */
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('saledevices', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,
                   
        ]);
        
    }
    	public function actionServiceout(){
       $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';
                
        	 $sql = "SELECT c.device_serial,c.device_name, d.category_name, 
        a.date_sent,a.date_in , a.price, a.orther, b.store_name 
        FROM serviceout a, store b,devices c, categories d
        WHERE a.store_id = b.store_id
        AND (a.date_sent between '$date1' AND '$date2')
        AND c.category_id= d.category_id
		AND a.device_id = c.device_id";
       /* if (!empty($date1) && !empty($date2)) {
            $sql.= " AND (a.date_sent between '$date1' AND '$date2')";
        }*/
         $rawData = \yii::$app->db->createCommand($sql)->queryAll();
 
        //print_r($rawData);
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('serviceout', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
     }
   
    public function actionDevicenew(){
       $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';
                
 $sql = "SELECT DISTINCT device_serial, departments.dep_name, categories.category_name,
spec, purchase_date, price ,due_date,orther
FROM devices , departments,categories 
WHERE  devices.dep_id = departments.dep_id
AND devices.category_id = categories.category_id
AND devices.sale_date = '0000-00-00'
AND devices.purchase_date BETWEEN '$date1' AND '$date2'
ORDER BY  device_serial, purchase_date";

        $rawData = \yii::$app->db->createCommand($sql)->queryAll();
 
       //print_r($rawData);
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('devicenew', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,
                   
        ]);
        
    }
    public function actionDevice59(){
       $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';

     $sql = "SELECT DISTINCT categories.category_id AS 'catid',category_name ,COUNT(category_name) AS amount FROM devices, departments,categories
WHERE devices.dep_id = departments.dep_id AND devices.category_id = categories.category_id
AND devices.sale_date = '0000-00-00'AND devices.sale_date = ''AND devices.purchase_date BETWEEN '$date1' AND '$date2'
GROUP BY categories.category_name ORDER BY COUNT(category_name) DESC";
        $rawData = \yii::$app->db->createCommand($sql)->queryAll();
       // print_r($rawData);
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        Yii::$app->session['date1']=$date1;
        Yii::$app->session['date2']=$date2;
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('device_all', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' =>$date1,
                    'date2' =>$date2,
                   
        ]);  
    }
    public function actionDevicelist59($catid) {
     $date1 = Yii::$app->session['date1'];
     $date2 = Yii::$app->session['date2'];
    		$sql = "SELECT DISTINCT device_serial, departments.dep_name, categories.category_id,categories.category_name,spec,purchase_date, price  
FROM devices , departments,categories WHERE  devices.dep_id = departments.dep_id AND devices.category_id = categories.category_id
AND categories.category_id = $catid AND devices.sale_date = '0000-00-00'
AND devices.purchase_date BETWEEN '$date1' AND '$date2'
ORDER BY  device_serial, purchase_date";

		 $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        // print_r($rawData);
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('devicelist59', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                   
        ]);  
    }
        public function actionDepdevices(){
        $data = Yii::$app->request->post();
        $depid = isset($data['depid']) ? $data['depid'] : 'null';
        
        $sql = "SELECT  a.device_serial , device_name,a.spec,b.category_name, c.dep_name, a.purchase_date,
                a.due_date, a.price
                FROM devices a, categories b , departments c
                WHERE a.category_id = b.category_id
                AND a.dep_id = c.dep_id
                AND c.dep_id = $depid
                AND a.sale_date = '0000-00-00' ORDER BY b.category_id";
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        // print_r($rawData);
            try {
                $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }
           // Yii::$app->session['date1']=$date1;
           //Yii::$app->session['date2']=$date2;
            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => FALSE,
            ]);
            return $this->render('depdevices', [
                        'dataProvider' => $dataProvider,
                        'sql'=>$sql,
                        'depid'=> $depid,
                        
                    
            ]);  
    }
    public function actionDepdevice_all(){
        $data = Yii::$app->request->post();
        $depid = isset($data['depid']) ? $data['depid'] : 'null';
        
        $sql = "SELECT  a.device_serial , device_name,a.spec,b.category_name, c.dep_name, a.purchase_date,
                a.due_date, a.price
                FROM devices a, categories b , departments c
                WHERE a.category_id = b.category_id
                AND a.dep_id = c.dep_id
                #AND c.dep_id = $depid
                AND a.sale_date = '0000-00-00' ORDER BY b.category_name";
            $rawData = \yii::$app->db->createCommand($sql)->queryAll();
        // print_r($rawData);
            try {
                $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }
           // Yii::$app->session['date1']=$date1;
           //Yii::$app->session['date2']=$date2;
            $dataProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $rawData,
                'pagination' => FALSE,
            ]);
            return $this->render('depdevices', [
                        'dataProvider' => $dataProvider,
                        'sql'=>$sql,
                        'depid'=> $depid,
                        
                    
            ]);  
    }
    public function actionMaterials(){
       $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';
                
 $sql = "SELECT * FROM mb_materials WHERE IVS_DATE BETWEEN '$date1' AND '$date2'
         AND IVC_ID = 04 ORDER BY IVS_DATE";

        $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
 
       //print_r($rawData);
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('materials', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,
                   
        ]);  
    }
    public function actionMaterial13(){
       $data = Yii::$app->request->post();
       $date1 = isset($data['date1']) ? $data['date1'] : '';
       $date2 = isset($data['date2']) ? $data['date2'] : '';
                
 $sql = "SELECT * FROM mb_materials WHERE IVS_DATE BETWEEN '$date1' AND '$date2'
         ORDER BY IVS_DATE";

        $rawData = \yii::$app->db2->createCommand($sql)->queryAll();
 
       //print_r($rawData);
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('material13', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                    'date1' => $date1,
                    'date2' => $date2,
                   
        ]);  
    } 
    public function actionDevices_all(){
        $data = Yii::$app->request->post();
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

    $sql = "SELECT b.category_id, b.category_name, COUNT(a.device_serial) AS amount
    FROM devices a
    INNER JOIN categories b ON a.category_id = b.category_id
    AND a.sale_date = '0000-00-00'
    GROUP BY b.category_name";
   $rawData = \yii::$app->db->createCommand($sql)->queryAll();

  // print_r($rawData);
   try {
       $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
   } catch (\yii\db\Exception $e) {
       throw new \yii\web\ConflictHttpException('sql error');
   }
   Yii::$app->session['date1']=$date1;
   Yii::$app->session['date2']=$date2;
   $dataProvider = new \yii\data\ArrayDataProvider([
       'allModels' => $rawData,
       'pagination' => FALSE,
   ]);
   return $this->render('devices_all', [
               'dataProvider' => $dataProvider,
               'sql'=>$sql,
               'date1'=>$date1,
               'date2'=>$date2,

   ]);   
}
    public function actionDevices_all_list($catid){
        $sql = "SELECT a.device_serial, device_name, a.spec, a.purchase_date, a.sale_date, b.category_name, a.price
        FROM devices a
        INNER JOIN categories b ON a.category_id = b.category_id
        WHERE a.category_id = $catid and a.sale_date = 0";
    $rawData = \yii::$app->db->createCommand($sql)->queryAll();

    // print_r($rawData);
    try {
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
    } catch (\yii\db\Exception $e) {
        throw new \yii\web\ConflictHttpException('sql error');
    }
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $rawData,
        'pagination' => FALSE,
    ]);
    return $this->render('devices_all_list', [
                'dataProvider' => $dataProvider,
                'sql'=>$sql,

    ]);
} 
}
