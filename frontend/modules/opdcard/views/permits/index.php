<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\opdcard\models\PermitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'การยืมเวชระเบียนผู้ป่วยนอกและผู้ป่วยใน';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="permits-index">

    <h1><?= Html::encode($this->title) ?></h1>
     
    <p>
        <?= Html::button('เพิ่มการยืม', ['value'=>Url::to(['permits/create']), 'class' => 'btn btn-danger','id'=>'modalButton']); ?>
        <?= Html::a('กำหนดการส่งคืนเวชระเบียนภายใน 7 วัน', ['create'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?php Modal::begin([
        'id' => 'modal',
        'header' => '<h4><a color-blue>CREATE PERMITS</a></h4>',
        'size'=>'modal-lg',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
        ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'AN',
            'HN',
            'fullname',
            'treatments.treatment_name',
             'createdBy.firstname',
             'createdBy.lastname',
             'created_at',
             //'updater.firstname',
             //'updated_at',
             //'status.status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>


