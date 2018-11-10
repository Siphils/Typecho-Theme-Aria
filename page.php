<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <div id="toc-container"><div id="toc"></div></div>
        <h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <div class="post-update"><i class="iconfont icon-aria-date"></i>&nbsp;最后一次更新于<?php echo date("F jS, Y",$this->modified) ?></div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->


<?php $this->need('footer.php'); ?>
