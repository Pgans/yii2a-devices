<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'DEATHS';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['deaths/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้เสียชีวิตในโรงพยาบาล(OPD-IPD)';
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
        <?php $form = ActiveForm::begin([ ]);
    echo Html::a('Dxว่าง', ['deaths/death_dxnull'], ['class' => 'btn btn-success', 'style' => 'margin-left:5px','target'=>'_blank']);
    echo Html::a('จัดกลุ่มอันดับโรค', ['deaths/death_group'], ['class' => 'btn btn-primary', 'style' => 'margin-left:5px','target'=>'_blank']);
    ActiveForm::end();?>
    <?php ActiveForm::end(); ?>
</div>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before'=>'<b><a>รายงานผู้เสียชีวิตในโรงพยาบาล(OPD-IPD)</a></b>',
        'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
      ],
          'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'DEATHS',
                    'header' => 'จำนวนผู้เสียชีวิต',
                ],
                [
                    'attribute' => 'OPD',
                    'header' => 'ผู้ป่วยนอก',
                ],
                [
                    'attribute' => 'IPD',
                    'header' => 'ผู้ป่วยใน',
                ],
                [
                    'attribute' => 'Total',
                    'format' => 'raw',
                    'value' => function($model) {
                       # $wardno = $model['WARD_NO'];
                        $amount = $model['Total'];
                        return Html::a(Html::encode($amount), ['deaths/death_all_list'],['target'=>'_blank']);
                    }
                        ],                   
              ]
            ]
                )

                ?>
                <div class="alert alert-danger">
                    <?=$sql?>
                </div>


        