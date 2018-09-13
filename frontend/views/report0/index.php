<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงาน</h1>

<p>
    <?=  Html::a('รายงานอุปกรณ์คอมพิวเตอร์แยกตามประเภท',['report/report1']) ?>
</p>
<p>
    <?=  Html::a('รายงานอุปกรณ์คอมพิวเตอร์แยกแผนก',['report/rdep1']) ?>
</p>
<p>
    <?=  Html::a('รายงานจำหน่ายอุปกรณ์คอมพิวเตอร์',['report/report6']) ?>
</p>
<p>
    <?=  Html::a('รายงานส่งซ่อมร้านภายนอก',['report/report7']) ?>
</p>