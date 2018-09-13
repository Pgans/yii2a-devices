
<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงานอุปกรณ์คอมพิวเตอร์', 'url' => ['computer/index']];
$this->params['breadcrumbs'][] = 'รายงานจำนวนอุกรณ์ซื้อใหม่ปีงบ2559';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานจำนวนอุกรณ์ซื้อใหม่ปีงบ2559',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'catid',
            'header' => 'รหัสประเภท',
        ],
        [
            'attribute' => 'ประเภท',
            'format' => 'raw',
            'value' => function($model) {
                $catid = $model['catid'];
                $name = $model['ประเภท'];
                return Html::a(Html::encode($name), ['computer/devicelist59', 'catid' => $catid]);
            }
                ],
                        [
                    'attribute' => 'จำนวน',
                    'header' => 'จำนวน(เครื่อง)'
                ],
                        ]
       ] )


        ?>
            <div class="alert alert-danger">
                <?=$sql?>

            </div>
        