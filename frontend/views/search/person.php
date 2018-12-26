<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title ="m_serach";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อเข้ามา';
?>

<h1><p align="center"> POPULATION</p></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-search"></i> ค้นหาข้อมูลประชากร</div>
            <div class="panel-body">

                <?= Html::beginForm(); ?>

                <label for="pwd">ค้นหา : &nbsp;&nbsp; </label>
                <input type="text"  name="cid"  placeholder="">
                
                &nbsp;&nbsp;<button class='btn btn-danger'>ค้นหา</button>
                <?= Html::endForm(); ?>
            </div>
        </div>
    </div>
</div>
<?
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">ค้นหาข้อมูลประชากร โรงพยาบาลม่วงสามสิบ</b>',
            'after'=>'<b style="color:red">ประมวลผล </b>'.date('Y-m-d H:i:s') ,
            ]]
        )

        ?>
     
