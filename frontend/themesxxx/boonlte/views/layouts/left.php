<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'ข้อมูลบุคลกร', 'icon' => 'fa fa-file-code-o', 'url' => ['/personal/person']],
                    // ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Users',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'ManagUser', 'icon' => 'fa fa-file-code-o', 'url' => ['/users/user'],],
                            //['label' => 'เพิ่มการยืมเพื่อใช้', 'icon' => 'fa fa-file-code-o', 'url' => ['/opdcard/treatments'],],
                            // ['label' => 'สถาบัน', 'icon' => 'fa fa-file-code-o', 'url' => ['/study/university'],],
                          ],
                        ],
                    [
                        'label' => 'งานเวชระเบียน',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'ยืมคืนเวชระเบียน', 'icon' => 'fa fa-file-code-o', 'url' => ['/opdcard/permits'],],
                            ['label' => 'เพิ่มการยืมเพื่อใช้', 'icon' => 'fa fa-file-code-o', 'url' => ['/opdcard/treatments'],],
                            // ['label' => 'สถาบัน', 'icon' => 'fa fa-file-code-o', 'url' => ['/study/university'],],
                          ],
                        ],
                    [
                        'label' => 'หมวดนักศึกษาฝึกงาน',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'นักศึกษาฝึกงาน', 'icon' => 'fa fa-file-code-o', 'url' => ['/study/students'],],
                            ['label' => 'คณะวิชา', 'icon' => 'fa fa-file-code-o', 'url' => ['/study/faculty'],],
                            ['label' => 'สถาบัน', 'icon' => 'fa fa-file-code-o', 'url' => ['/study/university'],],
                          ],
                        ],
                    [
                        'label' => 'หมวดครุภัณฑ์คอมพิวเตอร์',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'อุปกรณ์คอมพิวเตอร์', 'icon' => 'fa fa-file-code-o', 'url' => ['/equipments/devices'],],
                            ['label' => 'แผนก', 'icon' => 'fa fa-file-code-o', 'url' => ['/equipments/departments'],],
                            ['label' => 'ประเภท', 'icon' => 'fa fa-file-code-o', 'url' => ['/equipments/categories'],],
                            ['label' => 'ส่งซ่อมภายนอก', 'icon' => 'fa fa-file-code-o', 'url' => ['/equipments/serviceout'],],
                            ['label' => 'ร้านค้า', 'icon' => 'fa fa-file-code-o', 'url' => ['/equipments/store'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                            
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
