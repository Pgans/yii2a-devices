<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาล58';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาล58',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
