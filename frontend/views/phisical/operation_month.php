<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Operation_month';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['computer/index']];
$this->params['breadcrumbs'][] = 'รายงานทำหัตถการกายภาพบำบัดในสถานบริการแยกตามเดือน';
?>
<b><a>รายงานผู้สั่งทำหัตถการกายภาพบำบัดในสถานบริการแยกตามเดือน</a></b>
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
            'before'=>'<b><a>รายงานผู้สั่งทำหัตถการกายภาพบำบัดในสถานบริการแยกตามเดือน</a></b>',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
               'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'MONTH',
                        'label' => 'เดือน',
                    ],
                    [
                        'attribute' => 'FNAME',
                        'label' => 'ชื่อผู้สั่ง',
                    ],
                    [
                        'attribute' => 'STAFF_ID',
                        'header' => 'รหัส',
                    ],
                    [
                        'attribute' => 'AMOUNT ',
                        'format' => 'raw',
                        'value' => function($model) {
                            $staffid = $model['STAFF_ID'];
                            $month = $model['MONTH'];
                            $total = $model['AMOUNT'];
                            return Html::a(Html::encode($total), ['phisical/operation_month_list','staffid'=> $staffid,month =>$month],
                            ['target'=>'_blank']);
                        }
                            ],
                  ]
                ]
                    );
                    
                    ?>
                    
                    <div class="alert alert-danger"><?=$sql?> </div>
