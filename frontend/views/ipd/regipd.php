<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;



$this->title = 'IPD-Graph';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['ipd/index']];
$this->params['breadcrumbs'][] = 'ผู้มารับบริการผู้ป่วยในแยกรายเดือน';

        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'ผู้มารับบริการผู้ป่วยในแยกรายเดือน(hospital)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );   
   ?>
            <!-- ส่วนแสดงกราฟ -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
            จำนวนผู้ป่วยในแยกรายเดือน</h3>
    </div>
    <div class="panel-body">
        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'จำนวนผู้ป่วยในแยกรายเดือน'],
                'xAxis' => [
                    'categories' => $mm
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวน(คน)']
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'ผู้ป่วยในหญิง',
                        'data' => [16,201,176,173,135],
                    ]
                ]
            ]
        ]);
        ?>
   

  