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
use common\models\RContributionIpd;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
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
    public function actions() {
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
        //ข้อมูลผู้ป่วยนอก
        $connection = \Yii::$app->dbhi;
        $datao = $connection->createCommand("
        select * from r_contribution_opd
        ")->queryAll();

        $odataProvider = new ArrayDataProvider([
            'allModels' => $datao,
        ]);

        //เตรียมข้อมูลผู้ป่วยนอกส่งให้กราฟ
        for ($i = 0; $i < sizeof($datao); $i++) {
            $oyear_budget[] = $datao[$i]['year_budget'];
            $ovisit[] = (int) $datao[$i]['visit'];
            $ohuman[] = (int) $datao[$i]['human'];
        }


        //ข้อมูลผู้ป่วยใน
        $datai = $connection->createCommand("
        select * from r_contribution_ipd
        ")->queryAll();

        $idataProvider = new ArrayDataProvider([
            'allModels' => $datai,
        ]);

        //เตรียมข้อมูลผู้ป่วยนอกส่งให้กราฟ
        for ($i = 0; $i < sizeof($datai); $i++) {
            $iyear_budget[] = $datai[$i]['year_budget'];
            $ivisit[] = (int) $datai[$i]['visit'];
            $idaycnt[] = (int) $datai[$i]['daycnt'];
        }


        // ข้อมูล  21 กลุ่มโรคผู้ป่วยใน
        $data21i = $connection->createCommand("
        select * from r_contribution_21grp_ipd where year_budget = '2560' 
        ")->queryAll();

        $grp21idataProvider = new ArrayDataProvider([
            'allModels' => $data21i,
        ]);

        // ข้อมูล  21 กลุ่มโรคผู้ป่วยนอก
        $data21o = $connection->createCommand("
        select * from r_contribution_21grp_opd where year_budget = '2560' 
        ")->queryAll();

        $grp21odataProvider = new ArrayDataProvider([
            'allModels' => $data21o,
        ]);


        // ข้อมูล  10 อันดับโรคผู้ป่วยนอก
        $datatop10o = $connection->createCommand("
        select * from r_contribution_top10_opd_with_pdx WHERE year_budget = '2560'
        ")->queryAll();

        $top10odataProvider = new ArrayDataProvider([
            'allModels' => $datatop10o,
        ]);


        // ข้อมูล  10 อันดับโรคผู้ป่วยใน
        $datatop10i = $connection->createCommand("
        select * from r_contribution_top10_ipd_with_pdx WHERE year_budget = '2560'
        ")->queryAll();

        $top10idataProvider = new ArrayDataProvider([
            'allModels' => $datatop10i,
        ]);
        //เตรียมข้อมูลผู้ป่วยนอกส่งให้กราฟแบบ pie
        /*
          $imain_data = [];
          foreach ($data21i as $data) {
          $imain_data[] = [
          'name' => $data['grp_range'],
          'y' => $data['numx'] * 1
          ];
          $igrp21 = json_encode($imain_data);
          }
         */



        // ส่งข้อมูลไปแสดงผล
        return $this->render('index', [
                    'copdData' => $odataProvider,
                    'cipdData' => $idataProvider,
                    'c21grpi' => $grp21idataProvider,
                    'c21grpo' => $grp21odataProvider,
                    'top10o' => $top10odataProvider,
                    'top10i' => $top10idataProvider,
                    'oyear_budget' => $oyear_budget,
                    'ovisit' => $ovisit,
                    'ohuman' => $ohuman,
                    'iyear_budget' => $iyear_budget,
                    'ivisit' => $ivisit,
                    'idaycnt' => $idaycnt,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
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
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
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
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionIpd() {
        return $this->render('ipd');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
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
    public function actionRequestPasswordReset() {
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
    public function actionResetPassword($token) {
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

}
