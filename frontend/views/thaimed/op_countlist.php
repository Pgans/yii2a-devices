<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use common\models\RContributionIpd;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use \miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\export\ExportMenu;

$this->title ="opcount";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อเข้ามา';

?>
<div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i> หัตถการแพทย์แผนไทยในสถานบริการ</h5></div>
                        <div class="panel-body">
                        
                    
        <div>
                                <?php
                                //use yii\grid\GridView;
                                echo GridView::widget([
                                    'dataProvider' => $inData,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                    ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'panel' => [
                                        'before'=>'<b style="color:blue ">ผู้ทำหัตถการแพทย์แผนไทย</b>(<b style="color: red">ในสถานบริการ</b>)',
                                        //'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'เดือน',
                                            'attribute' => 'MONTH'
                                        ],
                                        [
                                            'attribute' => 'acupencture',
                                            'label' => 'ฝังเข็ม',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'nursing',
                                            'label' => 'บริบาล',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'massage',
                                            'label' => 'การนวด',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'baked',
                                            'label' => 'อบ',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'compression',
                                            'label' => 'ประคบ',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'songserm',
                                            'label' => 'ส่งเสริม',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'Total',
                                            'label' => 'รวม',
                                            'format' => ['decimal', 0]
                                        ], 
                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="kv-panel-pager">
                                หมายเหตุ :: นับหัตถการรวมทั้งการส่งเสริม ฝังเข็ม
                                <p>
                    
                            </div>
                        </div>
                    </div>
                </div>

            <div>
            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading"><h5><i class="glyphicon glyphicon-list-alt"></i>หัตถการแพทย์แผนไทยนอกสถานบริการ</h5></div>
                                    <?php
                                //use yii\grid\GridView;
                                echo GridView::widget([
                                    'dataProvider' => $outData,
                                    'responsive' => true,
                                    'hover' => true,
                                    'panel' => [
                                        'before' => ' ',
                                    ],
                                    'pjax' => true,
                                    'pjaxSettings' => [
                                        'neverTimeout' => true,
                                    ],
                                    'panel' => [
                                        'before'=>'<b style="color:blue ">ผู้ทำหัตถการแพทย์แผนไทย</b>(<b style="color: red">นอกสถานบริการ</b>)',
                                        //'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label' => 'เดือน',
                                            'attribute' => 'MONTH'
                                        ],
                                        [
                                            'attribute' => 'acupencture',
                                            'label' => 'ฝังเข็ม',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'nursing',
                                            'label' => 'บริบาล',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'massage',
                                            'label' => 'การนวด',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'baked',
                                            'label' => 'อบ',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'compression',
                                            'label' => 'ประคบ',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'songserm',
                                            'label' => 'ส่งเสริม',
                                            'format' => ['decimal', 0]
                                        ],
                                        [
                                            'attribute' => 'Total',
                                            'label' => 'รวม',
                                            'format' => ['decimal', 0]
                                        ], 
                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="kv-panel-pager">
                                หมายเหตุ :: นอกสถานบริการ
                               
                            </div>
                        </div>
                    </div>
                </div>
 
 

        
        

        