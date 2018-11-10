<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <div id="toc-container"><div id="toc"></div></div>
        <?php if($this->user->hasLogin()): ?>
        <?php endif; ?>
        <div class="post-header">
            <h3 class="post-title"><a href="<?php $this->permalink() ?>" class="post-link"><?php $this->title() ?></a></h3>
            <div class="post-meta">
                <span class="post-meta-label post-meta-views"><?php getPostView($this); ?>次阅读</span>
                <span class="post-meta-label post-meta-cate"><?php $this->category(' '); ?></span>
                <span class="post-meta-label post-meta-date"><?php $this->date('F jS, Y'); ?></span>
            </div> 
        </div>
        <div class="post-body">
            <div class="post-content">
                <?php $this->content(); ?>
            </div>
            <?php postOther($this); ?>
            <div class="post-update"><i class="iconfont icon-aria-date"></i>&nbsp;最后一次更新于<?php echo date("F jS, Y",$this->modified) ?></div>
        </div>
        <div class="post-tags">
            <?php $this->tags(' ', true, '<a>None</a>'); ?>
            <a class="post-zan"><i class="iconfont icon-aria-like"></i></a>
            <?php //Typecho_Widget::widget('Zan_Action')->showZan($this->cid); ?>
        </div>
        <div class="post-footer nextprev">
            <?php theNextPrev($this); ?>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->
<style>
</style>
<?php $this->need('footer.php'); ?>
