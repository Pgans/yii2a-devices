<?php

use yii\helpers\Html;
use components\MyHelper;
use modules\adhoc\models\DhdcAdhoc;
use kartik\grid\GridView;
use yii\db\Exception;
use yii\data\ArrayDataProvider;

$this->title = 'ผลลัพธ์';
$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$model = DhdcAdhoc::findOne($id);
$title = $model->title;
$sql = trim($model->sql_report);
if (substr($sql, -1) == ';') {
    $sql = $sql;
} else {
    $sql = $sql . ";";
}
try {
    $raw = \Yii::$app->db->createCommand($sql)->queryAll();
    $dataProvider = new ArrayDataProvider([
        'allModels' => $raw
    ]);
} catch (Exception $e) {
    throw new \yii\web\ForbiddenHttpException('sql error');
}
?>
<div>
    <?php
    echo GridView::widget([
        'responsiveWrap' => false,
        'dataProvider' => $dataProvider,
        'panel' => ['before' => $title]
    ]);
    ?>
</div>

