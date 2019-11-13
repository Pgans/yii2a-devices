<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'DXOPD-LIST';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยในDischarge';

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานผู้ป่วยนอกและชื่อโรค</b><b style="color: red">(แยกตามVisits)</b>',
      

            
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
    
        
