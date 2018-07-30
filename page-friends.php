<?php
/**
 * 友情链接
 * 
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div id="main" class="col-mb-12 col-8 col-offset-2">
    <style>
        .link-box{margin:20px 0}.link-box a{display:inline-block;border:none!important;width:21%;margin:10px 2%}.link-item{width:100%;background-color:rgba(119,183,234,0.1);border:1.3px solid #ededed;border-radius:20px;max-height:300px;display:inline-block;box-shadow:0px 0px 2px 0 rgba(172,172,172,.4);user-select:none;box-sizing:border-box;min-width:100px}.link-item:hover{animation:linkitem .5s;-webkit-animation:linkitem .5s;animation-fill-mode:forwards;-webkit-animation-fill-mode:forwards}.link-avatar{width:95%;height:95%;margin:2px auto;border-radius:20px;display:block}.link-name{text-align:center;display:block;font-size:1rem;margin-bottom:10px;overflow:hidden;text-overflow:ellipsis;word-break:keep-all;white-space:nowrap;font-family:Comic Sans MS,Consolas,Microsoft YaHei}@media (max-width:1250px){.link-item{border-radius:10px}.link-avatar{border-radius:10px}}@media (max-width:450px){.link-box a{width:46%}}@-webkit-keyframes linkitem{0%{box-shadow:0px 0px 20px 0 rgba(172,172,172,1)}100%{box-shadow:0px 0px 20px 3px rgba(172,172,172,1)}}
    </style>
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <div class="post-update"><i class="iconfont icon-aria-date"></i>&nbsp;最后一次更新于<?php echo date("F jS, Y",$this->modified) ?></div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->


<?php $this->need('footer.php'); ?>
