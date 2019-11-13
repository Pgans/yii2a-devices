<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use frontend\models\service_units;


$this->title = 'DXOPD';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงาน 10 อันดับโรคOPD';
?>
    <br>
 <b><a>รายงาน 10 อันดับโรคOPD</a></b>
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
            'before'=>'<b style="color:blue ">รายงาน 10 อันดับโรคOPD</b><b style="color: red">(ตัดรหัส Z00-Z99)</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
              'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'icd10_TM',
                         'header' => 'รหัสโรค',
                    ],
                    [
                        'attribute' => 'icd_name',
                        'header' => 'ชื่อโรค',
                    ],
                         
                    [
                        'attribute' => 'จำนวนผู้ป่วย',
                        'format' => 'raw',
                        'value' => function($model) {
                            $icd10_TM = $model['icd10_TM'];
                            $amount = $model['amount'];
                            return Html::a(Html::encode($amount), ['report/dxopd_list','icd10_TM' => $icd10_TM],['target'=>'_blank']);
                        }
                            ],
                  ]
                ]
                    );
                    
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
