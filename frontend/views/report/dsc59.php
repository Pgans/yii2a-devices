<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'DSC';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานนับผู้ป่วยDischargeแยกตามแผนก';
?>
<br>
<b><a>รายงานผู้ป่วยDischarge</a></b>
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
<?php //echo $sql;?>
<?php
//return $this->redirect(array('report/dsc_list', ['date1' => $date1, 'date1' => $date2]));
echo GridView::widget([
        'dataProvider' => $dataProvider,
        
        'panel' => [
            'before'=>'รายงานผู้ป่วยDischarge',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
              'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'unit_id',
                        'header' => 'รหัสแผนก',
                    ],
                    [
                        'attribute' => 'แผนก',
                        'format' => 'raw',
                        'value' => function($model) {
                            $unitid = $model['unit_id'];
                            $cuname = $model['แผนก'];
                            return Html::a(Html::encode($cuname), ['report/dsc_list','unit_id' => $unitid],['target'=>'_blank']);
                        }
                            ],
                         [
                                'attribute' => 'จำนวนผู้ป่วย',
                                'header' => 'จำนวนผู้ป่วยDSC(คน)'
                            ],
                  ]
                ]
                    );
                    
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
