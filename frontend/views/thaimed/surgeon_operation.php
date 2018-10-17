<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'SURGEON_OPERATON';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['computer/index']];
$this->params['breadcrumbs'][] = 'รายงานการทำหัตถการแพทย์แผนไทยแยกตามผู้ทำหัตถการ';
?>
<b>รายงานการทำหัตถการแพทย์แผนไทยแยกตามผู้ทำหัตถการ</b>
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
//return $this->redirect(array('report/dsc_list', ['date1' => $date1, 'date1' => $date2]));
echo GridView::widget([
        'dataProvider' => $dataProvider,
        
        'panel' => [
            'before'=>'รายงานการทำหัตถการแพทย์แผนไทยแยกตามผู้ทำหัตถการ',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
               'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                  
                    [
                        'attribute' => 'Provider',
                        'header' => 'ชื่อผู้ทำ',
                    ],
                    [
                        'attribute' => 'SURGEON_ID',
                        'header' => 'รหัส',
                    ],
                    [
                        'attribute' => 'Acupuncture'
                    ],
                    [
                        'attribute' => 'ฝังเข็ม',
                    ],
                    [
                        'attribute' => 'บริบาล',
                    ],
                    [
                        'attribute' => 'การนวด',
                    ],
                    [
                        'attribute' => 'อบ',
                    ],
                    [
                        'attribute' => 'ประคบ',
                    ],
                    [
                        'attribute' => 'ส่งเสริม',
                    ],
                    [
                        'attribute' => 'Total ',
                        'format' => 'raw',
                        'value' => function($model) {
                            $surgeonid = $model['SURGEON_ID'];
                            $total = $model['Total'];
                            return Html::a(Html::encode($total), ['thaimed/surgeon_operation_list','surgeonid'=> $surgeonid],['target'=>'_blank']);
                        }
                            ],
                  ]
                ]
                    );
                    
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
