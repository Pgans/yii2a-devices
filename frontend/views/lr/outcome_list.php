<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title ="OUTCOME-LIST";
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานเด็กทารกที่คลอดในโรงพยาบาล</b>(<b style="color: red">คน</b>)',
            'after'=>'<b style="color:red">ประมวลผล </b>'.date('Y-m-d H:i:s')
            ]]
        )

        ?>
        <div class="alert alert-danger"><?=$sql?><div>
