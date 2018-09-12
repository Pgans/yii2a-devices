<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report-mbase/report58']];
$this->params['breadcrumbs'][] = 'รายงานผู้ปวยDischargeรายคน';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ปวยDischarge ปีงบ2558 ',
            'after'=>'ประมวลผล' .date('Y-m-d H:i:s')
            ]]
        )
        
        ?>