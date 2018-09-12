<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'DEATHS';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['deaths/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้เสียชีวิตในโรงพยาบาล';
?>
<b>รายงานANC</b>
<div class='well'>
    <?php $form = ActiveForm::begin(); ?>
     ระหว่างวันที่:
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
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้เสียชีวิตในโรงพยาบาล)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>

            
                <?php
                use miloschuman\highcharts\Highcharts;

                    echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'Fruit Consumption'],
                        'xAxis' => [
                            'categories' => ['Apples', 'Bananas', 'Oranges']
                        ],
                        'yAxis' => [
                            'title' => ['text' => 'Fruit eaten']
                        ],
                        'series' => [
                            ['name' => 'Pgans', 'data' => [1, 0, 4]],
                            ['name' => 'John', 'data' => [5, 7, 3]]
                        ]
                    ]
                    ]);
                ?>
        