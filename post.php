<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2 index-main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="post-header">
                    <h3 class="post-title"><a href="<?php $this->permalink() ?>" class="post-link"><?php $this->title() ?></a></h3>
                    <div class="post-meta">
                        <span class="post-meta-label post-meta-views"><i class="webfont"><?php getPostView($this); ?>次阅读</i></span>
                        <span class="post-meta-label post-meta-cate"><i class="webfont"><?php $this->category(' '); ?></i></span>
                        <span class="post-meta-label post-meta-date"><i class="webfont"><?php $this->date('F jS, Y'); ?></i></span>
                    </div> 
                </div>
                <div class="post-body">
                    <div class="post-content">
                            <?php $this->content(); ?>
                    </div>
                </div>
                <div class="post-tags">
                    <?php $this->tags(' ', true, '<a>No tags</a>'); ?>
                    <span class="iconfont">&#xe671;</span>
                </div>
                <div class="post-footer">
                    <span class="post-prev webfont">
                        <?php $this->thePrev('%s','没有了~'); ?></span>
                    <hr style="width: 50%;color:opacity: .4;">
                    <span class="post-next webfont">
                        <?php $this->theNext('%s','没有了~'); ?></span>
                </div>
            </article>
    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->

<?php $this->need('footer.php'); ?>
