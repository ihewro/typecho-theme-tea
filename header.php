<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- Alchemy v1.1.7 -->
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' /><![endif]-->
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="<?php $this->options->themeUrl('assets/css/style.css') ?>" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" async="" src="<?php $this->options->themeUrl('assets/js/trekkie.storefront.min.js') ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/shopify_stats.js') ?>" type="text/javascript" async="async"></script>
    <script async="" src="<?php $this->options->themeUrl('assets/js/shop_events_listener.js') ?>"></script>


    <script src="<?php $this->options->themeUrl('assets/js/option_selection.js') ?>" type="text/javascript"></script>
    <script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php $this->options->themeUrl('assets/js/api-jquery.js') ?>" type="text/javascript"></script>
</head>

<!--#body开始-->
<body id="red-circle-tea" class="template-index header-has-bg">
<div id="mobile-nav">
    <button class="textbutton mobile-nav-toggle">Menu<span></span><span></span><span></span></button>
</div>
<header id="pageheader">
    <div class="head-img-cont fillmode-cover" style="overflow: hidden;">
        <img class="background loaded" src="<?php $this->options->themeUrl('img/head_img_home.jpg') ?>" alt="Red Circle Tea" style="opacity: 1;" />
        <div class="background-shadow main" style="opacity: 1;"></div>
        <div class="background-shadow content-top" style="opacity: 1;">
            <div class="container"></div>
        </div>
    </div>
    <div class="container">
        <div class="links-etc">
            <button class="textbutton mobile-nav-toggle">Close</button>
            <div class="social-icons size-">
                <a title="Twitter" class="email" target="_blank" href="emalito:37540116@qq.com">emali</a>
                <a title="Facebook" class="rss" target="_blank" href="<?php $this->options->feedUrl(); ?>">Rss</a>
                <span class="div">|</span>
                <a title="Search" class="search " href="/search">搜索</a>
            </div>
            <!-- .social -->
            <span class="upper-link customer-links">
                <a target="_blank" href="<?php $this->options->rootUrl(); ?>/admin/login.php" id="customer_login_link">登录</a>
                <a target="_blank" href="<?php $this->options->rootUrl(); ?>/admin/register.php" id="customer_register_link">注册</a>              </span>
            <nav role="navigation" class="nav">
                <ul data-menu-handle="main-menu">
                    <li class="active"> <a href="<?php $this->options->rootUrl(); ?>"><span>首页</span></a> </li>
                    <li> <a href="<?php $this->options->rootUrl(); ?>/index.php/category/reservation/"><span>活动预约</span></a> </li>
                    <li> <a href="<?php $this->options->rootUrl(); ?>/index.php/blog"><span>博客</span></a> </li>
                    <li> <a href="<?php $this->options->rootUrl(); ?>/about.html"><span>关于我们</span></a> </li>
                </ul>
            </nav>
        </div>
        <div class="logo">
            <a id="logo" href="<?php $this->options->rootUrl(); ?>" class="image "> <img class="" src="<?php $this->options->themeUrl('img/logo_on_header.png') ?>" /> </a>
            <h1 id="site-title" class="text hidden"> <a href="/">Red Circle Tea</a> </h1>
        </div>
    </div>
</header>
<div class="container">
