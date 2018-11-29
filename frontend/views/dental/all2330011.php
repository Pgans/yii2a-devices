<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title = 'A2330011';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['dental/index']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาล';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานKPIตรวจทั้งปากทุกกลุ่มอายุ '.date('Y-m-d'),
            'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 
            ],
    ]
  );

        ?>
        <div class="alert alert-info">
            <?=$sql?>
        </div>
