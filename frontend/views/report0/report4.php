<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์เครื่องพิมพ์';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=> 'Printers(เครื่องพิมพ์)',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )
        
        ?>