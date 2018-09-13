<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\ChospitalAmp;
use frontend\models\Csex;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title='Death-ipd';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยในเสียชีวิตและระบุชื่อโรค';
?>
<b>รายงานผู้ป่วยในเสียชีวิตและระบุชื่อโรค</b>
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
            'before'=>'รายงานผู้ป่วยในเสียชีวิตและระบุชื่อโรค',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
              'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'WARD_NO',
                        'header' => 'รหัสแผนก',
                    ],
                    [
                        'attribute' => 'UNIT_NAME',
                        'header' => 'รหัสแผนก',
                    ],
                    [
                        'attribute' => 'amount',
                        'format' => 'raw',
                        'value' => function($model) {
                            $wardno = $model['WARD_NO'];
                            $amount = $model['amount'];
                            return Html::a(Html::encode($amount), ['report/deathipd_list', 'wardno' => $wardno],['target'=>'_blank']);
                        }
                            ],                   
                  ]
                ]
                    )

                    ?>
                    <div class="alert alert-danger">
                        <?=$sql?>
                    </div>


    
