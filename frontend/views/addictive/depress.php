<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = "DEPRESS";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['addictive/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป้วยโรคซึมเศร้า F320-F329(คน)';
?>
<b style="color:DarkOrange">รายงานผู้ป้วยโรคซึมเศร้า F320-F329(คน)</b>
<div class='well'>
    <?php $form = ActiveForm::begin([
    'method' => 'POST',
    'action' => ['addictive/depress'],
]); ?>
     ระหว่างวันที่
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
            'before'=>'<b style="color:DarkOrange">รายงานผู้ป้วยโรคซึมเศร้า F320-F329(คน)</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'icd10_tm',
            'header' => '<a><b>รหัส</b></a>',
        ],
        [
            'attribute' => 'icd_name',
            'header' => '<a><b>ชื่อโรค</b></a>',
        ],

        [
            'attribute' => 'จำนวนผู้ป่วย',
            'format' => 'raw',
            'value' => function($model) {
                $code = $model['icd10_tm'];
                $amount = $model['amount'];
                return Html::a(Html::encode($amount), ['addictive/depress_list',
                 'code' => $code],['target'=>'_blank']);
            }
                ],
      ]
    ]
        )

        ?>
            <div class="alert alert-warning">
                <?=$sql?>
            </div>
