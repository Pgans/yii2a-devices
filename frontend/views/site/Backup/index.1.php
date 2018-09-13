<?php

/* @var $this yii\web\View */

$this->title = 'm30hospital';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><a style="color: blue">โรงพยาบาลม่วงสามสิบ</a></h1>

        <p><a class="btn btn-lg btn-blue">ทีมสารสนเทศร่วมผลิตรายงานที่เกี่ยวข้องกับทุกฝ่าย เพื่อสะท้อนกลับข้อมูล</a></p>
       
       <p><a class="btn btn-lg btn-primary" href="http://192.168.200.2/yii2a-devices/frontend/web/index.php?r=site%2Flogin">เข้าสู่ระบบการทำงาน</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <p><a class="btn btn-lg btn-warning">43แฟ้ม(HDC)</a></p>

                <p>
                รายงานการส่ง43 แฟ้มในระบบ UbonSystem ดึงข้อมูลทุกวัน สามารถเข้าตรวจสอบข้อมูลได้ที่ http://ubn.hdc.moph.go.th/hdc/main/index_pk.php
                
                </p>

                <p><a class="btn btn-default" href="http://ubn.hdc.moph.go.th/hdc/main/index_pk.php"><b style ="color:blue">HDC-PHOUBON>></b></a></p>
            </div>
            <div class="col-lg-4">
                <p><a class="btn btn-lg btn-danger">FCT(FamilyCareTeam)</a></p>

                <p>โปรแกรมหมอครอบครัว(fct) ที่พัฒนาบนระบบ Androidเป็นหลัก แบ่งข้อมูล3ประเภท 1.ประชาชน 2.เจ้าหน้าที่ผู้ใช้งาน 3.ผู้บริหาร 
                    ซึ่งพัฒนาแปรแกรมระหว่างทีมสารสนเทศโรงพยาบาลกับทางสาธารณสุขอำเภอม่วงสามสิบ
                </p>

                <p><a class="btn btn-default" href="http://m30.phoubon.in.th"><b style ="color:blue">FCT(Muangsamsib)>></a></b></p>
            </div>

            <div class="col-lg-4">
                <p><a class="btn btn-lg btn-success">Devices(Yii2)</a></p>
                
                <p>
                    โปรแกรมจัดการครุภัณฑ์คอมพิวเตอร์ โรงพยาบาลม่วงสามสิบ สามารถบริหารจัดการอุปกรณ์คอมพิวเตอร์อย่างเป็นระบบ ทั้งรับใหม่ จำหน่าย ส่งซ่อมภายนอก
                </p>

                <p><a class="btn btn-default" href="http://192.168.200.2/yii2a-devices/backend/"><b style ="color:blue">Devices>></a></p>
            </div>
        </div>

    </div>
</div>
