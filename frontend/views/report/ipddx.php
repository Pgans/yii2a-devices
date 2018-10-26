<?php
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use common\models\RContributionIpd;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;



$this->title = 'IPDDX10';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงาน 10 อันดับโรคIPD ';
?>
    <b>รายงาน 10 อันดับโรคIPD</b>
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
    echo Html::a('ทั้งหมด', ['report/dxipd_all'], ['class' => 'btn btn-success', 'id'=>'modalButton','target'=>'_blank']);
    ActiveForm::end();?>
    <?php ActiveForm::end(); ?>
</div>
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงาน 10 อันดับโรคIPD</b><b style="color: red">(ตัดรหัส Z00-Z99,O00-O99)</b>',
            'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2
],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ]
        ,
                [
                    'attribute' => 'ICD10_TM',
                    'header' => 'รหัสโรค'
                ],
                [
                    'attribute' => 'ICD_NAME',
                    'header' => 'ชื่อโรค'
                ],
                [
                    'attribute' => 'amount',
                    'header' => 'จำนวน',
                    'format'=>['decimal',0]
                ],
               
            ]
        ]);
        ?>

        <div class="alert alert-info">
            <?=$sql?>
        </div>