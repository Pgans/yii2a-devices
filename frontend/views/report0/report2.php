<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์Notebook';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=> 'Notebook',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )
        
        ?>