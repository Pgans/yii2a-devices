<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use common\models\RContributionIpd;
use yii\data\ActiveDataProvider;



$this->title = 'uc10953';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['sepsis/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยSevere Sepsis';
?>
        <b><a>รายงานผู้ป่วย Severe Sepsis</a></b>
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
     echo Html::a('Deadด้วยCommunity', ['sepsis/deadsepsis'], ['class' => 'btn btn-success', 'style' => 'margin-left:5px','target'=>'_blank']);
     echo Html::a('Refer', ['sepsis/refersepsis'], ['class' => 'btn btn-warning', 'style' => 'margin-left:5px','target'=>'_blank']);
  
    ActiveForm::end();?>
    <?php ActiveForm::end(); ?>
</div>
<div>
<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before'=>'<b style="color:blue ">รายงานผู้ป่วยSevere SEPSIS ที่มาด้วยประเภท Primary , Co-Morblity</b>(<b style="color: red">R651, R572</b>)',
        'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 
        ],
]
);