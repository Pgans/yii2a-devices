<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use \miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use kartik\grid\GridView;
use kartik\export\ExportMenu;



/* @var $this yii\web\View */

$this->title = 'M30hospital(045489064)';
?>
<div class='well'>
    <h3><a style="color:blue">ขั้นตอนการเข้าใช้งาน</a></h3>
    <p><a style="color:success">Username=  เลข13หลักบัตรประจำจัวประชาชน เช่น  3341400051222</a></p> 
    <p><a style="color:success">Password = 6หลักสุดท้ายเลขบัตรประจำตัวประชาชน เช่น 051222</a></p> 
    <p><a style="color:red">***สิทธิ์การใช้งานโปรแกรมยืมเวชระเบียนเฉพาะ ตำแหน่งแพทย์หรือพยาบาล***  หากพบปัญหาการใช้งานกรุณาโทรแจ้ง ศูนย์คอมพิวเตอร์เบอร์ 508</a></p>
</div>

         
<div class="site-index">

    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>
                            <?php echo date("D d"); ?>
                        </h3>
                        <p>
                            <?php echo date("M H:i A"); ?>
                        </p>
                        <p> &nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Time Today <!--<i class="fa fa-arrow-circle-right"></i>-->
                    </a>
                </div>
                </div><!-- ./col -->

            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>
                            <?php
                            $bytes = disk_free_space(".");
                            $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
                            $base = 1024;
                            $class = min((int) log($bytes, $base), count($si_prefix) - 1);
                            //echo $bytes . '<br />';
                            echo sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . '<br />';
                            ?>
                        </h3>
                        <p>
                            of
                            <?php
                            $bytes = disk_total_space(".");
                            $si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
                            $base = 1024;
                            $class = min((int) log($bytes, $base), count($si_prefix) - 1);
                            //echo $bytes . '<br />';
                            echo sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . '<br />';
                            ?>
                        </p>
                        <p> &nbsp;</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-database"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Database Free Space By Pgans
                    </a>
                </div>
            </div><!-- ./col -->

             <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        </h3>
                        <p><b style="color:red">FCT(FamilyCareTeam)</b></p>

                        <p> พัฒนาบนระบบ Android แบ่งข้อมูล3ประเภท 1.ประชาชน 2.เจ้าหน้าที่ผู้ใช้งาน 3.ผู้บริหาร</p>

                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                       <p><a class="btn btn-default" href="http://m30.phoubon.in.th"><b style ="color:blue">FCT(Muangsamsib)>></a></b></p>
                    </a>
                </div>
            </div><!-- ./col -->

            </div>
    <div class="panel-body">
        <?php
        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'จำนวนผู้ป่วยอุบัติเหตุ'],
                'xAxis' => [
                    'categories' => $mm
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวน(คน)']
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'accidents',
                        'data' => $accidents,
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>
                            //     <?php
                            //     Pjax::begin();
                            //     echo Highcharts::widget([
                            //         'options' => [
                            //             'title' => ['text' => 'ปีงบประมาณ'],
                            //             'xAxis' => [
                            //                 'categories' => $oyear_budget
                            //             ],
                            //             'yAxis' => [
                            //                 'title' => ['text' => 'จำนวน (คน/ครั้ง) ']
                            //             ],
                            //             'series' => [
                            //                 ['type' => 'column',
                            //                     'name' => 'จำนวน (คน)',
                            //                     'data' => $ohuman,
                            //                 //'color' => '#F5C4B6',
                            //                 ],
                                           
                            //             ]
                            //         ]
                            //     ]);
                            //     Pjax::end();
                            //     ?>
                             



           