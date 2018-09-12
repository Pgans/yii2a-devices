<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์แยกตามแผนก';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานอุปกรณ์คอมพิวเตอร์แยกตามแผนก',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'dep_id',
                'header' => 'รหัสแผนก',
        ],
        [
            'attribute' => 'แผนก',
            'format' => 'raw',
            'value' => function($model) {
                $depid = $model['dep_id'];
                $depname = $model['แผนก'];
                return Html::a(Html::encode($depname), ['report/rdep01', 'dep_id' => $depid]);
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