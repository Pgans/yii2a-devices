<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = "ER-DX";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงาน5อันดับโรค(ER)';
?>
<b>รายงาน5อันดับโรค(ER)</b>
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
//return $this->redirect(array('report/dsc_list', ['date1' => $date1, 'date1' => $date2]));
echo GridView::widget([
        'dataProvider' => $dataProvider,
        
        'panel' => [
            'before'=>'<b style="color:blue ">รายงาน5อันดับโรค(ER)</b><b style="color: red">(ตัดรหัส Z00-Z99)</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
              'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'ICD10_TM',
                        'header' => 'รหัสโรค',
                    ],
                    [
                        'attribute' => 'ICD_NAME',
                        'header' => 'ชื่อโรค',
                    ],
                    [
                        'attribute' => 'จำนวนผู้ป่วย',
                        'format' => 'raw',
                        'value' => function($model) {
                            $icd10tm = $model['ICD10_TM'];
                            $amount = $model['AMOUNT'];
                            return Html::a(Html::encode($amount), ['report/er5dx_list','icd10tm' => $icd10tm],['target'=>'_blank']);
                        }
                            ],
                  ]
                ]
                    );
                    
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
