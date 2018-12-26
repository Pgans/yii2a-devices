<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

$this->title = 'Check-Data';
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาล';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<a>ตรวจสอบข้อมูล </a>'.date('Y-m-d')
            ],
    ]
  );

        ?>
        <div class="alert alert-info">
            <?=$sql?>
        </div>
