<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
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
                    <div class="post-update"><i class="iconfont">&#xe74f;</i>&nbsp;最后一次更新于<?php echo date("F jS, Y",$this->modified) ?></div>
                </div>

                <div class="post-tags">
                    <?php $this->tags(' ', true, '<a>None</a>'); ?>
                    <span class="iconfont">&#xe671;</span>
                </div>
                <?php $prev=thePrev($this);$next=theNext($this); ?>
                <div class="post-footer nextprev">
                    <div class="post-footer-box half previous"> 
                        <a href="<?php echo $prev['link']; ?>" rel="prev">
                            <div class="post-footer-thumbnail"> 
                                <img src="<?php echo $prev['img']; ?>">
                            </div>
                            <span class="post-footer-label">Previous Post</span>
                            <div class="post-footer-title">
                                <h3><?php echo $prev['title']; ?></h3>
                            </div>
                        </a>
                    </div>
                    <div class="post-footer-box half next"> 
                        <a href="<?php echo $next['link']; ?>" rel="next">
                            <div class="post-footer-thumbnail"> 
                                <img src="<?php echo $next['img']; ?>">
                            </div>
                            <span class="post-footer-label">Next Post</span>
                            <div class="post-footer-title">
                                <h3><?php echo $next['title']; ?></h3>
                            </div>
                        </a>
                    </div>
                </div>
            </article>
    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->

<?php $this->need('footer.php'); ?>
