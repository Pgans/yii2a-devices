<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'OLD60';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['dental/index']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาล';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานจำนวนประชากรผู้สูงอายุแยกรายตำบล '.date('Y-m-d')
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
