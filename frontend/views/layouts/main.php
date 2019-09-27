<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\MaterialAsset;


//AppAsset::register($this);
MaterialAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'โรงพยาบาลม่วงสามสิบ',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
     $report_mnu_itms8[] = ['label' => 'ตรวจสอบการถ่นโอนข้อมูลระหว่างSERVER', 'url' => ['check/index']];
    $report_mnu_itms7[] = ['label' => 'ยืมเวชระเบียน', 'url' => ['opdcard/permits']];
    $report_mnu_itms7[] = ['label' => 'xxxx', 'url' => ['search/index']];

    $report_mnu_itms6[] = ['label' => 'รายงานจำนวนอุปกรณ์คอมพิวเตอร์', 'url' => ['computer/devicenew']];
    $report_mnu_itms6[] = ['label' => 'รายงานอุปกรณ์คอมพิวเตอร์แยกตามประเภทและหมายเลขครุภัณฑ์', 'url' => ['computer/devices_all']];
    $report_mnu_itms6[] = ['label' => 'รายงานการจำหน่ายอุปกรณ์ที่ชำรุด', 'url' => ['computer/saledevices']];
    $report_mnu_itms6[] = ['label' => 'รายงานการส่งซ่อมภายนอก', 'url' => ['computer/serviceout']];
    $report_mnu_itms6[] = ['label' => 'รายงานการอุปกรณ์ซื้อใหม่', 'url' => ['computer/device59']];
    $report_mnu_itms6[] = ['label' => 'รายงานการอุปกรณ์คอมพิวเตอร์แยกตามแผนก', 'url' => ['computer/depdevices']];
    $report_mnu_itms6[] = ['label' => 'รายการซื้อหมึก-วัสดุคอมพิวเตอร์', 'url' => ['computer/materials']];
    $report_mnu_itms6[] = ['label' => 'รายการซื้อวัสดุสำนักงาน', 'url' => ['computer/material13']];


    $report_mnu_itms5[] = ['label' => 'รายงานผู้มารับบริการผู้ป่วยนอกแยกตามจุดลงทะเบียน(ครั้ง)', 'url' => ['reg/register']];
    $report_mnu_itms5[] = ['label' => 'รายงานผู้มารับบริการนอกสถานบริการ(ครั้ง)', 'url' => ['reg/outstan']];
    $report_mnu_itms5[] = ['label' => 'รายงานผู้ป่วยในแยกตามเดือน(ปีงบ2559)', 'url' => ['report/ipddx59']];
    //$report_mnu_itms5[] = ['label' => 'รายงานผู้ป่วยในแยกตามเดือน(Graph)', 'url' => ['ipd/ipddx59']];
    $report_mnu_itms5[] = ['label' => 'รายงานผู้ป่วยในแยกตามหอผู้ป่วย', 'url' => ['reg/depregipd']];
    $report_mnu_itms5[] = ['label' => 'รายงานผู้ป่วยอุบัติเหตุ', 'url' => ['report/accidents']];
    $report_mnu_itms5[] = ['label' => 'รายงาน5อันดับโรคอุบัติเหตุฉุกเฉิน (mb_visitsdx)', 'url' => ['report/er5dx']];
    $report_mnu_itms5[] = ['label' => 'รายงาน5อันดับโรคตรวจโรคทั่วไป (mb_visitsdx)', 'url' => ['report/examination']];
    $report_mnu_itms5[] = ['label' => 'รายงาน10อันดับโรคOPD', 'url' => ['report/dxopd59']];
    $report_mnu_itms5[] = ['label' => 'รายงาน10อันดับโรคIPD', 'url' => ['report/dxipd']];
    $report_mnu_itms5[] = ['label' => 'รายงานผู้ป่วยในแสดงค่าRWและวันนอนแยกตามสิทธิ์', 'url' => ['rw/index']];
    $report_mnu_itms5[] = ['label' => 'รายงานผู้ป่วยSepsis', 'url' => ['sepsis/sepsis']];
    
    //$report_mnu_itms4[] = ['label' => 'รายงานผู้ป่วยในเสียชีวิตแบบจัดกลุ่มและรายคน(DSC)', 'url' => ['deaths/death_dsclist']];
    $report_mnu_itms4[] = ['label' => 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาลและชื่อโรคแยกตามแผนก(จากDSCนับคน)', 'url' => ['deaths/deathipd']];
    $report_mnu_itms4[] = ['label' => 'รายงานผู้เสียชีวิต10อันดับโรค(IPD)', 'url' => ['deaths/deathdx59']];
    $report_mnu_itms4[] = ['label' => 'รายงานผู้เสียชีวิต10อันดับโรค(OPD)', 'url' => ['deaths/death_opd']];
    $report_mnu_itms4[] = ['label' => 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาลภาพรวมทั้งหมด(แฟ้มDeath IPD-OPD)', 'url' => ['deaths/death_all']];
    $report_mnu_itms4[] = ['label' => 'รายงานผู้ป่วยเสียชีวิตยังไม่จำหน่าย(43แฟ้ม (Discharge=9)', 'url' => ['deaths/persondisc']];
   
    $report_mnu_itms2[] = ['label' => 'รายงานRefersส่งต่อแยกตามแผนกบริการ(OPD)', 'url' => ['refers/referopd']];
    $report_mnu_itms2[] = ['label' => 'รายงานRefersส่งต่อแยกตามแผนกบริการ(IPD)', 'url' => ['refers/referipd']];
    $report_mnu_itms2[] = ['label' => 'รายงานการส่งต่อแยกสถานบริการปลายทาง(Refers)', 'url' => ['refers/referout_all']];
    $report_mnu_itms2[] = ['label' => 'รายงานรับRefer', 'url' => ['refers/referin']];
    $report_mnu_itms1[] = ['label' => '43แฟ้ม(Hospital)', 'url' => ['hosp43/index']];
    $report_mnu_itms1[] = ['label' => '43แฟ้ม(Pcu)', 'url' => ['pcu43/index']];
    $report_mnu_itms[] = ['label' => 'แพทย์แผนไทย', 'url' => ['thaimed/index']];
    $report_mnu_itms[] = ['label' => 'เวชระเบียน', 'url' => ['report/index']];
    $report_mnu_itms[] = ['label' => 'ทันตกรรม', 'url' => ['dental/index']];
    $report_mnu_itms[] = ['label' => 'ห้องคลอดANC', 'url' => ['lr/index']];
    $report_mnu_itms[] = ['label' => 'ผู้ป่วยในชาย', 'url' => ['ipd/index']];
    $report_mnu_itms[] = ['label' => 'ผู้ป่วยในหญิง', 'url' => ['ipdfmale/index']];
    $report_mnu_itms[] = ['label' => 'คลินิกโรคเรื้อรัง', 'url' => ['chronic/index']];
    $report_mnu_itms[] = ['label' => 'เภสัชกรรม', 'url' => ['pharm/index']];
    $report_mnu_itms[] = ['label' => 'ยาเสพติด-จิตเวช', 'url' => ['addictive/index']];
    $report_mnu_itms[] = ['label' => 'เวชปฏิบัติ', 'url' => ['wech/index']];
    $report_mnu_itms[] = ['label' => 'กายภาพบำบัด', 'url' => ['phisical/index']];
    
  
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
      //  ['label' => 'ประวัติบริการ', 'url' => ['/ehr']],
             
              ['label' => 'mBase',
          'items' => $report_mnu_itms
            ],
            ['label' => 'Deaths',
          'items' => $report_mnu_itms4
            ],
               ['label' => '43แฟ้ม',
            'items' => $report_mnu_itms1
               ],
              ['label' => 'Refers',
           'items' => $report_mnu_itms2
              ],
              ['label' => 'Reports',
           'items' => $report_mnu_itms5
              ],
              ['label' => 'Comp',
           'items' => $report_mnu_itms6
              ],
        //       ['label' => 'MRS',
        //    'items' => $report_mnu_itms7
        //       ],
                ['label' => 'Check',
            'items' => $report_mnu_itms8
                ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        #$menuItems[] = ['label' => 'Devices', 'url' => ['/computer/index']];
    } else {
        $menuItems[] = [
           // 'label' => 'Logout (' . Yii::$app->user->identity->person->firstname . ')',
               'label' => 'Logout (' . Yii::$app->user->identity->username . ')',

            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-blue'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Pgans <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
