<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title ="ADMIT-LIST";
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานสูติกรรมนอนโรงพยาบาล</b>(<b style="color: red">ครั้ง</b>)',
            'after'=>'<b style="color:red">ประมวลผล </b>'.date('Y-m-d H:i:s')
            ]]
        )

        ?>
        <div class="alert alert-danger"><?=$sql?><div>
