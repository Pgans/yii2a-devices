<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'ANS-MAN';
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['hosp43/index']];
$this->params['breadcrumbs'][] = 'ผู้มารับบริการเพศชายแต่มาANC';

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'ผู้มารับบริการเพศชายแต่มาANC(hospital)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ],
    ]
  );

        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>
