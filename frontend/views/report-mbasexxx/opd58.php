<?php
use kartik\grid\GridView;
$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report-mbase/index']];
$this->params['breadcrumbs'][] = 'รายงาน5อันดับโรคแผนกตรวจโรคทั่วไป ปี2558';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'รายงาน5อันดับโรคแผนกตรวจโรคทั่วไป ปี2558',
            'after'=>'ประมวลผล '.date('Y-m-d H:i:s')
            ]]
        )

        ?>
