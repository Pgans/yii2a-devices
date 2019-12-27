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
</div>


    <div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus"></i> รายงานผลงานการรับบริการ 5 ปีย้อนหลัง</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> ผู้ป่วยนอก</<i></div>
                        <div class="panel-body">
                            <div>
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
                                                'name' => 'จำนวน (คน)',
                                                'data' => $hn,
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
                                        'after'=>'<a style="color:#ff6c00">
                                        -ตัดVisitที่ไม่มีDiagnosisและออกนอกหน่วยบริการ(Mobile_visits) <br>
                                        -จัดมาตามVisitและDiagเพียงตัวเดียว
                                        </a>' 
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
                                            'label' => 'จำนวน(คน)',
                                            'attribute' => 'hn',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'จำนวน(ครั้ง)',
                                            'attribute' => 'ovisits',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'เฉลี่ย(ครั้ง)',
                                            'attribute' => 'avisit',
                                            'format' => ['decimal', 2]
                                        ],
                                        [
                                            'label' => 'เฉลี่ย(คน)',
                                            'attribute' => 'kon',
                                            'format' => ['decimal',2]
                                        ],

                                    ],
                                ]);
                                ?>
                            </div>
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $uopddataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ตัดVisitที่ไม่มีDiagnosisและออกนอกหน่วยบริการ(Mobile_visits) <br>
                                        -สามารถแยกแผนกที่มาตรวจได้ทุกแผนก ที่นี้เลือกมา5 แผนก
                                        </a>' 
                                        ],
                                  
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'ปีงบประมาณ',
                                            'attribute' => 'FISCAL'
                                        ],
                                        [
                                            //'label' => 'จำนวน (คน)',
                                            'attribute' => 'OPD',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                           // 'label' => 'จำนวน (ครั้ง)',
                                            'attribute' => 'ER',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                           // 'label' => 'เฉลี่ย(ครั้ง)',
                                            'attribute' => 'THAIMED',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                           // 'label' => 'เฉลี่ย(คน)',
                                            'attribute' => 'PHISICAL',
                                            'format' => ['decimal',0]
                                        ],
                                        [
                                            // 'label' => 'เฉลี่ย(คน)',
                                             'attribute' => 'VIP',
                                             'format' => ['decimal',0]
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
                        <div class="panel-heading"><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยใน</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([

                                    'options' => [
                                        'colors' => ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                                        'title' => ['text' => 'ปีงบประมาณ'],
                                        'xAxis' => [
                                            'categories' => $ifiscal
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (Admit/วันนอน) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวน (Admit)',
                                                'data' => $ivisits,
                                            //'color' => '#F5C4B6',
                                            ],
                                            // [
                                            //     'type' => 'column',
                                            //     'name' => 'จำนวน (วันนอน)',
                                            //     'data' => $sleepday,
                                            // //'color' => '#BF0B23',
                                            // ],
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
                                    'dataProvider' => $idataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -หาวันนอนนับวันที่นอน+6ชั่วโมง(ไม่ถึง6ชั่วโมงไม่นับเป็นวันนอน) <br>
                                        -Adjrw คำนวนแล้วนำมาบกกัน/365.25 (ค่าเฉลี่ย:ปี)
                                        </a>' 
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
                                            'label' => 'จำนวน(Visits)',
                                            'attribute' => 'ivisits',
                                            'format' => ['decimal', 0]
                                        ],
                
                                        [
                                            'label' => 'เฉลี่ย:ปี(adjrw)',
                                            'attribute' => 'adjrw',
                                            'format' => ['decimal',2]
                                        ],
                                        
                                        [
                                            'label' => 'จำนวน:ปี(วันนอน)',
                                            'attribute' => 'sleepdays',
                                            'format' => ['decimal',0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                            <div>
                                <?php
                                //use yii\grid\GridView;
                                echo GridView::widget([
                                    'dataProvider' => $iudataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -แยกการนอนโรงพยาบาลตามVisitsโดยใช้รหัสหอผู้ป่วย <br>
                                        -ไม่นับข้อมูลที่ยกเลิก
                                        </a>' 
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
                                           // 'label' => 'จำนวน(Visits)',
                                            'attribute' => 'LR',
                                            'format' => ['decimal', 0]
                                        ],
                
                                        [
                                           // 'label' => 'เฉลี่ย:ปี(adjrw)',
                                            'attribute' => 'WARD1',
                                            'format' => ['decimal',0]
                                        ],
                                        
                                        [
                                            //'label' => 'จำนวน:ปี(วันนอน)',
                                            'attribute' => 'WARD2',
                                            'format' => ['decimal',0]
                                        ],
                                        [
                                            'attribute'=>'TOTAL',
                                            'format'=>['decimal',0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel-body">
    <div class="panel panel-info">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคผู้ป้วยนอก</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคผู้ป้วยนอก ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $opd1060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นรหัส Z00-Z99 และ U778 ที่เป็นโรคหลัก
                                        -ยกเว้นVisitsผู้ป่วยในและออกตรวจนอกสถานบริการ
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                       // ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'รหัส',
                                            'attribute' => 'ICD10_TM'
                                        ],
                                        [
                                            'label' => 'ชื่อโรค',
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'attribute'=>'AMOUNT',
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคผู้ป้วยนอก ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $opd1061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นรหัส Z00-Z99 และ U778 ที่เป็นโรคหลัก
                                        -ยกเว้นVisitsผู้ป่วยในและออกตรวจนอกสถานบริการ
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                       // ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'รหัส',
                                            'attribute' => 'ICD10_TM'
                                        ],
                                        [
                                            'label' => 'ชื่อโรค',
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'attribute'=>'AMOUNT',
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคผู้ป้วยนอก ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $opd1062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นรหัส Z00-Z99 และ U778 ที่เป็นโรคหลัก
                                        -ยกเว้นVisitsผู้ป่วยในและออกตรวจนอกสถานบริการ
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                       // ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'รหัส',
                                            'attribute' => 'ICD10_TM'
                                        ],
                                        [
                                            'label' => 'ชื่อโรค',
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'attribute'=>'AMOUNT',
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคผู้ป้วยใน(IPD)</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคผู้ป้วยในบน(38) ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $ipd1060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นรหัส O และ Z ที่เป็นโรคหลัก
                                       
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'รหัส',
                                            'attribute' => 'ICD10_TM',
                                            
                                        ],
                                        [
                                            'label' => 'ชื่อโรค',
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'attribute'=>'AMOUNT',
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคผู้ป่วยในบน(38) ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $ipd1061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นรหัส O และ Z ที่เป็นโรคหลัก
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'รหัส',
                                            'attribute' => 'ICD10_TM',
                                            
                                        ],
                                        [
                                            'label' => 'ชื่อโรค',
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'attribute'=>'AMOUNT',
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคผู้ป้วยในบน(38) ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $ipd1062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นรหัส O และ Z ที่เป็นโรคหลัก
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'รหัส',
                                            'attribute' => 'ICD10_TM',
                                            
                                        ],
                                        [
                                            'label' => 'ชื่อโรค',
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'attribute'=>'AMOUNT',
                                        ],
                                    ],
                                ]);
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคเสียชีวิตในโรงพยาบาล</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคเสียชีวิตในโรงพยาบาล ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $death1060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ข้อมูลบันทึกในแฟ้มDeaths ที่มีใบเสียชีวิต
                                       
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'CDEATH',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค(ปีงบ2560)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#9966ff">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคเสียชีวิตในโรงพยาบาล ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $death1061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ข้อมูลบันทึกในแฟ้มDeaths ที่มีใบเสียชีวิต
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'CDEATH',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ปีงบ2561)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#ff3399">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคเสียชีวิตในโรงพยาบาล ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $death1062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ข้อมูลบันทึกในแฟ้มDeaths ที่มีใบเสียชีวิต
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'CDEATH',
                                            

                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ปีงบ2562)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#cc0000">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคส่งต่อที่แผนกตรวจโรคทั่วไป (โรงพยาบาลที่สูงกว่า)</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกตรวจโรคทั่วไป ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_opd1060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                                                              
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค(ตรวจโรคทั่วไป ปีงบ2560)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#6666ff">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกตรวจโรคทั่วไป ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_opd1061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ตรวจโรคทั่วไป ปีงบ2561)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#6666cc">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกตรวจโรคทั่วไป ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_opd1062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                            

                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ตรวจโรคทั่วไป ปีงบ2562)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#666699">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคส่งต่อที่แผนกอุบัติเหตุุ-ฉุกเฉิน (โรงพยาบาลที่สูงกว่า)</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่ออุบัติเหตุุ-ฉุกเฉิน ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_er1060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                                                              
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค(อุบัติเหตุุ-ฉุกเฉิน ปีงบ2560)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#ff33ff">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกอุบัติเหตุุ-ฉุกเฉิน ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_er1061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค (อุบัติเหตุุ-ฉุกเฉิน ปีงบ2561)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#9966ff">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกอุบัติเหตุ-ฉุกเฉิน ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_er1062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                            

                                        ],
                                        [
                                            'label' => 'ชื่อโรค (อุบัติเหตุุ-ฉุกเฉิน ปีงบ2562)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#ff0033">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคส่งต่อห้องคลอด (โรงพยาบาลที่สูงกว่า)</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อห้องคลอด ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_lr1060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                    
                                          **ไม่นับรหัสโรคประเภท Z00-Z99 **                                 
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค(ห้องคลอด ปีงบ2560)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#006699">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกห้องคลอด ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_lr1061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        **ไม่นับรหัสโรคประเภท Z00-Z99 **  
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ห้องคลอด ปีงบ2561)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#0066ff">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกห้องคลอด ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_lr1062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        **ไม่นับรหัสโรคประเภท Z00-Z99 ** 
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                            

                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ห้องคลอด ปีงบ2562)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#336600">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคส่งต่อผู้ป่วยในบน (โรงพยาบาลที่สูงกว่า)</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อผู้ป่วยในบน ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_ward21060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                    
                                          **ไม่นับรหัสโรคประเภท Z00-Z99 **                                 
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค(ผู้ป่วยในบน ปีงบ2560)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#006699">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกผู้ป่วยในบน ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_ward21061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        **ไม่นับรหัสโรคประเภท Z00-Z99 **  
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ผู้ป่วยในบน ปีงบ2561)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#0066ff">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกผู้ป่วยใน(บน) ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_ward21062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        **ไม่นับรหัสโรคประเภท Z00-Z99 ** 
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                            

                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ผู้ป่วยในบน ปีงบ2562)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#336600">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูล10 อันดับโรคส่งต่อผู้ป่วยในล่าง (โรงพยาบาลที่สูงกว่า)</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อผู้ป่วยในล่าง ปีงบประมาณ 2560</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_ward11060dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                    
                                          **ไม่นับรหัสโรคประเภท Z00-Z99 **                                 
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค(ผู้ป่วยในล่าง ปีงบ2560)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#996600">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกผู้ป่วยในล่าง ปีงบประมาณ 2561</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_ward11061dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        **ไม่นับรหัสโรคประเภท Z00-Z99 **  
                                        
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ผู้ป่วยในล่าง ปีงบ2561)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#cc6600">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> 10อันดับโรคส่งต่อแผนกผู้ป่วยใน(ล่าง) ปีงบประมาณ 2562</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $rf_ward11062dataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        
                                        **ไม่นับรหัสโรคประเภท Z00-Z99 ** 
                                        </a>' 
                                        ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'รหัส',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'ICD10_TM',
                                            

                                        ],
                                        [
                                            'label' => 'ชื่อโรค (ผู้ป่วยในล่าง ปีงบ2562)',
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute' => 'ICD_NAME',
                                            
                                        ],
                                        [
                                            'label'=>'จำนวน',
                                            'format'=> 'raw', //จำเป็นต้องมี ไม่งั้นจะไม่แสดงสี
                                            'headerOptions'=>[ 'style'=>'background-color:#99ccff'],
                                            'attribute'=>'AMOUNT',
                                            'value' => function ($model) {
                                                return '<span class="badge" style="background-color:#ff6600">' . $model['AMOUNT'] . '</span>';
                                            },
                        
                                        ],
                                    ],
                                ]);
                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="panel-body">
    <div class="panel panel-warning">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูลส่งต่อโรงพยาบาลที่สูงกว่า</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> ผู้ป่วยส่งต่อผู้ป่วยนอก</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'ปีงบประมาณ'],
                                        'xAxis' => [
                                            'categories' => $rfiscal
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (ครั้ง) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวนส่งต่อ (ครั้ง)',
                                                'data' => $rfvisits,
                                                'format' => ['decimal', 0]
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
                                    'dataProvider' => $rfdataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นการส่งไปยังรพ.สต.ในเขต อ.ม่วงสามสิบที่ขึ้นต้นด้วยรหัส 037 <br>
                                        </a>' 
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
                                            'label' => 'จำนวนส่งต่อOPD (Visit)',
                                            'attribute' => 'rfvisits',
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
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยในส่งต่อ</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([

                                    'options' => [
                                        'colors' => ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                                        'title' => ['text' => 'ปีงบประมาณ'],
                                        'xAxis' => [
                                            'categories' => $rifiscal
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (Admit/วันนอน) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวนส่งต่อ (ipd)',
                                                'data' => $rivisits,
                                            //'color' => '#F5C4B6',
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
                                    'dataProvider' => $ridataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                        'after'=>'<a style="color:#ff6c00">
                                        -ยกเว้นการส่งไปยังรพ.สต.ในเขต อ.ม่วงสามสิบที่ขึ้นต้นด้วยรหัส 037 <br>
                                        </a>' 
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
                                            'label' => 'ห้องคลอด(Visit)',
                                            'attribute' => 'LR',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ผู้ป่วยในบน(Visit)',
                                            'attribute' => 'WARD2',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'ผู้ป่วยในล่าง(Visit)',
                                            'attribute' => 'WARD1',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'รวม (Visit)',
                                            'attribute' => 'rfvisits',
                                            'format' => ['decimal', 0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel-body">
    <div class="panel panel-warning">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูลคอมพิวเตอร์และอุปกรณ์ต่อพ่วง</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> แยกการจัดซื้อใหม่ทั้งทดแทนและขยายงาน</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'ปีงบประมาณ'],
                                        'xAxis' => [
                                            'categories' => $cfiscal
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'ราคา(บาท) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'ราคา (รวม)',
                                                'data' => $price,
                                                'format' => ['decimal', 0]
                                            ],
                                            // ['type' => 'column',
                                            //     'name' => 'จำนวน (เครื่อง)',
                                            //     'data' => $Total,
                                            // ],
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
                                    'dataProvider' => $comdataProvider,
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
                                            'label' => 'ปีงบ',
                                            'attribute' => 'fiscal'
                                        ],
                                        [
                                            'label' => 'PC',
                                            'attribute' => 'PC',
                                        ],
                                        [
                                            'label' => 'NB',
                                            'attribute' => 'NB',
                                        ],
                                        [
                                            'label' => 'PLaser',
                                            'attribute' => 'PrinLaser',
                                        ],
                                        [
                                            'label' => 'PInk',
                                            'attribute' => 'PrinInk',
                                        ],
                                        [
                                            'label' => 'UPS',
                                            'attribute' => 'UPS',
                                        ],
                                        [
                                            'label' => 'LCD',
                                            'attribute' => 'LCD',
                                        ],
                                        [
                                            'label' => 'Termal',
                                            'attribute' => 'Termal',
                                        ],
                                        [
                                            'label' => 'Scan',
                                            'attribute' => 'Scan',
                                        ],
                                        [
                                            'label' => 'รวม',
                                            'attribute' => 'Total',
                                        ],
                                        [
                                            'label' => 'ราคารวม',
                                            'attribute' => 'Price',
                                            'format' => ['decimal', 0]
                                        ],
                                        
                                    ],
                                ]);
                                ?>
                            </div>

                            <div class="kv-panel-pager">
                                หมายเหตุ :: ยังไม่รวมการซื้อตลับหมึกต่างๆเพื่อใช้ทดแทนตัวใช้หมดไป
                           </div>
                        </div>
                    </div>
                </div>
<div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading"><i class="glyphicon glyphicon-list-alt"></i> สรุปจำนวนเครื่องคอมพิวเตอร์ทั้งหมดที่ยังใช้งานได้</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([

                                    'options' => [
                                        'colors' => ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                                        'title' => ['text' => 'คอมพิวเตอร์ปัจจุบัน'],
                                        'xAxis' => [
                                            'categories' => 'ประเภท'
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (เครื่อง) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'pc',
                                                'data' => $pc,
                                            //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'nb',
                                                'data' => $nb,
                                            ],
                                            ['type' => 'column',
                                                'name' => 'laser',
                                                'data' => $laser,
                                            ],
                                            ['type' => 'column',
                                                'name' => 'ink',
                                                'data' => $ink,
                                            ],
                                            ['type' => 'column',
                                                'name' => 'termal',
                                                'data' => $termal,
                                            ],
                                            ['type' => 'column',
                                                'name' => 'scan',
                                                'data' => $scan,
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
                                    'dataProvider' => $cdataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                    ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel-body">
    <div class="panel panel-success">
        <div class="panel-heading"><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานทารกที่คลอดในโรงพยาบาล</<i></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> ทารกที่คลอด</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([
                                    'options' => [
                                        'title' => ['text' => 'ปีงบประมาณ'],
                                        'xAxis' => [
                                            'categories' => $babyfiscal
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (คน) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวนที่คลอด (คน)',
                                                'data' => $cidbaby,
                                                'format' => ['decimal', 0]
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
                                    'dataProvider' => $babydataProvider,
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
                                            'label' => 'จำนวนที่คลอด',
                                            'attribute' => 'cidbaby',
                                            'format' => ['decimal', 0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>

                            <div class="kv-panel-pager">
                                หมายเหตุ :: ตัด cid ที่ขึ้นต้นด้วย 0
                            </div>
                        </div>
                    </div>
                </div>
<div class="col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading"><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยที่ได้รับอุบัติเหตุ</<i></div>
                        <div class="panel-body">
                            <div>
                                <?php
                                Pjax::begin();
                                echo Highcharts::widget([

                                    'options' => [
                                        'colors' => ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                                        'title' => ['text' => 'ปีงบประมาณ'],
                                        'xAxis' => [
                                            'categories' => $fiscal
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวน(ครั้ง)',
                                                'data' => $acvisits,
                                            //'color' => '#F5C4B6',
                                            ],
                                            ['type' => 'column',
                                                'name' => 'จำนวน(คน)',
                                                'data' => $achuman,
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
                                    'dataProvider' => $acdataProvider,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                    ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>