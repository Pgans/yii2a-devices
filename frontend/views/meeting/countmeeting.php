
<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงานแยกจองห้องประชุม', 'url' => ['meeting/index']];
$this->params['breadcrumbs'][] = 'รายงานการจองห้องประชุมรายห้อง';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานแยกจองห้องประชุมรายห้อง',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'room_id',
            'header' => 'รหัสห้อง',
        ],
        [
            'attribute' => 'room_name',
            'format' => 'raw',
            'value' => function($model) {
                $roomid = $model['room_id'];
                $name = $model['room_name'];
                return Html::a(Html::encode($name), ['meeting/meetinglist', 'room_id' => $roomid]);
            }
                ],
                        [
                    'attribute' => 'จำนวน',
                    'header' => 'จำนวน(ครั้ง)'
                ],
                        ]
       ] )


        ?>
            <div class="alert alert-danger">
                <?=$sql?>

            </div>
        