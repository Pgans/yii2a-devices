<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report-mbase/referout58']];
$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อรายคนตามปีงบ2558';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงานผู้ปวยส่งต่อรายคน ปีงบ2558',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )

        ?>
