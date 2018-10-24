<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'DEATH-List';
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาล';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue">รายงานผู้ป่วยเสียชีวิตในโรงพยาบาลที่ชื่อโรคว่าง</b>',
            'after'=>'<a>ประมวลผล</a> '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
