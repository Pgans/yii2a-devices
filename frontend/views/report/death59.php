<?php
/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'DEATH-IPD';

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานนับผู้ป่วยในเสียชีวิตในโรงพยาบาล';
?>
<b>รายงานนับผู้ป่วยมารับบริการแยกตามแผนกที่ลงทะเบียน</b>
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
                        'attribute' => 'WARD_NAME'
                    ],
                    [
                        'attribute' => 'amount',
                        'format' => 'raw',
                        'value' => function($model) {
                            $wardno = $model['WARD_NO'];
                            $amount = $model['แผนกที่รับบริการ'];
                            return Html::a(Html::encode($amount), ['report/deathipd_list', 'WARD_NO' => $wardno]);
                        }
                            ],                   
                  ]
                ]
                    )

                    ?>
                    <div class="alert alert-danger">
                        <?=$sql?>
                    </div>
