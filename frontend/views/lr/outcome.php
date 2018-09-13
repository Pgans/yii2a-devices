<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Outcome';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['lr/index']];
$this->params['breadcrumbs'][] = 'รายงานเด็กทารกที่คลอดในโรงพยาบาล';
?>
<b>รายงานเด็กทารกที่คลอดในโรงพยาบาล</b>
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
            'before'=>'รายงานเด็กทารกที่คลอดในโรงพยาบาล',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'YYYY',
                        'header' => 'ปี',
                    ],
                    [
                        'attribute' => 'MM',
                        'header' => 'เดือน',
                    ],
                    [
                        'attribute' => 'จำนวนเด็กคลอด',
                        'format' => 'raw',
                        'value' =>function($model) {
                            $mm = $model['MM'];
                            $amount = $model['AMOUNT'];
                            return Html::a(Html::encode($amount), ['lr/outcome_list','MM' => $mm],['target'=>'_blank']);
                        }
                            ],
                       ]
                  ]);
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
