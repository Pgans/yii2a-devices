<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title ="DEPRESS-LIST";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อเข้ามา';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานผู้ป้วยโรคซึมเศร้า F320-F329(ครั้ง)</b>(<b style="color: red">DEPRESS</b>)',
            'after'=>'<b style="color:red">ประมวลผล </b>'.date('Y-m-d H:i:s')
            ]]
        )

        ?>
        <div class="alert alert-warning"><?=$sql?><div>
