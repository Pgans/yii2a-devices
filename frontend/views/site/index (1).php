<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use \miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */

$this->title = 'M30hospital(045489064)';
?>
<div class='well'>
    <h3><a style="color:blue">ขั้นตอนการเข้าใช้งาน</a></h3>
    <p><a style="color:success">Username=  เลข13หลักบัตรประจำจัวประชาชน เช่น  3341400051222</a></p> 
    <p><a style="color:success">Password = 6หลักสุดท้ายเลขบัตรประจำตัวประชาชน เช่น 051222</a></p> 
    <p><a style="color:red">***สิทธิ์การใช้งานโปรแกรมยืมเวชระเบียนเฉพาะ ตำแหน่งแพทย์หรือพยาบาล***  หากพบปัญหาการใช้งานกรุณาโทรแจ้ง ศูนย์คอมพิวเตอร์เบอร์ 508</a></p>
</div>

<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> รายงานจำนวนผู้มารับบริการ ย้อนหลัง5ปี</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> จำนวนผู้มารับบริการผู้ป่วยนอก</h5></div>
                        <div class="panel-body">
                            <div>
                    </div>
                   <?php
                                Pjax::begin();
                                echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'ปีงบประมาณ'],
                                        'xAxis' => [
                                            'categories' => $fiscal
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (คน/ครั้ง) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวน (ครั้ง)',
                                                'data' => $human,
                                                'format' => ['decimal', 0]
                                            ],
                                            [
                                                'type' => 'column',
                                                'name' => 'จำนวน (ครั้ง)',
                                                'data' => $ovisits,
                                                'format' => ['decimal', 0]
                                            //'color' => '#BF0B23',
                                            ],
                                        ]
                                    ]
                                ]);
                                Pjax::end();
                                ?>
                            </div>
                             <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $opddataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                    ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'ปีงบประมาณ',
                                            'attribute' => 'fiscal'
                                        ],
                                        [
                                            'label' => 'จำนวน (คน)',
                                            'attribute' => 'human',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'จำนวน (ครั้ง)',
                                            'attribute' => 'ovisits',
                                            'format' => ['decimal', 0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยใน</h5></div>
                        <div class="panel-body">
                            <div>
    //                             <?php
    //                             Pjax::begin();
    //                             echo Highcharts::widget([

    //                                 'options' => [
    //                                     'colors' => ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
    //                                     'title' => ['text' => 'ปีงบประมาณ'],
    //                                     'xAxis' => [
    //                                         'categories' => $iyear_budget
    //                                     ],
    //                                     'yAxis' => [
    //                                         'title' => ['text' => 'จำนวน (Admit/วันนอน) ']
    //                                     ],
    //                                     'series' => [
    //                                         ['type' => 'column',
    //                                             'name' => 'จำนวน (Admit)',
    //                                             'data' => $ivisit,
    //                                         //'color' => '#F5C4B6',
    //                                         ],
    //                                         [
    //                                             'type' => 'column',
    //                                             'name' => 'จำนวน (วันนอน)',
    //                                             'data' => $idaycnt,
    //                                         //'color' => '#BF0B23',
    //                                         ],
    //                                     ]
    //                                 ]
    //                             ]);
    //                             Pjax::end();
    //                             ?>
    //                         </div>


    //                         <div>
    //                             <?php
    //                             //use yii\grid\GridView;

    //                             echo GridView::widget([
    //                                 'dataProvider' => $cipdData,
    //                                 'responsive' => true,
    //                                 'hover' => true,
    //                                 'panel' => [
    //                                     'before' => ' ',
    //                                 ],
    //                                 'pjax' => true,
    //                                 'pjaxSettings' => [
    //                                     'neverTimeout' => true,
    //                                 ],
    //                                 'columns' => [
    //                                     ['class' => 'yii\grid\SerialColumn'],
    //                                     [
    //                                         'label' => 'ปีงบประมาณ',
    //                                         'attribute' => 'year_budget'
    //                                     ],
    //                                     [
    //                                         'label' => 'จำนวน (Admit)',
    //                                         'attribute' => 'visit',
    //                                         'format' => ['decimal', 0]
    //                                     ],
    //                                     [
    //                                         'label' => 'จำนวน (วัน)',
    //                                         'attribute' => 'daycnt',
    //                                         'format' => ['decimal', 0]
    //                                     ],
    //                                 ],
    //                             ]);
    //                             ?>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //     </div>
    // </div>






</div>


            