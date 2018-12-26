<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
 ?>
<?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax','timeout'=>5000]) ?>
<?= GridView::widget([
                'id'=>'grid-user',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                  'class' => 'table table-bordered  table-striped table-hover',
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'username',
                    'email:email',
                    [
                      'label'=>'Active',
                      'format'=>'html',
                      'value'=>function($model){
                          return $model->status==0?'<i class="glyphicon glyphicon-remove"></i> <span class="text-danger">Not Active</span>':'<i class="glyphicon glyphicon-ok"></i> <span class="text-success">Active</span>';
                      }
                    ],
                    [
                      'attribute'=>'levelName',
                      'format'=>'html',
                      'value'=>function($model){
                        return $model->levelName;
                      }
                    ],
                    [
                      'class' => 'yii\grid\ActionColumn',
                      'options'=>['style'=>'width:120px;'],
                      'buttonOptions'=>['class'=>'btn btn-default'],
                      'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>'
                   ],
                ],
            ]); ?>
<?php yii\widgets\Pjax::end() ?>