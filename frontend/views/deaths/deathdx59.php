<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;


$this->title='Death-dx';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['deaths/index']];
$this->params['breadcrumbs'][] = 'รายงานอันดับโรคผู้ป่วยเสียชีวิตทั้งหมดในโรงพยาบาล';
?>
<b>รายงานอันดับโรคผู้ป่วยเสียชีวิตทั้งหมดในโรงพยาบาล(เลือกได้ปี2010-ปัจจุบัน)</b>
<div class='well'>
    <?php $form = ActiveForm::begin(); ?>
     วันที่ระหว่าง:
           <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        ถึง:
           <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        <button class='btn btn-danger'> ตกลง </button>

    <?php ActiveForm::end(); ?>
</div>
<?php //echo $sql;?>

<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานอันดับโรคผู้ป่วยเสียชีวิตทั้งหมดในโรงพยาบาล',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
          'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'CDEATH',
                        //'header' => 'รหัสแผนก',
                    ],
                    
                         [
                                'attribute' => 'CDEATH_A',
                                //'header' => 'แผนกที่ลงทะเบียน'
                            ],
                            [
                                'attribute' => 'TOTAL',
                                'format' => 'raw',
                                'value' => function($model) {
                                    $cdeath = $model['CDEATH'];
                                    $total = $model['TOTAL'];
                                    return Html::a(Html::encode($total), ['deaths/death_list','cdeath' => $cdeath],['target'=>'_blank']);
                                }
                                    ],
                  ]
                ]
                    )
                    ?>
                    
                    <div class="alert alert-danger">
                        <?=$sql?>
                    </div>
               
                  <!--<?php
                  use miloschuman\highcharts\Highcharts;
                    Highcharts::widget([
                        'scripts' => [
                            'highcharts-more',
                            'themes/grid'
                        ]
                    ]);
                    ?>
                    <div id ="chart"> </div>
                   <?php
                    //chart start
          $this->registerJs("
                     $('#chart').highcharts({
                        colors: ['#ED921C', '#1F7CDB'],
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Monthly Average Rainfall'
                        },
                        subtitle: {
                            text: 'Source: WorldClimate.com'
                        },
                        xAxis: {
                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ],
                            crosshair: true
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Rainfall (mm)'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                '<td style=\"padding:0\"><b>{point.y:.1f} mm</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [{
                            name: 'Tokyo',
                            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

                        }, {
                            name: 'New York',
                            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

                        }, {
                            name: 'London',
                            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                        }, {
                            name: 'Berlin',
                            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                        }]
                    }); 
                 ");
                    //chart end
                    ?>

    -->
