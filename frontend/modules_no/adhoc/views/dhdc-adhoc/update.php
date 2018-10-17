<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\adhoc\models\DhdcAdhoc */

$this->title = 'แก้ไข';
$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dhdc-adhoc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
