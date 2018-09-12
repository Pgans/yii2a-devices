<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report-mbase/index']];
$this->params['breadcrumbs'][] = 'รายงานรับRefers ตามปีงบ2557';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานรับRefers ตามปีงบ2557',
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
                return Html::a(Html::encode($hospname), ['report-mbase/referin57_list', 'hospid' => $hospid]);
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
