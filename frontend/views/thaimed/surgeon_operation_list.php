<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;


$this->title ="Surgeon-LIST";
//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/referin']];
//$this->params['breadcrumbs'][] = 'รายงานผู้ปวยส่งต่อเข้ามา';
?>
<div class="surgrn-thaimed">
    
    <?php Modal::begin([
        'id' => 'modal',
        'header' => '<h4><a color-blue>CREATE xxx</a></h4>',
        'size'=>'modal-lg',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
        ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'panel' => [
            'before'=>'<b style="color:blue ">ผู้ทำหัตถการแพทย์แผนไทย</b>(<b style="color: red">แยกตามProver</b>)',
            'after'=>'<b style="color:red">ประมวลผล </b>'.date('Y-m-d H:i:s')
            ]]
        )
        ?>
    <?php Pjax::end() ?>
</div>
