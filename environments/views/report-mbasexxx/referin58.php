<?php
use kartik\grid\GridView;
use yii\helpers\Html;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานรับRefers ตามปีงบ2558';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานรับRefers ตามปีงบ2558',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              [
                  'attribute' => 'hospid',
                  'header' => 'รหัสรพ.',
              ],
              [
                  'attribute' => 'hosp_name',
                  'format' => 'raw',
                  'value' => function($model) {
                      $hospid = $model['hospid'];
                      $hospname = $model['hosp_name'];
                      return Html::a(Html::encode($hospname), ['report/referin58_list', 'hospid' => $hospid]);
                  }
                      ],
                   [
                          'attribute' => 'TOTAL',
                          'header' => 'จำนวนผู้ป่วย(คน)'
                      ],
            ]
          ]
              )

              ?>
                  <div class="alert alert-danger">
                      <?=$sql?>
                  </div>
