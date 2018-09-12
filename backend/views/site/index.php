<?php

/* @var $this yii\web\View */

$this->title = 'M30hospital(045489064)';
?>
<div class="site-index">

    
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
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

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
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

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        
                        <p><a href="http://localhost/yii2a-devices/backend/web/index.php?r=opdcard%2Fpermits"><h1><b>ยืมเวชระเบียน</a></b></h1></p>
                        <p>แบ่งสิทธิ์ผู้ใช้3ระดับ 1.admin 2.employee 3.user [บันทึกเวลายืมอัตโนมัติ] </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div><!-- ./col -->


             <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        </h3>
                        <p>FCT(FamilyCareTeam)</p>

                        <p> พัฒนาบนระบบ Android แบ่งข้อมูล3ประเภท 1.ประชาชน 2.เจ้าหน้าที่ผู้ใช้งาน 3.ผู้บริหาร</p>
                    </div>

                    <div class="icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                       <p><a class="btn btn-warning" href="http://m30.phoubon.in.th"><b style ="color:blue">FCT(Muangsamsib)>></a></b></p>
                    </a>
                </div>
            </div><!-- ./col -->

            

            <div class="col-lg-3">
            <!-- small box -->
                <div class="small-box warning">
                
                <p><a class="btn btn-lg btn-danger">FCT(FamilyCareTeam)</a></p>

                <p>โปรแกรมหมอครอบครัว(fct) ที่พัฒนาบนระบบ Androidเป็นหลัก แบ่งข้อมูล3ประเภท 1.ประชาชน 2.เจ้าหน้าที่ผู้ใช้งาน 3.ผู้บริหาร 
                    ซึ่งพัฒนาแปรแกรมระหว่างทีมสารสนเทศโรงพยาบาลกับทางสาธารณสุขอำเภอม่วงสามสิบ
                </p>

                <p><a class="btn btn-default" href="http://m30.phoubon.in.th"><b style ="color:blue">FCT(Muangsamsib)>></a></b></p>
            </div>
            </div>

            <div class="col-lg-3">
                <p><a class="btn btn-lg btn-warning">Devices(Yii2)</a></p>
                
                <p>
                    โปรแกรมจัดการครุภัณฑ์คอมพิวเตอร์ โรงพยาบาลม่วงสามสิบ สามารถบริหารจัดการอุปกรณ์คอมพิวเตอร์อย่างเป็นระบบ ทั้งรับใหม่ จำหน่าย ส่งซ่อมภายนอก
                </p>

                <p><a class="btn btn-default" href="http://192.168.200.2/yii2a-devices/backend/"><b style ="color:blue">Devices>></a></p>
            </div>
        </div>
        </div>

    </div>
</div>            </div><!-- ./col -->
                
