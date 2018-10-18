<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\ChospitalAmp;
use frontend\models\Csex;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title='Death-ipd';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['deaths/index']];
$this->params['breadcrumbs'][] = 'รายงาน10อันดับโรคผู้ป่วยในทั้งหมดเสียชีวิตในโรงพยาบาล(ภาพรวมIPD)';
?>
<b style="color:blue">รายงาน10อันดับโรคผู้ป่วยในทั้งหมดเสียชีวิตในโรงพยาบาล</b> <b style="color: red">(ภาพรวมIPD)</b>)
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
<?php //echo $sql;?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before'=>'<b style="color:blue">รายงาน10อันดับโรคผู้ป่วยในทั้งหมดเสียชีวิตในโรงพยาบาล</b> '
        ],
]
);

    ?>
    <div class="alert alert-danger">
        <?=$sql?>
    </div>


    
