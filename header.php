<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?> - <?php $this->options->description(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    
    <link href="https://cdn.bootcss.com/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/fancybox/3.3.5/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('css/normalize.min.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('OwO/OwO.min.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('css/prism.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('css/grid.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('css/style.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('css/responsive.css'); ?>" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="http://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="http://cdn.staticfile.org/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header("generator=&template=&commentReply="); ?>
    <div class="pjax-container">
        <script src="<?php $this->options->themeUrl('OwO/OwO.min.js') ?>"></script>
    <style>
        <?php if($this->is('post') || $this->is('page') || $this->is('single') || http_response_code()===404 ):; ?>
        #header {
            height: 70vh;
        }
        .filter:before {
            height: 70vh;
        }
        #site-meta {
            display: none;
        }
        <?php endif; ?>

        #background {
            width: 100%;
            height: 100%;
            background: url( 
                <?php 
                    if($this->is('post') || $this->is('page') || $this->is('single'))
                        if(!empty($this->fields->thumbnail))
                            $this->fields->thumbnail(); 
                        else
                            //$this->options->themeUrl('img/thumbnail.jpg');
                            echo getThumbnail();
                    else if(http_response_code()===404)
                        $this->options->themeUrl('img/404.jpg');
                    else
                        getBackground();
                ?>
                ) center center no-repeat;
            background-size: cover;
            z-index: -1;
            position: relative;
        } 
    </style>
    </div>
</head>
<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<div id="nav-menu" role="navigation" class="evenflow" >
    <div id="nav-left">
        <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
    </div>
    <div id="nav-right">
        <a href="<?php $this->options->siteUrl(); ?>"><i class="iconfont">&#xe69e;首页</i></a>
        <a href="<?php $this->options->siteUrl('archives.html'); ?>"><i class="iconfont">&#xe612;归档</i></a>
        <!--a href="<?php $this->options->siteUrl('books.html'); ?>"><i class="iconfont">&#xe615;书籍</i></a-->
        <!--a href="<?php $this->options->siteUrl('music.html'); ?>"><i class="iconfont">&#xe6a9;歌单</i></a-->
        <a href="<?php $this->options->siteUrl('guestbook.html'); ?>"><i class="iconfont">&#xe6ac;留言</i></a>
        <a href="<?php $this->options->siteUrl('friends.html'); ?>"><i class="iconfont">&#xe65e;朋友</i></a>
        <a href="<?php $this->options->siteUrl('about.html'); ?>"><i class="iconfont">&#xe648;关于</i></a>
    <div id="nav-btns">
        <i class="iconfont" id="nav-menu-btn">&#xe6ad;</i>
        <i class="iconfont" id="nav-search-btn">&#xe601;</i>
    </div>
    </div>
</div>
<div id="search-box">
    <span class="close"><i class="iconfont">&#xe604;</i></span>
    <form id="search" method="post" action="./" role="search">
        <input type="text" name="s" id="search-text" placeholder="想要看什么？" />
        <button type="submit" id="search-button"></button>
    </form>
</div>
<div id="nav-vertical">
    <span class="close"><i class="iconfont">&#xe604;</i></span>
    <div id="nav-avatar"><img src="<?php if($this->options->avatarUrl) $this->options->avatarUrl();else $this->options->themeUrl('img/avatar.jpg'); ?>"></div>
    <a href="<?php $this->options->siteUrl(); ?>"><i class="iconfont">&#xe69e;首页</i></a>
    <a href="<?php $this->options->siteUrl('archives.html'); ?>"><i class="iconfont">&#xe612;归档</i></a>
    <!--a href="<?php $this->options->siteUrl('books.html'); ?>"><i class="iconfont">&#xe615;书籍</i></a>
    <a href="<?php $this->options->siteUrl('music.html'); ?>"><i class="iconfont">&#xe6a9;歌单</i></a-->
    <a href="<?php $this->options->siteUrl('guestbook.html'); ?>"><i class="iconfont">&#xe6ac;留言</i></a>
    <a href="<?php $this->options->siteUrl('friends.html'); ?>"><i class="iconfont">&#xe65e;朋友</i></a>
    <a href="<?php $this->options->siteUrl('about.html'); ?>"><i class="iconfont">&#xe648;关于</i></a>
</div>

<header id="header" class="clearfix">
    <div id="site-meta">
        <div id="site-avatar">
            <?php if($this->options->avatarUrl): ?>
                <a href="<?php $this->options->siteUrl('about'); ?>"><img src="<?php $this->options->avatarUrl(); ?>"></a>
            <?php else: ?>
                <a href="<?php $this->options->siteUrl('about'); ?>"><img src="<?php $this->options->themeUrl('img/avatar.jpg'); ?>"></a>
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
    <div class="filter"></div>
    <div id="background"></div>
    

</header><!-- end #header -->
<div id="body">
    <div class="container">
        <div class="row">

    
    
