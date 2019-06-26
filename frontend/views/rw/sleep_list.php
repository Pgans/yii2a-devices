<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title ="sleep_list";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อเข้ามา';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">ผู้ป่วยในสิทธิ์ประกันสังคม</b>(<b style="color: red">จำนวนวันนอน</b>)',
            'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 
            ]]
            )
            ?>
            <div class="alert alert-info"><?=$sql?></div>
        
        