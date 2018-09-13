<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title ="REFER-OUT_ALL";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['refers/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(นอกจังหวัด)';
?>
<b>รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(Refers)</b>
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
            'before'=>'รายงานผู้มารับบริการในโรงพยาบาลที่มีการส่งต่อ(นอกจังหวัด)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'hospid',
            'header' => 'รหัสรพ.',
        ],
        [
            'attribute' => 'hosp_name',
            'format' => 'raw',
            'value' => function($model) {
                $hospid = $model['hospid'];
                $hospname = $model['hosp_name'];
                return Html::a(Html::encode($hospname), ['refers/referout_all_list',
                 'hospid' => $hospid],['target'=>'_blank']);
            }
                ],
             [
                    'attribute' => 'Total',
                    'header' => 'จำนวนผู้ป่วย(คน)'
                ],
      ]
    ]
        )

        ?>
            <div class="alert alert-danger">
                <?=$sql?>
            </div>
