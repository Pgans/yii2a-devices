<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use \miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

$this->title = 'ระบบรายงานสารสนเทศ โรงพยาบาลเขื่องใน';
?>
<div class="panel-body">
    <div class="panel panel-primary">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus"></i> รายงานผลงานการรับบริการ 6 ปีย้อนหลัง</h4></div>
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
                                            'categories' => $oyear_budget
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (คน/ครั้ง) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวน (คน)',
                                                'data' => $ohuman,
                                            //'color' => '#F5C4B6',
                                            ],
                                            [
                                                'type' => 'column',
                                                'name' => 'จำนวน (ครั้ง)',
                                                'data' => $ovisit,
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
                                    'dataProvider' => $copdData,
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
                                            'attribute' => 'year_budget'
                                        ],
                                        [
                                            'label' => 'จำนวน (คน)',
                                            'attribute' => 'human',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'จำนวน (ครั้ง)',
                                            'attribute' => 'visit',
                                            'format' => ['decimal', 0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>

                            <div class="kv-panel-pager">
                                หมายเหตุ :: นับทุก Visit  ที่มารับบริการ ไม่ว่าจะได้รับการลงรหัสวินิจฉัยหรือไม่ 
                                <p>
                                ข้อมูลปีงบประมาณ 2560 เป็นข้อมูล 6 เดือนแรก
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
                                            'categories' => $iyear_budget
                                        ],
                                        'yAxis' => [
                                            'title' => ['text' => 'จำนวน (Admit/วันนอน) ']
                                        ],
                                        'series' => [
                                            ['type' => 'column',
                                                'name' => 'จำนวน (Admit)',
                                                'data' => $ivisit,
                                            //'color' => '#F5C4B6',
                                            ],
                                            [
                                                'type' => 'column',
                                                'name' => 'จำนวน (วันนอน)',
                                                'data' => $idaycnt,
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
                                    'dataProvider' => $cipdData,
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
                                            'attribute' => 'year_budget'
                                        ],
                                        [
                                            'label' => 'จำนวน (Admit)',
                                            'attribute' => 'visit',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'label' => 'จำนวน (วัน)',
                                            'attribute' => 'daycnt',
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
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus-sign"></i> รายงาน 10 อันดับโรค ในปีงบประมาณ 2560 6 เดือนแรก</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> ผู้ป่วยนอก</h5></div>
                        <div class="panel-body">
                            <div style="display: none">
                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    //'modules/exporting', // adds Exporting button/menu to chart
                                    //'themes/grid', // applies global 'grid' theme to all charts
                                    //'highcharts-3d',
                                    //'modules/drilldown'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div id="chart_topopd">
                            </div>

                            <?php
                            $sql = "select * from r_contribution_top10_opd_with_pdx WHERE year_budget = '2560'";
                            $rawData = Yii::$app->dbhi->createCommand($sql)->queryAll();
                            $main_data = [];
                            foreach ($rawData as $data) {
                                $main_data[] = [
                                    'name' => $data['icd10'],
                                    'y' => $data['numx'] * 1,
                                ];
                                $main = json_encode($main_data);
                                ?>
                                <?php
                                $this->registerJs("$(function () {
                        $('#chart_topopd').highcharts({
                            colors: ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                            chart: {
                            type: 'pie',
                            margin: 75,
                            options3d: {
                                enabled: true,
                                alpha: 21,
                                beta: 15,
                                depth: 70
                            }
                            },
                            title: {
                                text: 'กราฟแสดง 10 อันดับโรคผู้ป่วยนอกปีงบประมาณ 2560 6 เดือนแรก'
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: '<b>รหัสโรค</b>'
                                },
                            },
                            legend: {
                                enabled: true
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: [
                            {
                                name: 'จำนวน',
                                colorByPoint: true,
                                data:$main

                            }
                            ],

                        });
                    });");
                                ?>
                            <?php } ?>
                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $top10o,
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
                                            'label' => 'รหัสวินิจฉัย',
                                            'attribute' => 'icd10'
                                        ],
                                        [
                                            'label' => 'ชื่อโรค',
                                            'attribute' => 'icd10name'
                                        ],
                                        [
                                            'label' => 'จำนวน',
                                            'attribute' => 'numx',
                                            'format' => ['decimal', 0]
                                        ],
                                    ],
                                ]);
                                ?>
                            </div>

                            <div class="kv-panel-pager">
                                หมายเหตุ :: นับเฉพาะ  PrincipleDx ตัดกลุ่ม V,W,X,Y,Z ออก
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยใน</h5></div>
                        <div class="panel-body">
                            <div style="display: none">
                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    //'modules/exporting', // adds Exporting button/menu to chart
                                    //'themes/grid', // applies global 'grid' theme to all charts
                                    //'highcharts-3d',
                                    //'modules/drilldown'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div id="chart_topipd">
                            </div>

                            <?php
                            $sql = "select * from r_contribution_top10_ipd_with_pdx WHERE year_budget = '2560'";
                            $rawData = Yii::$app->dbhi->createCommand($sql)->queryAll();
                            $main_data = [];
                            foreach ($rawData as $data) {
                                $main_data[] = [
                                    'name' => $data['icd10'],
                                    'y' => $data['numx'] * 1,
                                ];
                                $main = json_encode($main_data);
                                ?>
                                <?php
                                $this->registerJs("$(function () {
                        $('#chart_topipd').highcharts({
                            colors: ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                            chart: {
                            type: 'pie',
                            margin: 75,
                            options3d: {
                                enabled: true,
                                alpha: 21,
                                beta: 15,
                                depth: 70
                            }
                            },
                            title: {
                                text: 'กราฟแสดง 10 อันดับโรคผู้ป่วยในปีงบประมาณ 2560 6 เดือนแรก'
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: '<b>รหัสโรค</b>'
                                },
                            },
                            legend: {
                                enabled: true
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: [
                            {
                                name: 'จำนวน',
                                colorByPoint: true,
                                data:$main

                            }
                            ],

                        });
                    });");
                                ?>
                            <?php } ?>
                            <?php
                            //use yii\grid\GridView;

                            echo GridView::widget([
                                'dataProvider' => $top10i,
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
                                        'label' => 'รหัสวินิจฉัย',
                                        'attribute' => 'icd10'
                                    ],
                                    [
                                        'label' => 'ชื่อโรค',
                                        'attribute' => 'icd10name'
                                    ],
                                    [
                                        'label' => 'จำนวน',
                                        'attribute' => 'numx',
                                        'format' => ['decimal', 0]
                                    ],
                                ],
                            ]);
                            ?>

                            <div class="kv-panel-pager">
                                หมายเหตุ :: นับเฉพาะ  PrincipleDx ตัดกลุ่ม V,W,X,Y,Z ออก
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
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-plus-sign"></i> รายงานอันดับกลุ่มโรค ในปีงบประมาณ 2560 6 เดือนแรก</h4></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-user"></i> ผู้ป่วยนอก</h5></div>
                        <div class="panel-body">
                            <div style="display: none">
                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    //'modules/exporting', // adds Exporting button/menu to chart
                                    //'themes/grid', // applies global 'grid' theme to all charts
                                    //'highcharts-3d',
                                    //'modules/drilldown'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div id="chart_opd">
                            </div>

                            <?php
                            $sql = "select * from r_contribution_21grp_opd where year_budget = '2559'";
                            $rawData = Yii::$app->dbhi->createCommand($sql)->queryAll();
                            $main_data = [];
                            foreach ($rawData as $data) {
                                $main_data[] = [
                                    'name' => $data['grp_range'],
                                    'y' => $data['numx'] * 1,
                                ];
                                $main = json_encode($main_data);
                                ?>
                                <?php
                                $this->registerJs("$(function () {
                        $('#chart_opd').highcharts({
                            colors: ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                            chart: {
                            type: 'pie',
                            margin: 75,
                            options3d: {
                                enabled: true,
                                alpha: 21,
                                beta: 15,
                                depth: 70
                            }
                            },
                            title: {
                                text: 'กราฟแสดง 21 กลุ่มโรคที่พบบ่อย ปีงบประมาณ 2560 6 เดือนแรก'
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: '<b>กลุ่มโรค</b>'
                                },
                            },
                            legend: {
                                enabled: true
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: [
                            {
                                name: 'จำนวน',
                                colorByPoint: true,
                                data:$main

                            }
                            ],

                        });
                    });");
                                ?>
                            <?php } ?>
                        </div>


                        <?php
                        //use yii\grid\GridView;

                        echo GridView::widget([
                            'dataProvider' => $c21grpo,
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
                                    'label' => 'กลุ่มวินิจฉัย',
                                    'attribute' => 'grp_range'
                                ],
                                [
                                    'label' => 'กลุ่มโรค',
                                    'attribute' => 'description'
                                ],
                                [
                                    'label' => 'จำนวน',
                                    'attribute' => 'numx',
                                    'format' => ['decimal', 0]
                                ],
                            ],
                        ]);
                        ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> ผู้ป่วยใน</h5></div>
                        <div class="panel-body">

                            <div style="display: none">
                                <?php
                                echo Highcharts::widget([
                                    'scripts' => [
                                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                                    //'modules/exporting', // adds Exporting button/menu to chart
                                    //'themes/grid', // applies global 'grid' theme to all charts
                                    //'highcharts-3d',
                                    //'modules/drilldown'
                                    ]
                                ]);
                                ?>
                            </div>
                            <div id="chart_ipd">
                            </div>

                            <?php
                            $sql = "select * from r_contribution_21grp_ipd where year_budget = '2559'";
                            $rawData = Yii::$app->dbhi->createCommand($sql)->queryAll();
                            $main_data = [];
                            foreach ($rawData as $data) {
                                $main_data[] = [
                                    'name' => $data['grp_range'],
                                    'y' => $data['numx'] * 1,
                                ];
                                $main = json_encode($main_data);
                                ?>
                                <?php
                                $this->registerJs("$(function () {
                        $('#chart_ipd').highcharts({
                            colors: ['#CC99FF', '#C0C0C0', '#B9D300', '#FFFF99', '#99CC00', '#FF9900', '#33CCCC', '#FF99CC', '#808000', '#FF0000', '#FFCC00', '#993366', '#000080'],
                            chart: {
                            type: 'pie',
                            margin: 75,
                            options3d: {
                                enabled: true,
                                alpha: 10,
                                beta: 15,
                                depth: 70
                            }
                            },
                            title: {
                                text: 'กราฟแสดง 21 กลุ่มโรคที่พบบ่อย ปีงบประมาณ 2560 6 เดือนแรก'
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: '<b>กลุ่มโรค</b>'
                                },
                            },
                            legend: {
                                enabled: true
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: [
                            {
                                name: 'จำนวน',
                                colorByPoint: true,
                                data:$main

                            }
                            ],

                        });
                    });");
                                ?>
                            <?php } ?>

                            <div>
                                <?php
                                //use yii\grid\GridView;

                                echo GridView::widget([
                                    'dataProvider' => $c21grpi,
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
                                            'label' => 'กลุ่มวินิจฉัย',
                                            'attribute' => 'grp_range'
                                        ],
                                        [
                                            'label' => 'กลุ่มโรค',
                                            'attribute' => 'description'
                                        ],
                                        [
                                            'label' => 'จำนวน',
                                            'attribute' => 'numx',
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
