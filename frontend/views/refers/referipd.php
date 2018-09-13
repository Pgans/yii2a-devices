<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = "REFER-IPD";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['refers/index']];
$this->params['breadcrumbs'][] = 'รายงานRefersผู้ป่วยในแยกตามหน่วยบริการ';
?>
<b>รายงานRefersผู้ป่วยในแยกตามหน่วยบริการ</b>
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
<?php
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานRefersผู้ป่วยในแยกตามหน่วยบริการ',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              [
                  'attribute' => 'UNIT_ID',
                  'header' => 'รหัสรพ.',
              ],
              [
                  'attribute' =>'UNIT_NAME',
                  'header' => 'ชื่อรพ.'
              ],
              [
                  'attribute' => 'จำนวนผู้ป่วย',
                  'format' => 'raw',
                  'value' => function($model) {
                      $unitid = $model['UNIT_ID'];
                      $total = $model['AMOUNT'];
                      return Html::a(Html::encode($total), ['report/referipd_list', 'UNIT_ID' => $unitid],['target'=>'_blank']);
                  }
                      ],
            ]
          ]
              )

              ?>
                  <div class="alert alert-danger">
                      <?=$sql?>
                  </div>
