<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานผู้ป่วยส่งต่อ ตามปีงบ2558';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ป่วยส่งต่อ ตามปีงบ2558',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'hosp_id',
            'header' => 'รหัสรพ.',
        ],
        [
            'attribute' => 'hosp_name',
            'format' => 'raw',
            'value' => function($model) {
                $hospid = $model['hosp_id'];
                $hospname = $model['hosp_name'];
                return Html::a(Html::encode($hospname), ['report/referout58_list', 'hosp_id' => $hospid]);
            }
                ],
             [
                    'attribute' => 'Total',
                    'header' => 'จำนวนผู้ป่วย(คน)'
                ],
      ]
    ]
        )

        ?>
            <div class="alert alert-danger">
                <?=$sql?>
            </div>
