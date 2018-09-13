<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Outstan';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['reg/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้รับบริการนอกโรงพยาบาล';
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
            'before'=>'รายงานผู้รับบริการนอกโรงพยาบาล)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'UNIT_ID',
                        'header' => 'รหัส',
                    ],
                    [
                        'attribute' => 'UNIT_NAME',
                        'header' => 'แผนก',
                    ],
                    [
                        'attribute' => 'จำนวนผู้ป่วย',
                        'format' => 'raw',
                        'value' =>function($model) {
                            $unitid = $model['UNIT_ID'];
                            $amount = $model['amount'];
                            return Html::a(Html::encode($amount), ['report/outstan_list','unit_id' => $unitid],['target'=>'_blank']);
                        }
                            ],
                       ]
                  ]);
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
