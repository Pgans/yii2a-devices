<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title ="dead_sepsis";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อเข้ามา';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">ผู้ป่วยServere Sepsis</b>(<b style="color: red">Dead Comunity R611::R572</b>)',
            'after'=>'<b style="color:red">ประมวลผลจากวันที่ </b>'.$date1   .'<b style="color:red">ถึงวันที่</b>' .$date2 
            ]]
            )
            ?>
            <!-- <div class="alert alert-info"><?=$sql?></div> -->
        
        