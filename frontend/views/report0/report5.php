<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์เครื่องสำรองไฟ';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=> 'UPS(เครื่องสำรองไฟ)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )
        
        ?>