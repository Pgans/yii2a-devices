<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = "REFER-IN";
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานรับRefers';
?>
<b>รายงานรับRefers</b>
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
            'before'=>'รายงานรับRefers',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              [
                  'attribute' => 'hospid',
                  'header' => 'รหัสรพ.',
              ],
              [
                  'attribute' =>'hosp_name',
                  'header' => 'ชื่อรพ.'
              ],
              [
                  'attribute' => 'จำนวนผู้ป่วย',
                  'format' => 'raw',
                  'value' => function($model) {
                      $hospid = $model['hospid'];
                      $total = $model['TOTAL'];
                      return Html::a(Html::encode($total), ['report/referin_list', 'hospid' => $hospid],['target'=>'_blank']);
                  }
                      ],
            ]
          ]
              )

              ?>
                  <div class="alert alert-danger">
                      <?=$sql?>
                  </div>
