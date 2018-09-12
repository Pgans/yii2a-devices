<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                       'roles' => ['@'],
                       #'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
    
     */
    
       public function actionIndex() {
        $connection = Yii::$app->db2;
        $datao = $connection->createCommand('
            SELECT a.fiscal , COUNT(a.visit_id) AS acvisits, COUNT(DISTINCT a.HN ) AS achuman
            FROM mb_accidents_fiscal a
            ')->queryAll();

            $acdataProvider = new ArrayDataProvider([
            'allModels' => $datao,
            'sort'=>[
                'attributes'=>['fiscal','acivisits','achuman']
            ],
        ]);
        //เตรียมข้อมูลส่งให้กราฟ
        for($i=0;$i<sizeof($datao);$i++){
            $acfiscal[] = $datao[$i]['fiscal'];        
            $acvisits[] =intval($datao[$i]['acvisits']);
            $achuman[] = (int) $datao[$i]['achuman'];
        }
        //Visits มารับบริการOPD
       $dataopd = $connection->createCommand("
        SELECT  fiscal, COUNT(VISIT_ID) AS ovisits, COUNT(DISTINCT HN) AS hn
        FROM mb_opd_visits_fiscal
        GROUP BY fiscal 
        ")->queryAll(); 

        $opddataProvider = new ArrayDataProvider([
            'allModels' => $dataopd,
            'sort'=>[
                'attributes'=>['fiscal','hn','ovisits']
            ],
        ]);
        //เตรียมข้อมูลผู้ป่วยนอกส่งให้กราฟ
        for ($i = 0; $i < sizeof($dataopd); $i++) {
            $fiscal[] = $dataopd[$i]['fiscal'];
            $hn[] = (int) $dataopd[$i]['hn'];
            $ovisits[] = (int) $dataopd[$i]['ovisits'];
            
        }
        //Visits นอนโรงพยาบาล
       $datai = $connection->createCommand("
        SELECT fiscal, COUNT(DISTINCT visits) AS ivisits, SUM(amount) AS sleepday
        FROM mb_ipdreg_fiscal 
        GROUP BY fiscal")->queryAll(); 

        $idataProvider = new ArrayDataProvider([
            'allModels' => $datai,
            'sort'=>[
                'attributes'=>['fiscal','ivisits','sleepday']
            ],
        ]);
        //เตรียมข้อมูลผู้ป่วยในส่งให้กราฟ
        for ($i = 0; $i < sizeof($datai); $i++) {
            $ifiscal[] = $datai[$i]['fiscal'];
            $ivisits[] = (int) $datai[$i]['ivisits'];
            $sleepday[] = (int) $datai[$i]['sleepday'];
        }
        //Refers ผู้ป่วยนอกส่งต่อ
       $datarf = $connection->createCommand("
        SELECT  a.fiscal , COUNT(a.VISIT_ID) AS rfvisits
        FROM mb_referout_opd_fiscal a
        GROUP BY a.fiscal")->queryAll(); 

        $rfdataProvider = new ArrayDataProvider([
            'allModels' => $datarf,
            'sort'=>[
                'attributes'=>['fiscal','rfvisits']
            ],
        ]);
        //เตรียมข้อมูลผู้ป่วยนอกส่งต่อส่งให้กราฟ
        for ($i = 0; $i < sizeof($datarf); $i++) {
            $rfiscal[] = $datarf[$i]['fiscal'];
            $rfvisits[] = (int) $datarf[$i]['rfvisits'];
        }
        //Refers ผู้ป่วยในส่งต่อ
       $datari = $connection->createCommand("
        SELECT  a.fiscal , COUNT(a.VISIT_ID) AS rfvisits
        FROM mb_referout_ipd_fiscal a
        GROUP BY a.fiscal")->queryAll(); 

        $ridataProvider = new ArrayDataProvider([
            'allModels' => $datari,
            'sort'=>[
                'attributes'=>['fiscal','rfvisits']
            ],
        ]);
        //เตรียมข้อมูลผู้ป่วยในส่งต่อส่งให้กราฟ
        for ($i = 0; $i < sizeof($datari); $i++) {
            $rifiscal[] = $datari[$i]['fiscal'];
            $rivisits[] = (int) $datari[$i]['rfvisits'];
        }
        //ซือคอมพิวเตอร์และอุปกรณ์ต่อพ่วง
        $connection = Yii::$app->db;
       $datacom = $connection->createCommand("
        SELECT  fiscal , 
                COUNT(CASE WHEN (category_id = 1) THEN 1 END )  AS  PC,
                COUNT(CASE WHEN (category_id = 2) THEN 2 END )  AS  NB,
                COUNT(CASE WHEN (category_id =3) THEN 3 END )  AS  PrinLaser,
                COUNT(CASE WHEN (category_id = 4) THEN 4 END )  AS  PrinInk,
                COUNT(CASE WHEN (category_id = 5) THEN 5 END )  AS  UPS,
                COUNT(CASE WHEN (category_id = 9) THEN 9 END )  AS  LCD,
                COUNT(CASE WHEN (category_id = 10 ) THEN 10 END )  AS  Termal ,
                COUNT(CASE WHEN (category_id = 13) THEN 13  END )  AS  Scan,
                COUNT(CASE WHEN (category_id >0) THEN 14  END )  AS  Total,
                SUM(price) AS Price
            FROM mb_devices_fiscal
            WHERE purchase_date > '20081001'
            GROUP BY fiscal ")->queryAll(); 

        $comdataProvider = new ArrayDataProvider([
            'allModels' => $datacom,
            'sort'=>[
                'attributes'=>['fiscal','Total','Price']
            ],
        ]);
        //เตรียมข้อมูลคอมพิวเตอร์ส่งให้กราฟ
        for ($i = 0; $i < sizeof($datacom); $i++) {
            $cfiscal[] = $datacom[$i]['fiscal'];
            $total[] = (int) $datacom[$i]['Total'];
            $price[] = (int) $datacom[$i]['Price'];
        }
        //สรุปคอมพิวเตอร์และอุปกรณ์ต่อพ่วง
        $connection = Yii::$app->db;
       $datam = $connection->createCommand("
        SELECT  'จำนวนเครื่อง' AS ประเภท,
        COUNT(CASE WHEN (category_id = 1) THEN 1 END )  AS  PC,
        COUNT(CASE WHEN (category_id = 2) THEN 2 END )  AS  NoteBook,
        COUNT(CASE WHEN (category_id =3) THEN 3 END )  AS  PrinLaser,
        COUNT(CASE WHEN (category_id = 4) THEN 4 END )  AS  PrinInk,
        COUNT(CASE WHEN (category_id = 10 ) THEN 10 END )  AS  Termal ,
        COUNT(CASE WHEN (category_id = 13) THEN 13  END )  AS  Scan,
        COUNT(CASE WHEN (category_id IN (1,2,3,4,10,13)) THEN 14  END )  AS  Total
        FROM  mb_devices_fiscal ")->queryAll(); 

        $cdataProvider = new ArrayDataProvider([
            'allModels' => $datam,
            'sort'=>[
                'attributes'=>['fiscal','Total','Price']
            ],
        ]);
        //เตรียมข้อมูลคอมพิวเตอร์ส่งให้กราฟ
        for ($i = 0; $i < sizeof($datam); $i++) {
            $pc[] = (int) $datam[$i]['PC'];
            $nb[] = (int) $datam[$i]['NoteBook'];
            $laser[] = (int) $datam[$i]['PrinLaser'];
            $ink[] = (int) $datam[$i]['PrinInk'];
            $termal[] = (int) $datam[$i]['Termal'];
            $scan[] = (int) $datam[$i]['Scan'];
        }
        //newborn คัดจากanc_outcome
        $connection = Yii::$app->db2;
       $databa = $connection->createCommand("
        SELECT  a.fiscal , COUNT(a.CID_BABY) AS cidbaby
        FROM mb_newborn_fiscal a
        GROUP BY a.fiscal")->queryAll(); 

        $babydataProvider = new ArrayDataProvider([
            'allModels' => $databa,
            'sort'=>[
                'attributes'=>['fiscal','cidbaby']
            ],
        ]);
        //เตรียมข้อมูลคอมพิวเตอร์ส่งให้กราฟ
        for ($i = 0; $i < sizeof($databa); $i++) {
            $babyfiscal[] = $databa[$i]['fiscal'];
            $cidbaby[] = (int) $databa[$i]['cidbaby'];
        }

         return $this->render('index', [
                    'acdataProvider' => $acdataProvider,
                    'cipdData' => $idataProvider,
                    'acfiscal'=> $acfiscal,
                    'acvisits' => $acvisits,
                    'achuman' => $achuman,
                    'ovisits' => $ovisits,
                    'hn' => $hn,
                    'fiscal' => $fiscal,
                    'opddataProvider' => $opddataProvider,
                    'ifiscal' => $ifiscal,
                    'ivisits' =>$ivisits,
                    'sleepday' =>$sleepday,
                    'idataProvider'=> $idataProvider,
                    'rfiscal' =>$rfiscal,
                    'rfvisits' => $rfvisits,
                    'rfdataProvider' =>$rfdataProvider,
                    'rifiscal'=>$rifiscal,
                    'rivisits' =>$rivisits,
                    'ridataProvider' =>$ridataProvider,
                    'comdataProvider' =>$comdataProvider,
                    'Total' =>$total,
                    'price'=>$price,
                    'cfiscal'=>$cfiscal,
                    'cdataProvider' =>$cdataProvider,
                    'pc'=>$pc,
                    'nb'=>$nb,
                    'laser' =>$laser,
                    'ink'=>$ink,
                    'termal'=>$termal,
                    'scan'=>$scan,
                    'babydataProvider' =>$babydataProvider,
                    'babyfiscal' => $babyfiscal,
                    'cidbaby'=> $cidbaby,


        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        
    }
     

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
   
//      public function actionDxipd(){
//         $data = Yii::$app->request->post();
//         $date1 = isset($data['date1']) ? $data['date1'] : '';
//         $date2 = isset($data['date2']) ? $data['date2'] : '';


//         $sql = "SELECT ICD10_TM,ICD_NAME, COUNT(ICD_NAME) AS  amount
// FROM mb_ipddx
// WHERE DSC_DT between '20161001' and '20170930'
// GROUP BY ICD_NAME ORDER BY amount DESC LIMIT 15";
//        $rawData = \yii::$app->db2->createCommand($sql)->queryAll();

//       // print_r($rawData);
//        try {
//            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
//        } catch (\yii\db2\Exception $e) {
//            throw new \yii\web\ConflictHttpException('sql error');
//        }
//        $dataProvider = new \yii\data\ArrayDataProvider([
//            'allModels' => $rawData,
//            'pagination' => FALSE,
//        ]);
//        return $this->render('index', [
//                    'dataProvider' => $dataProvider,
//                    'sql'=>$sql,

//        ]);
//    }
}
