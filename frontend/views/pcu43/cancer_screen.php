<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'CANCER';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['pcu43/index']];
$this->params['breadcrumbs'][] = 'ผู้มารับบริการตรวจมะเร็งเต้านมอายุไม่อยู่ในช่วง30-70ปี(43F)';
?>
<b>ผู้มารับบริการตรวจมะเร็งเต้านมอายุไม่อยู่ในช่วง30-70ปี</b>
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
            'before'=>'<b style="color:blue ">ผู้มารับบริการตรวจมะเร็งเต้านมอายุไม่อยู่ในช่วง30-70ปี</b>
            <b style="color: red">(Typearea= 1,3 Nation=099)</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
<?php //echo $sql;?>