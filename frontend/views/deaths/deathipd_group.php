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
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยในเสียชีวิตแบบจัดกลุ่มและรายคน';
?>
<b><a>รายงานผู้ป่วยในเสียชีวิตแบบจัดกลุ่มและรายคน</a></b>
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
        <?
            echo Html::a('จัดอันดับโรค', ['deaths/death_dscgroup'], ['class' => 'btn btn-primary', 'style' => 'margin-left:5px','target'=>'_blank']);
        ?>
        
    <?php ActiveForm::end(); ?>
</div>
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue">รายงานผู้ป่วยในเสียชีวิตแบบจัดกลุ่มและรายคน</b> ',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
                    ?>
                    <div class="alert alert-danger">
                        <?=$sql?>
                    </div>


    
