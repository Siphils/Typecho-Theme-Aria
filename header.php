<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">

<head>
	<meta charset="<?php $this->options->charset(); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>
		<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?>
		<?php $this->options->title(); ?>-
		<?php $this->options->description(); ?>
	</title>

	<!-- 使用url函数转换相关路径 -->

	<link href="<?php $this->options->themeUrl('assets/css/nprogress.min.css'); ?>" rel="stylesheet">
	<link href="<?php $this->options->themeUrl('assets/css/jquery.fancybox.min.css'); ?>" rel="stylesheet">
	<link href="<?php $this->options->themeUrl('assets/css/normalize.min.css'); ?>" rel="stylesheet">
	<link href="<?php $this->options->themeUrl('assets/OwO/OwO.min.css'); ?>" rel="stylesheet">
	<link href="<?php $this->options->themeUrl('assets/css/animate.min.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('assets/css/tomorrow-night-eighties.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" href="//at.alicdn.com/t/font_671129_lud8yy9waro.css">
	<link href="<?php $this->options->themeUrl('assets/css/style.min.css'); ?>" rel="stylesheet">
	<!--[if lt IE 9]>
    <script src="http://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="http://cdn.staticfile.org/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<!-- 通过自有函数输出HTML头部信息 -->
	<?php $this->header("generator=&commentReply="); ?>
    <script src="<?php $this->options->themeUrl('assets/OwO/OwO.min.js') ?>"></script>
</head>
<body>
<div id="nav-vertical">
    <span class="close"><i class="iconfont icon-aria-close"></i></span>
    <div id="nav-avatar"><img src="<?php if($this->options->avatarUrl) $this->options->avatarUrl();else $this->options->themeUrl('assets/img/avatar.jpg'); ?>"></div>
	<a href="<?php $this->options->siteUrl(); ?>">
		<i class="iconfont icon-aria-home"></i>首页</a>
	<?php showNav(0); ?>
	</div>
	<div id="wrapper">
		<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
	<![endif]-->
<div id="nav-menu" role="navigation">
    <div id="nav-left">
        <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    </div>
    <div id="nav-right">
        <ul class="nav-right-list">
            <li class="nav-right-item">
                <a href="<?php $this->options->siteUrl(); ?>"><i class="iconfont icon-aria-home"></i>首页</a>
            </li>
            <?php showNav(1); ?>
        </ul>
    <div id="nav-btns">
        <i class="iconfont icon-aria-menu" id="nav-menu-btn"></i>
        <i class="iconfont icon-aria-search" id="nav-search-btn"></i>
    </div>
    </div>
</div>
<div id="search-box" style="background: #fff url(<?php $this->options->themeUrl('assets/img/search-bg.png') ?>) bottom left no-repeat;">
    <span class="close"><i class="iconfont icon-aria-close"></i></span>
    <form id="search" method="post" action="./" role="search">
        <input type="text" name="s" id="search-text" placeholder="想要看什么？" />
        <button type="submit" id="search-button" style="background: url(<?php $this->options->themeUrl('assets/img/search.png') ?>) center center no-repeat;background-size: cover;"></button>
    </form>
</div>
<div id="pjax-container">
<style><?php if($this->is('post') || $this->is('page') || $this->is('single') || http_response_code()===404 ):; ?>#header {height: 70vh;}#site-meta {display: none;}<?php endif; ?>#background {width: 100%;height: 100%;background: url(<?php 
                    if($this->is('post') || $this->is('page') || $this->is('single'))                         
                        if($this->fields->thumbnail)
                            $this->fields->thumbnail(); 
                        else
                            echo getThumbnail();
                    else if(http_response_code()===404)
                        $this->options->themeUrl('assets/img/404.jpg');
                    else
                        getBackground();
                ?>) center center no-repeat;background-size: cover;z-index: -1;position: relative;}</style>
<header id="header" class="clearfix animated fadeInDown">
    <div id="site-meta">
        <div id="site-avatar">
            <?php if($this->options->avatarUrl): ?>
                <img src="<?php $this->options->avatarUrl(); ?>">
            <?php else: ?>
                <img src="<?php $this->options->themeUrl('assets/img/avatar.jpg'); ?>">
            <?php endif; ?>
        </div>
        <div id="site-name">
            <a href="<?php $this->options->siteUrl(); ?>">
                <h1><?php $this->options->title(); ?></h1>
            </a>
        </div>
        <div id="site-description">
            <?php $this->options->description(); ?>
        </div>
    </div>
            <div id="background"></div>
</header><!-- end #header -->
<div id="body" class="animated fadeIn">
    <div class="container">
        <div class="row">