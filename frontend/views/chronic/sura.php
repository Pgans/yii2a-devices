<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = "Sura";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['chronic/index']];
$this->params['breadcrumbs'][] = 'รายงานทะเบียนคัดกรองการดื่มสุรา';
?>
<b style="color:blue ">รายงานทะเบียนคัดกรองการดื่มสุรา</b> <b style="color: red">(คน)</b>

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
            'before'=>'<b style="color:blue ">รายงานทะเบียนคัดกรองการดื่มสุรา  โครงการค้นตนเลิกเหล้าเข้าพรรษา</b>(<b style="color: red">1B612</b>)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
    
        <div class="alert alert-info">
            <?=$sql?>
        </div>
