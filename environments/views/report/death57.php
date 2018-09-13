<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาลและระบุชื่อโรค57';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ป่วยเสียชีวิตในโรงพยาบาลและระบุชื่อโรค57',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
          ],
              'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'unit_id',
                        'header' => 'รหัสแผนก',
                    ],
                    [
                        'attribute' => 'แผนกที่รับบริการ',
                        'format' => 'raw',
                        'value' => function($model) {
                            $unitid = $model['unit_id'];
                            $cuname = $model['แผนกที่รับบริการ'];
                            return Html::a(Html::encode($cuname), ['report/death_list57', 'unit_id' => $unitid]);
                        }
                            ],
                         [
                                'attribute' => 'จำนวนผู้ป่วย',
                                'header' => 'จำนวนผู้ป่วย(คน)'
                            ],
                  ]
                ]
                    )

                    ?>
                    <div class="alert alert-danger">
                        <?=$sql?>
                    </div>
