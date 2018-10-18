<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use frontend\models\Departments;

$this->title = "DEP_DEVICES";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['reg/index']];
$this->params['breadcrumbs'][] = 'รายงานจำนวนอุปกรณ์แยกตามแผนก';
?>
<b style = "color:blue">รายงานอุปกรณ์คอมพิวเตอร์แยกตามแผนก</b>
<div class='well'>
     <?php $form = ActiveForm::begin([
    'method' => 'POST',
    'action' => ['computer/depdevices'],
]); ?>
        <?php
        $items = ArrayHelper::map(Departments::find()->all(), 'dep_id', 'dep_name');
        echo Html::dropDownList('depid', $depid, $items, ['prompt' => '--- หน่วยบริการ ---']);
        ?>
        <button class='btn btn-success'> ตกลง </button>
        <?
       // if (!in_array($ex_id, $skip_id)) {
            echo Html::a('ทั้งหมด', ['computer/depdevice_all'], ['class' => 'btn btn-warning', 'style' => 'margin-left:5px'],['target'=>'_blank']);
        //}
        ?>
      <?php ActiveForm::end(); ?>
      <div class='well'>
    <?php
    $skip_id = ['c10a2aa18f688027da4746eff598172b', 'eaf586ae6959ac7ef7d30513aa05a4d2'];

    $form = ActiveForm::begin([
               // 'method' => 'get',
                //'action' => Url::to(['/hdcex/default/report-id']),
    ]);
    
    
        echo Html::a('ทั้งหมด', ['/hdcex/default/report-all', 'ex_id' => $ex_id, 'title' => $title, 'hospcode' => 'all'], ['class' => 'btn btn-warning', 'style' => 'margin-left:5px']);
    

    ActiveForm::end();
    ?>
</div>
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานอุปกรณ์คอมพิวเตอร์แยกตามแผนก</b><b style="color: red">(เครื่อง)</b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
