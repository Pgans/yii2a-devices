<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->title ="specall30";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อเข้ามา';
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">รายงานพัฒนาการเด็กสมวัยแยกตามอายุ30เดือน</b>',
            'after'=>'<b style="color:red">ประมวลผล </b>'.date('Y-m-d H:i:s') .'<a>รหัสตำบล</a>' .$townid,
            ]]
        )

        ?>
     
