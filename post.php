<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2">
    <article class="post" itemscope itemtype="https://schema.org/BlogPosting">
        <div class="post-header">
            <h3 class="post-title"><a href="<?php $this->permalink() ?>" class="post-link"><?php $this->title() ?></a></h3>
            <div class="post-meta">
                <span class="post-meta-label post-meta-views"><?php Contents::getPostView($this); ?>次阅读</span>
                <span class="post-meta-label post-meta-cate"><?php $this->category(' • '); ?></span>
                <span class="post-meta-label post-meta-date"><?php $this->date(); ?></span>
            </div> 
        </div>
        <div class="post-body">
            <div class="post-content">
                <?php $this->content(); ?>
            </div>
            <?php Contents::getPostOther($this); ?>
            <div class="post-update"><i class="iconfont icon-aria-date"></i>&nbsp;最后一次更新于<?php echo date($this->options->postDateFormat,$this->modified) ?></div>
        </div>
        <div class="post-tags">
            <?php $this->tags(' ', true, '<a>None</a>'); ?>
            <a class="post-zan"><i class="iconfont icon-aria-like"></i></a>
            <?php //Typecho_Widget::widget('Zan_Action')->showZan($this->cid); ?>
        </div>
        <div class="post-footer nextprev">
            <?php Contents::theNextPrev($this); ?>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->
<?php if($this->fields->showTOC) $this->need('TOC.php'); ?>
<?php $this->need('footer.php'); ?>
