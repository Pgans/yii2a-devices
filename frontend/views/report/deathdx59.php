<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title='Death-dx';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานอันดับโรคผู้ป่วยเสียชีวิตทั้งหมดในโรงพยาบาล';
?>
<b>รายงานอันดับโรคผู้ป่วยเสียชีวิตทั้งหมดในโรงพยาบาล(เลือกได้ปี2010-ปัจจุบัน)</b>
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
            'before'=>'รายงานอันดับโรคผู้ป่วยเสียชีวิตทั้งหมดในโรงพยาบาล',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
          'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'CDEATH',
                        //'header' => 'รหัสแผนก',
                    ],
                    
                         [
                                'attribute' => 'CDEATH_A',
                                //'header' => 'แผนกที่ลงทะเบียน'
                            ],
                            [
                                'attribute' => 'TOTAL',
                                'format' => 'raw',
                                'value' => function($model) {
                                    $cdeath = $model['CDEATH'];
                                    $total = $model['TOTAL'];
                                    return Html::a(Html::encode($total), ['report/death_list','cdeath' => $cdeath],['target'=>'_blank']);
                                }
                                    ],
                  ]
                ]
                    )
                    ?>
                    
                    <div class="alert alert-danger">
                        <?=$sql?>
                    </div>


    
