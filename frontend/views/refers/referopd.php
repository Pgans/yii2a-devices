<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = "REFER-OPD";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['refers/index']];
$this->params['breadcrumbs'][] = 'รายงานRefersส่งต่อแยกตามแผนกบริการ(OPD-ER)';
?>
<b>รายงานRefersส่งต่อแยกตามแผนกบริการ(OPD-ER)</b>
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
            'before'=>'รายงานRefersส่งต่อแยกตามแผนกบริการ(OPD-ER)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              [
                  'attribute' => 'UNIT_ID',
                  'header' => 'รหัสหน่วย.',
              ],
              [
                  'attribute' =>'UNIT_NAME',
                  'header' => 'ชื่อหน่วยบริการ.'
              ],
              [
                  'attribute' => 'จำนวนผู้ป่วย',
                  'format' => 'raw',
                  'value' => function($model) {
                      $unitid = $model['UNIT_ID'];
                      $total = $model['AMOUNT'];
                      return Html::a(Html::encode($total), ['refers/referopd_list', 'UNIT_ID' => $unitid],['target'=>'_blank']);
                  }
                      ],
            ]
          ]
              )

              ?>
                  <div class="alert alert-danger">
                      <?=$sql?>
                  </div>
