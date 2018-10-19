<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'DEATHIPD-List';
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาล';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b><a>รายงานผู้ป่วยในเสียชีวิตในโรงพยาบาล</a></b> '
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
