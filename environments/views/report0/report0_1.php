<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/report1']];
$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานอุปกรณ์คอมพิวเตอร์',
            'after'=>'ประมวลผล' .date('Y-m-d H:i:s')
            ]]
        )
        
        ?>
        <div class="alert alert-danger">
            <?=$sql?>
        </div>