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
    <style>.link-box{display:table;margin:20px 0;width:100%;box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box}.link-box a{display:inline-block;border:none!important;width:calc((100% - 80px) / 4);margin:10px 10px}.link-item{width:100%;background-color:rgba(119,183,234,0.1);border:1.3px solid #ededed;border-radius:10px;max-height:300px;display:inline-block;box-shadow:0px 0px 2px 0 rgba(172,172,172,.4);user-select:none;box-sizing:border-box
    -webkit-transition:all .5s ease;transition:all .5s ease}.link-item:hover{transform:translateY(-8px);animation:linkitem .4s;-webkit-animation:linkitem .4s;animation-fill-mode:forwards;-webkit-animation-fill-mode:forwards}.link-avatar{width:100%;height:100%;padding:0;border-radius:10px;display:block}.link-name{text-align:center;display:block;font-size:1rem;margin-bottom:10px;overflow:hidden;text-overflow:ellipsis;word-break:keep-all;white-space:nowrap;font-family:Comic Sans MS,Consolas,Microsoft YaHei}@media (max-width:1250px){.link-item{border-radius:10px}.link-avatar{border-radius:10px}}@media (max-width:450px){.link-box a{width:calc((100% - 80px) / 3)}}@keyframes linkitem{0%{box-shadow:0px 0px 15px 0 rgba(172,172,172,1)}100%{box-shadow:0px 0px 15px 2px rgba(172,172,172,1)}}@-webkit-keyframes linkitem{0%{box-shadow:0px 0px 15px 0 rgba(172,172,172,1)}100%{box-shadow:0px 0px 15px 2px rgba(172,172,172,1)}}</style>
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
