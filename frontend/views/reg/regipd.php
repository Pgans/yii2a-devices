<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = "REGIPD";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['reg/index']];
$this->params['breadcrumbs'][] = 'รายงานยอดผู้ป่วยในแยกตามเดือน';
?>
<b style = "color:blue">รายงานยอดผู้ป่วยในแยกตามเดือน Medic</b>
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
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานยอดผู้ป่วยในแยกตามเดือน',
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
                        'attribute' => 'UNIT_NAME',
                        'header' => 'รหัสแผนก',
                    ],
                    [
                        'attribute' => 'จำนวนผู้ป่วย',
                        'format' => 'raw',
                        'value' =>function($model) {
                            $mm = $model['MM'];
                            $unitname= $model['UNIT_NAME'];
                            $amount = $model['AMOUNT'];
                            return Html::a(Html::encode($amount), ['reg/regipd_list','MM' => $mm,'unitname'=>$unitname],['target'=>'_blank']);
                        }
                            ],
                       ]
                  ]);
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
