<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานจำหน่ายอุปกรณ์ทั้งหมด';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=> 'จำหน่ายอุปกรณ์ทั้งหมด',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )
        
        ?>