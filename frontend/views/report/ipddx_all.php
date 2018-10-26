<?php
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'IPDDX';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานอันดับโรคผู้ป่วยใน ';

 
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานอันดับโรคผู้ป่วยใน</b><b style="color: red">(ตัดรหัส Z00-Z99,O00-O99)</b>',
            'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 

],
    //'hover' => true,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ]
        ,
                [
                    'attribute' => 'ICD10_TM',
                    'header' => 'รหัสโรค'
                ],
                [
                    'attribute' => 'ICD_NAME',
                    'header' => 'ชื่อโรค'
                ],
                [
                    'attribute' => 'amount',
                    'header' => 'จำนวน',
                    'format' =>['decimal',0]
                ],
            ]
        ]);
        ?>

        <div class="alert alert-info">
            <?=$sql?>
        </div>