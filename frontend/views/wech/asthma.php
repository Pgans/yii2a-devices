<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'asthma';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['pharm/index']];
$this->params['breadcrumbs'][] = 'รายงานมารับบริการแผนกหอบหืด(J45-J46)';
?>
<b>รายงานมารับบริการแผนกหอบหืด(J45-J46)</b>
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
            'before'=>'<b style="color:blue ">รายงานมารับบริการแผนกหอบหืด(J45-J46)</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>