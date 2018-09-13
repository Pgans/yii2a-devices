<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title ="REFER-OUT_DX";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['refers/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(Diagnosis)';
?>
<b>รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(ยกเว้น ทุกรพสต.ในอำเภอม่วงสามสิบ )</b>
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
            'before'=>'รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(Diagnosis)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'ICD10_TM',
            'header' => 'รหัสโรค.',
        ],
        [
            'attribute' => 'ICD_NAME',
            'header' => 'ชื่อโรค.',
            'format' => 'raw',
            'value' => function($model) {
                $icd10tm = $model['ICD10_TM'];
                $icdname = $model['ICD_NAME'];
                return Html::a(Html::encode($icdname), ['refers/referout_dx_list',
                 'icd10tm' => $icd10tm],['target'=>'_blank']);
            }
                ],
             [
                    'attribute' => 'AMOUNT',
                    'header' => 'จำนวนโรค'
                ],
      ]
    ]
        )

        ?>
            <div class="alert alert-danger">
                <?=$sql?>
            </div>
