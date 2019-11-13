<?php
/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'DEP-REG';

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานนับผู้ป่วยมารับบริการแยกตามแผนกที่ลงทะเบียน';
?>
<br>
<b><a>รายงานนับผู้ป่วยมารับบริการแยกตามแผนกที่ลงทะเบียน</a></b>
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
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานนับผู้ป่วยมารับบริการแยกตามแผนกที่ลงทะเบียน',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
          'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'unit_id',
                        'header' => 'รหัสแผนก',
                    ],
                    
                         [
                                'attribute' => 'unit_name',
                                'header' => 'แผนกที่ลงทะเบียน'
                            ],
                            [
                                'attribute' => 'amount',
                                'format' => 'raw',
                                'value' => function($model) {
                                    $unitid = $model['unit_id'];
                                    $amount = $model['amount'];
                                    return Html::a(Html::encode($amount), ['report/dep_list','unit_id' => $unitid],['target'=>'_blank']);
                                }
                                    ],
                  ]
                ]
                    )
                    ?>
                    
                    <div class="alert alert-danger">
                        <?=$sql?>
                    </div>
