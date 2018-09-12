
<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงานอุปกรณ์คอมพิวเตอร์', 'url' => ['computer/index']];
$this->params['breadcrumbs'][] = 'รายงานจำนวนอุกรณ์ซื้อใหม่ปีงบ2559';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานแยกจองห้องประชุมรายห้อง',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'id',
            'header' => 'รหัสประเภท',
        ],
        [
            'attribute' => 'ห้องประชุม',
            'format' => 'raw',
            'value' => function($model) {
                $id = $model['id'];
                $name = $model['ห้องประชุม'];
                return Html::a(Html::encode($name), ['computer/devicelist59', 'id' => $id]);
            }
                ],
                        [
                    'attribute' => 'จำนวน',
                    'header' => 'จำนวน(คน)'
                ],
                        ]
       ] )


        ?>
            <div class="alert alert-danger">
                <?=$sql?>

            </div>
        