<?php
use yii\helpers\Html;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;




/* @var $this yii\web\View */

$this->title = 'M30hospital(045489064)';
?>
     <div class="row">
        <div class="col-lg-4">
            <div class="panel-body">
                <?php
                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'จำนวนผู้ป่วยอุบัติเหตุ'],
                        'xAxis' => [
                            'categories' => $mm
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวน(คน)']
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'accidents',
                                'data' => $accidents,
                            ]
                        ]
                    ]
                ]);
                ?>
                </div>
            </div>

             <div class="col-lg-4">
            <div class="panel-body">
                <?php
                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'จำนวนผู้ป่วยอุบัติเหตุ'],
                        'xAxis' => [
                            'categories' => $mm
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวน(คน)']
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'accidents',
                                'data' => $accidents,
                            ]
                        ]
                    ]
                ]);
                ?>
                </div>
            </div>

        <div class="col-lg-4">
            <div class="panel-body">
                <?php
                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'จำนวนผู้ป่วยอุบัติเหตุ'],
                        'xAxis' => [
                            'categories' => $mm
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวน(คน)']
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'accidents',
                                'data' => $accidents,
                            ]
                        ]
                    ]
                ]);
                ?>
                </div>
            </div>
</div>

    <div class="row">
        <div class="col-lg-4">
            <div class="panel-body">
                <?php
                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'จำนวนผู้ป่วยอุบัติเหตุ'],
                        'xAxis' => [
                            'categories' => $mm
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวน(คน)']
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'accidents',
                                'data' => $accidents,
                            ]
                        ]
                    ]
                ]);
                ?>
                </div>
            </div>

             <div class="col-lg-4">
            <div class="panel-body">
                <?php
                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'จำนวนผู้ป่วยอุบัติเหตุ'],
                        'xAxis' => [
                            'categories' => $mm
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'จำนวน(คน)']
                        ],
                        'series' => [
                            [
                                'type' => 'column',
                                'name' => 'accidents',
                                'data' => $accidents,
                            ]
                        ]
                    ]
                ]);
                ?>
                </div>
            </div>

        <div class="col-lg-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนผู้ป่วยอุบัติเหตุ</h3>
                    </div>
             <div class="panel-body">
                    <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'label' => 'ปี',
                                'attribute' => 'yy'
                            ],
                            [
                                'label' => 'เดือน',
                                'attribute' => 'mm'
                            ],
                            [
                                'label' => 'จำนวนผู้ป่วยใน',
                                'attribute' => 'accidents'
                            ],
                        ]
                    ]);
                    ?>
                </div>
             </div> 
</div>

<div class="row">
            <div class="col-lg-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> จำนวนผู้ป่วยอุบัติเหตุ</h3>
                    </div>
             <div class="panel-body">
                    <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'label' => 'ปี',
                                'attribute' => 'yy'
                            ],
                            [
                                'label' => 'เดือน',
                                'attribute' => 'mm'
                            ],
                            [
                                'label' => 'จำนวนผู้ป่วยใน',
                                'attribute' => 'accidents'
                            ],
                        ]
                    ]);
                    ?>
                </div>
             </div> 

            


                




