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
            FROM mb_accidents_fiscal a group by a.fiscal
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
       SELECT k.fiscal, k.ovisits, k.hn,  AVG(k.ovisits)/365.25 AS avisit, AVG(hn)/365.25 AS kon
       FROM (
       SELECT  fiscal, COUNT(VISIT_ID) AS ovisits, COUNT(DISTINCT HN) AS hn 
               FROM mb_opd_visits_fiscal
               GROUP BY fiscal ) as k  
                       GROUP BY k.fiscal
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
        // นับผู้ป่วยมารับบริการOPDแยกตามแผนก
       $dataopdu = $connection->createCommand("
       SELECT  a.fiscal as FISCAL, 
        COUNT(CASE WHEN a.UNIT_REG = 02 THEN '1' END ) AS 'OPD',
        COUNT(CASE WHEN a.UNIT_REG = 11 THEN '2' END ) AS 'ER',
        COUNT(CASE WHEN a.UNIT_REG = 26 THEN '3' END ) AS 'THAIMED', 
        COUNT(CASE WHEN a.UNIT_REG = 31 THEN '4' END ) AS 'PHISICAL',
        COUNT(CASE WHEN a.UNIT_REG = 40 THEN '5' END ) AS 'VIP'
        FROM mb_opd_visits_fiscal a
        WHERE a.REG_DATETIME BETWEEN '2015-10-01' AND '2020-09-30'
        GROUP BY a.fiscal  
        ")->queryAll(); 

        $uopddataProvider = new ArrayDataProvider([
            'allModels' => $dataopdu,
            'sort'=>[
                'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
            ],
        ]);
        //เตรียมข้อมูลผู้ป่วยนอกส่งให้กราฟ
        for ($i = 0; $i < sizeof($dataopdu); $i++) {
            $fiscal[] = $dataopdu[$i]['FISCAL'];
            $opd[] = (int) $dataopdu[$i]['OPD'];
            $er[] = (int) $dataopdu[$i]['ER'];
            $thaimed[] = (int) $dataopdu[$i]['THAIMED'];
            $phisical[] = (int) $dataopdu[$i]['PHISICAL'];
            $vip[] = (int) $dataopdu[$i]['VIP'];
            
        }
        // 10 อันดับโรคผู้ป่วยนอก ปีงบ2560
       $dataopd1060 = $connection->createCommand("
       SELECT a.ICD10_TM, a.ICD_NAME , COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_opd_visits_fiscal a
        WHERE a.REG_DATETIME BETWEEN '2016-10-01 00:01' AND '2017-09-30 23:59'
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99' AND a.ICD10_TM <> 'U778'
        GROUP BY a.ICD10_TM ORDER BY AMOUNT DESC  LIMIT 10
        ")->queryAll(); 

        $opd1060dataProvider = new ArrayDataProvider([
            'allModels' => $dataopd1060,
            'sort'=>[
                'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
            ],
        ]);
         // 10 อันดับโรคผู้ป่วยนอก ปีงบ2561
       $dataopd1061 = $connection->createCommand("
       SELECT a.ICD10_TM, a.ICD_NAME , COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_opd_visits_fiscal a
        WHERE a.REG_DATETIME BETWEEN '2017-10-01 00:01' AND '2018-09-30 23:59'
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99' AND a.ICD10_TM <> 'U778'
        GROUP BY a.ICD10_TM ORDER BY AMOUNT DESC  LIMIT 10
        ")->queryAll(); 

        $opd1061dataProvider = new ArrayDataProvider([
            'allModels' => $dataopd1061,
            'sort'=>[
                'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
            ],
        ]);
         // 10 อันดับโรคผู้ป่วยนอก ปีงบ2562
       $dataopd1062 = $connection->createCommand("
       SELECT a.ICD10_TM, a.ICD_NAME , COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_opd_visits_fiscal a
        WHERE a.REG_DATETIME BETWEEN '2018-10-01 00:01' AND '2019-09-30 23:59'
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99' AND a.ICD10_TM <> 'U778'
        GROUP BY a.ICD10_TM ORDER BY AMOUNT DESC  LIMIT 10
        ")->queryAll(); 

        $opd1062dataProvider = new ArrayDataProvider([
            'allModels' => $dataopd1062,
            'sort'=>[
                'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
            ],
        ]);
       // 10 อันดับโรค IPD ปีงบ2560
       $dataipd1060 = $connection->createCommand("
       SELECT c.ICD10_TM ,c.ICD_NAME , COUNT(c.ICD10_TM) as AMOUNT
       FROM ipd_reg i
       LEFT JOIN opd_diagnosis b ON i.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 AND b.DXT_ID = 1
       LEFT JOIN icd10new c ON b.ICD10 = c.ICD10
       WHERE i.ADM_DT BETWEEN '2016.10.01 00:01' AND '2017.09.30 23:59'
       AND i.WARD_NO = 38
       GROUP BY c.ICD10_TM ORDER BY amount DESC LIMIT 10
        ")->queryAll(); 

        $ipd1060dataProvider = new ArrayDataProvider([
            'allModels' => $dataipd1060,
            'sort'=>[
                'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
            ],
        ]);
        // 10 อันดับโรค IPD ปีงบ2561
       $dataipd1061 = $connection->createCommand("
       SELECT c.ICD10_TM ,c.ICD_NAME , COUNT(c.ICD10_TM) as AMOUNT
        FROM ipd_reg i
        LEFT JOIN opd_diagnosis b ON i.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 AND b.DXT_ID = 1
        LEFT JOIN icd10new c ON b.ICD10 = c.ICD10
        WHERE i.ADM_DT BETWEEN '2017.10.01 00:01' AND '2018.09.30 23:59'
        AND i.WARD_NO = 38
        GROUP BY c.ICD10_TM ORDER BY amount DESC LIMIT 10
        ")->queryAll(); 

        $ipd1061dataProvider = new ArrayDataProvider([
            'allModels' => $dataipd1061,
            'sort'=>[
                'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
            ],
        ]);
        // 10 อันดับโรค IPD ปีงบ2562
       $dataipd1062 = $connection->createCommand("
       SELECT c.ICD10_TM ,c.ICD_NAME , COUNT(c.ICD10_TM) as AMOUNT
        FROM ipd_reg i
        LEFT JOIN opd_diagnosis b ON i.VISIT_ID = b.VISIT_ID AND b.IS_CANCEL = 0 AND b.DXT_ID = 1
        LEFT JOIN icd10new c ON b.ICD10 = c.ICD10
        WHERE i.ADM_DT BETWEEN '2018.10.01 00:01' AND '2019.09.30 23:59'
        AND i.WARD_NO = 38
        GROUP BY c.ICD10_TM ORDER BY amount DESC LIMIT 10
        ")->queryAll(); 

        $ipd1062dataProvider = new ArrayDataProvider([
            'allModels' => $dataipd1062,
            'sort'=>[
                'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
            ],
        ]);
         // 10 อันดับโรคเสียชีวิตในโรงพยาบาล ปีงบ2560
         $datadeath1060 = $connection->createCommand("
            SELECT d.CDEATH,i.ICD_NAME,COUNT(d.CDEATH) AS AMOUNT
            FROM deaths d
            RIGHT  JOIN icd10new i ON d.CDEATH = i.ICD10_TM
            WHERE d.DEATH_DATE BETWEEN '2016-10-01' AND '2017-09-30'
            AND d.is_cancel = 0
            AND d.CDEATH <> ''
            GROUP BY d.CDEATH ORDER BY amount DESC  LIMIT 10
      ")->queryAll(); 
      $death1060dataProvider = new ArrayDataProvider([
          'allModels' => $datadeath1060,
          'sort'=>[
              'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
          ],
      ]);
        //// 10 อันดับโรคเสียชีวิตในโรงพยาบาล ปีงบ2561 ////
        $datadeath1061 = $connection->createCommand("
            SELECT d.CDEATH,i.ICD_NAME,COUNT(d.CDEATH) AS AMOUNT
            FROM deaths d
            RIGHT  JOIN icd10new i ON d.CDEATH = i.ICD10_TM
            WHERE d.DEATH_DATE BETWEEN '2017-10-01' AND '2018-09-30'
            AND d.is_cancel = 0
            AND d.CDEATH <> ''
            GROUP BY d.CDEATH ORDER BY amount DESC  LIMIT 10
         ")->queryAll(); 
         $death1061dataProvider = new ArrayDataProvider([
             'allModels' => $datadeath1061,
             'sort'=>[
                 'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
             ],
         ]);
        //// 10 อันดับโรคเสียชีวิตในโรงพยาบาล ปีงบ2562
        $datadeath1062 = $connection->createCommand("
            SELECT d.CDEATH,i.ICD_NAME,COUNT(d.CDEATH) AS AMOUNT
            FROM deaths d
            RIGHT  JOIN icd10new i ON d.CDEATH = i.ICD10_TM
            WHERE d.DEATH_DATE BETWEEN '2018-10-01' AND '2019-09-30'
            AND d.is_cancel = 0
            AND d.CDEATH <> ''
            GROUP BY d.CDEATH ORDER BY amount DESC  LIMIT 10
     ")->queryAll(); 
     $death1062dataProvider = new ArrayDataProvider([
         'allModels' => $datadeath1062,
         'sort'=>[
             'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
         ],
     ]);
         //// 10 อันดับโรค Refers แผนกตรวจโรคทั่วไป ปีงบ2560 ////
        $datarf_opd1060 = $connection->createCommand("
        SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_opd_fiscal a
        WHERE a.fiscal = '2560'
        AND a.UNIT_ID = 02
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
     ")->queryAll(); 
     $rf_opd1060dataProvider = new ArrayDataProvider([
         'allModels' => $datarf_opd1060,
         'sort'=>[
             'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
         ],
     ]);
      //// 10 อันดับโรค Refers แผนกตรวจโรคทั่วไป ปีงบ2561 ////
      $datarf_opd1061 = $connection->createCommand("
      SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
      FROM mb_referout_opd_fiscal a
      WHERE a.fiscal = '2561'
      AND a.UNIT_ID = 02
      AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
      GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
   ")->queryAll(); 
   $rf_opd1061dataProvider = new ArrayDataProvider([
       'allModels' => $datarf_opd1061,
       'sort'=>[
           'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
       ],
   ]);
    //// 10 อันดับโรค Refers แผนกตรวจโรคทั่วไป ปีงบ2562 ////
    $datarf_opd1062 = $connection->createCommand("
    SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
    FROM mb_referout_opd_fiscal a
    WHERE a.fiscal = '2562'
    AND a.UNIT_ID = 02
    AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
    GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
 ")->queryAll(); 
 $rf_opd1062dataProvider = new ArrayDataProvider([
     'allModels' => $datarf_opd1062,
     'sort'=>[
         'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
     ],
 ]);
     //// 10 อันดับโรค Refers ER ปีงบ2560 ////
     $datarf_er1060 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
     FROM mb_referout_opd_fiscal a
     WHERE a.fiscal = '2560'
     AND a.UNIT_ID = 11
     AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
     GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_er1060dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_er1060,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      //// 10 อันดับโรค Refers ER ปีงบ2561 ////
     $datarf_er1061 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
     FROM mb_referout_opd_fiscal a
     WHERE a.fiscal = '2561'
     AND a.UNIT_ID = 11
     AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
     GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_er1061dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_er1061,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      //// 10 อันดับโรค Refers ER ปีงบ2562 ////
     $datarf_er1062 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
     FROM mb_referout_opd_fiscal a
     WHERE a.fiscal = '2562'
     AND a.UNIT_ID = 11
     AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
     GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_er1062dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_er1062,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      //// 10 อันดับโรค Refers LR ปีงบ2560 ////
     $datarf_lr1060 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2560'
        AND a.UNIT_ID = 22
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_lr1060dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_lr1060,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
       //// 10 อันดับโรค Refers LR ปีงบ2561 ////
     $datarf_lr1061 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2561'
        AND a.UNIT_ID = 22
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_lr1061dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_lr1061,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]); 
       //// 10 อันดับโรค Refers LR ปีงบ2560 ////
     $datarf_lr1062 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2562'
        AND a.UNIT_ID = 22
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_lr1062dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_lr1062,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]); 
            //// 10 อันดับโรค Refers ผู้ป่วยในบน ปีงบ2560 ////
     $datarf_ward2_1060 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2560'
        AND a.UNIT_ID = 38
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_ward21060dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_ward2_1060,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      
            //// 10 อันดับโรค Refers ผู้ป่วยในบน ปีงบ2561 ////
     $datarf_ward2_1061 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2561'
        AND a.UNIT_ID = 38
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_ward21061dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_ward2_1061,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      
      //// 10 อันดับโรค Refers ผู้ป่วยในบน ปีงบ2562 ////
     $datarf_ward2_1062 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2562'
        AND a.UNIT_ID = 38
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_ward21062dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_ward2_1062,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      //// 10 อันดับโรค Refers ผู้ป่วยในล่าง ปีงบ2560 ////
     $datarf_ward1_1060 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2560'
        AND a.UNIT_ID = 39
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_ward11060dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_ward1_1060,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      
            //// 10 อันดับโรค Refers ผู้ป่วยในล่าง ปีงบ2561 ////
     $datarf_ward1_1061 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2561'
        AND a.UNIT_ID = 39
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_ward11061dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_ward1_1061,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
      
      //// 10 อันดับโรค Refers ผู้ป่วยในล่าง ปีงบ2562 ////
     $datarf_ward1_1062 = $connection->createCommand("
     SELECT a.ICD10_TM, a.ICD_NAME, COUNT(a.ICD10_TM) as AMOUNT
        FROM mb_referout_ipd_fiscal a
        WHERE a.fiscal = '2562'
        AND a.UNIT_ID = 39
        AND a.ICD10_TM NOT BETWEEN 'Z00' AND 'Z99'
        GROUP BY a.ICD10_TM ORDER BY amount DESC LIMIT 10
  ")->queryAll(); 
  $rf_ward11062dataProvider = new ArrayDataProvider([
      'allModels' => $datarf_ward1_1062,
      'sort'=>[
          'attributes'=>['FISCAL','OPD','ER','THAIMED','PHISICAL','VIP']
      ],
  ]);  
        //VisitsIPD นอนโรงพยาบาล
       $datai = $connection->createCommand("
       SELECT k.fiscal , k.ivisits, avg(k.adjrw)/365.25 as adjrw, avg(k.sleepday) as sleepdays
       FROM (
       SELECT fiscal,COUNT(DISTINCT visits) AS ivisits, COUNT(adjrw) as adjrw , SUM(days+hour) AS sleepday
        FROM mb_ipdreg_fiscal 
          GROUP BY fiscal
          ) as k
          GROUP BY k.fiscal")->queryAll(); 

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
           # $sleepday[] = (int) $datai[$i]['sleepday'];
        }
        //VisitsIPD นับแยกแผนก
       $dataiu = $connection->createCommand("
       SELECT a.fiscal , 
            COUNT(CASE WHEN a.ward_no =22 THEN '1'END ) as 'LR',
            COUNT(CASE WHEN a.ward_no =38 THEN '2'END ) as 'WARD2',
            COUNT(CASE WHEN a.ward_no =39 THEN '3'END ) as 'WARD1',
            COUNT(CASE WHEN a.ward_no IN(22,38,39) THEN '4'END ) as 'TOTAL'
            FROM  mb_ipdreg_fiscal a
           # WHERE a.admit_date BETWEEN '2015-10-01' AND '2020-12-30'
            GROUP BY a.fiscal 
")->queryAll(); 

        $iudataProvider = new ArrayDataProvider([
            'allModels' => $dataiu,
            'sort'=>[
                'attributes'=>['fiscal','LR','WARD2','WARD1','TOTAL']
            ],
        ]);
        //เตรียมข้อมูลผู้ป่วยในส่งให้กราฟ
        for ($i = 0; $i < sizeof($dataiu); $i++) {
            $fiscal[] = $dataiu[$i]['fiscal'];
            $lr[] = (int) $dataiu[$i]['LR'];
            $ward2[] = (int) $dataiu[$i]['WARD2'];
            $ward1[] = (int) $dataiu[$i]['WARD1'];
            $total[] = (int) $dataiu[$i]['TOTAL'];
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
       SELECT  a.fiscal , COUNT(a.VISIT_ID) AS rfvisits, 
       COUNT(CASE WHEN UNIT_ID = 22 THEN '1' END) AS 'LR', 
       COUNT(CASE WHEN UNIT_ID = 38 THEN '3' END) AS 'WARD2', 
       COUNT(CASE WHEN UNIT_ID = 39 THEN '4' END) AS 'WARD1' 
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
            WHERE purchase_date > '20121001'
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
                    'opd1060dataProvider' => $opd1060dataProvider,
                    'opd1061dataProvider' => $opd1061dataProvider,
                    'opd1062dataProvider' => $opd1062dataProvider,
                    'ipd1060dataProvider' => $ipd1060dataProvider,
                    'ipd1061dataProvider' => $ipd1061dataProvider,
                    'ipd1062dataProvider' => $ipd1062dataProvider,
                    'death1060dataProvider' => $death1060dataProvider,
                    'death1061dataProvider' => $death1061dataProvider,
                    'death1062dataProvider' => $death1062dataProvider,
                    'rf_opd1060dataProvider'=> $rf_opd1060dataProvider,
                    'rf_opd1061dataProvider'=> $rf_opd1061dataProvider,
                    'rf_opd1062dataProvider'=> $rf_opd1062dataProvider,
                    'rf_er1060dataProvider'=> $rf_er1060dataProvider,
                    'rf_er1061dataProvider'=> $rf_er1061dataProvider,
                    'rf_er1062dataProvider'=> $rf_er1062dataProvider,
                    'rf_lr1060dataProvider'=> $rf_lr1060dataProvider,
                    'rf_lr1061dataProvider'=> $rf_lr1061dataProvider,
                    'rf_lr1062dataProvider'=> $rf_lr1062dataProvider,
                    'rf_ward21060dataProvider' => $rf_ward21060dataProvider,
                    'rf_ward21061dataProvider' => $rf_ward21061dataProvider,
                    'rf_ward21062dataProvider' => $rf_ward21062dataProvider,
                    'rf_ward11060dataProvider' => $rf_ward11060dataProvider,
                    'rf_ward11061dataProvider' => $rf_ward11061dataProvider,
                    'rf_ward11062dataProvider' => $rf_ward11062dataProvider,
                    'cipdData' => $idataProvider,
                    'iudataProvider' => $iudataProvider,
                    'acfiscal'=> $acfiscal,
                    'acvisits' => $acvisits,
                    'achuman' => $achuman,
                    'ovisits' => $ovisits,
                    'hn' => $hn,
                    'fiscal' => $fiscal,
                    'opddataProvider' => $opddataProvider,
                    'uopddataProvider' => $uopddataProvider,
                    'ifiscal' => $ifiscal,
                    'ivisits' =>$ivisits,
                    //'sleepday' =>$sleepday,
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
