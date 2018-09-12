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
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> รายงานผลงานการรับบริการ 5 ปีย้อนหลัง</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> ผู้ป่วยนอก</h5></div>
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
                                            'attribute' => 'hn',
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
                                            [
                                                'type' => 'column',
                                                'name' => 'จำนวน (วันนอน)',
                                                'data' => $sleepday,
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
                                    'dataProvider' => $idataProvider,
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
                                            'label' => 'จำนวน (Admit)',
                                            'attribute' => 'ivisits',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'จำนวน (วันนอน)',
                                            'attribute' => 'sleepday',
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
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูลส่งต่อโรงพยาบาลที่สูงกว่า</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> ผู้ป่วยส่งต่อผู้ป่วยนอก</h5></div>
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
                                            'label' => 'จำนวนส่งต่อ (opd)',
                                            'attribute' => 'rfvisits',
                                            'format' => ['decimal', 0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>

                            <div class="kv-panel-pager">
                                หมายเหตุ :: ยกเว้นการส่งไปยังรพ.สต.ในเขต อ.ม่วงสามสิบที่ขึ้นต้นด้วยรหัส 037
                            </div>
                        </div>
                    </div>
                </div>

<div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยในส่งต่อ</h5></div>
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
                                            'label' => 'จำนวนส่งต่อ (ipd)',
                                            'attribute' => 'rfvisits',
                                            'format' => ['decimal', 0]
                                        ],
                                        // [
                                        //     'label' => 'จำนวน (วันนอน)',
                                        //     'attribute' => 'sleepday',
                                        //     'format' => ['decimal', 0]
                                        // ],
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
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานข้อมูลคอมพิวเตอร์และอุปกรณ์ต่อพ่วง</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> แยกการจัดซื้อใหม่ทั้งทดแทนและขยายงาน</h5></div>
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
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> สรุปจำนวนเครื่องคอมพิวเตอร์ทั้งหมดที่ยังใช้งานได้</h5></div>
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
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus-sign"></i> ระบบรายงานทารกที่คลอดในโรงพยาบาล</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> ทารกที่คลอด</h5></div>
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
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยที่ได้รับอุบัติเหตุ</h5></div>
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