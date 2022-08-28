<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

$bundle = mortezakarimi\gentelellartl\assets\Asset::register($this);
\dashboard\assets\AppAsset::register($this);
$user = Yii::$app->user->identity;

?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" dir="rtl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
<!--        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
        <![endif]-->
    </head>
    <!-- /header content -->
    <body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>">
    <?php $this->beginBody(); ?>
    <style>

        footer {
            margin-right: 0 !important;
            height: 800px !important;
        }
        .main_container .top_nav
        {
            margin-right: 0 !important;
        }
    </style>
    <div class="container body">
        <div class="main_container">

            <div class="top_nav hidden-print">
                <div class="nav_menu">
                    <nav>


                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="/images/site/icons/avatar.webp" alt=""><?=$user->full_name?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <!--                                    <li><a href="javascript:;"> نمایه</a></li>-->
                                    <!--                                    <li>-->
                                    <!--                                        <a href="javascript:;">-->
                                    <!--                                            <span class="badge bg-red pull-right">50%</span>-->
                                    <!--                                            <span>تنظیمات</span>-->
                                    <!--                                        </a>-->
                                    <!--                                    </li>-->
                                    <!--                                    <li><a href="javascript:;">کمک</a></li>-->
                                    <li><?= Html::a(FA::i(FA::_SIGN_OUT)->pullRight() . 'خروج', ['site/logout'], ['data' => ['method' => 'post']]) ?></li>
                                </ul>
                            </li>

                            <!--                            notification -->
                            <!--                            <li role="presentation" class="dropdown">-->
                            <!--                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"-->
                            <!--                                   aria-expanded="false">-->
                            <!--                                    <i class="fa fa-envelope-o"></i>-->
                            <!--                                    <span class="badge bg-green">6</span>-->
                            <!--                                </a>-->
                            <!--                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">-->
                            <!--                                    <li>-->
                            <!--                                        <a>-->
                            <!--                                        <span class="image"><img src="http://placehold.it/128x128"-->
                            <!--                                                                 alt="Profile Image"/></span>-->
                            <!--                                            <span>-->
                            <!--                          <span>مرتضی کریمی</span>-->
                            <!--                          <span class="time">3 دقیقه پیش</span>-->
                            <!--                        </span>-->
                            <!--                                            <span class="message">-->
                            <!--                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....-->
                            <!--                        </span>-->
                            <!--                                        </a>-->
                            <!--                                    </li>-->
                            <!--                                    <li>-->
                            <!--                                        <a>-->
                            <!--                                        <span class="image"><img src="http://placehold.it/128x128"-->
                            <!--                                                                 alt="Profile Image"/></span>-->
                            <!--                                            <span>-->
                            <!--                          <span>مرتضی کریمی</span>-->
                            <!--                          <span class="time">3 دقیقه پیش</span>-->
                            <!--                        </span>-->
                            <!--                                            <span class="message">-->
                            <!--                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....-->
                            <!--                        </span>-->
                            <!--                                        </a>-->
                            <!--                                    </li>-->
                            <!--                                    <li>-->
                            <!--                                        <a>-->
                            <!--                                        <span class="image"><img src="http://placehold.it/128x128"-->
                            <!--                                                                 alt="Profile Image"/></span>-->
                            <!--                                            <span>-->
                            <!--                          <span>مرتضی کریمی</span>-->
                            <!--                          <span class="time">3 دقیقه پیش</span>-->
                            <!--                        </span>-->
                            <!--                                            <span class="message">-->
                            <!--                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....-->
                            <!--                        </span>-->
                            <!--                                        </a>-->
                            <!--                                    </li>-->
                            <!--                                    <li>-->
                            <!--                                        <a>-->
                            <!--                                        <span class="image"><img src="http://placehold.it/128x128"-->
                            <!--                                                                 alt="Profile Image"/></span>-->
                            <!--                                            <span>-->
                            <!--                          <span>مرتضی کریمی</span>-->
                            <!--                          <span class="time">3 دقیقه پیش</span>-->
                            <!--                        </span>-->
                            <!--                                            <span class="message">-->
                            <!--                          فیلمای فستیوال فیلمایی که اجرا شده یا راجع به لحظات مرده ایه که فیلمسازا میسازن. آنها جایی بودند که....-->
                            <!--                        </span>-->
                            <!--                                        </a>-->
                            <!--                                    </li>-->
                            <!--                                    <li>-->
                            <!--                                        <div class="text-center">-->
                            <!--                                            <a>-->
                            <!--                                                <strong>مشاهده تمام اعلان ها</strong>-->
                            <!--                                                <i class="fa fa-angle-right"></i>-->
                            <!--                                            </a>-->
                            <!--                                        </div>-->
                            <!--                                    </li>-->
                            <!--                                </ul>-->
                            <!--                            </li>-->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- /header content -->
            <div class="col-md-12" role="main">
                <?= $content ?>
            </div>
            <!-- footer content -->
            <footer class="hidden-print">
                <div class="pull-left">

                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content-->
        </div>
    </div>
    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <div id="lock_screen">
        <table>
            <tr>
                <td>
                    <div class="clock"></div>
                    <span class="unlock">
                    <span class="fa-stack fa-5x">
                      <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
                      <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                </span>
                </td>
            </tr>
        </table>
    </div>
    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>