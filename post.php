<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2">
    <style>.in-page-preview-buttons-full-reader{right:50px;top:-15px;border-radius:50%;width:48px;height:48px;background:rgba(255,255,255,0.2);box-shadow:0 1px 8px 1.5px rgba(0,0,0,0.35),0 20px 70px 8px rgba(0,0,0,0.25)}.in-page-editor-buttons,.in-page-preview-buttons{margin-top:100px;position:fixed;z-index:10}.in-page-button{width:20px;height:20px;display:inline-block;list-style:none;cursor:pointer;font-size:17px}.in-page-button>svg{width:25px;height:25px;display:inline-block;padding-left:12px;padding-top:12px}.icon-list:before{display:inline-block;text-decoration:inherit}.in-page-preview-buttons ul{color:#2c3e50;padding-left:0}#tree_nav{margin:10px;cursor:pointer}#tree_nav:hover{fill:#666}#toc-list{background-clip:padding-box;border-radius:4px;float:left;font-size:14px;list-style:none outside none;margin:2px 0 0;min-width:160px;position:absolute;padding:5px 0 20px;top:100%;z-index:1000;box-shadow:0 1px 8px 1.5px rgba(0,0,0,0.35),0 20px 70px 8px rgba(0,0,0,0.25)}#toc-list .toc ul{margin-left:20px;padding-left:0}#toc-list .toc>ul{margin:0}#toc-list a:hover{background:0;color:#005580;text-decoration:underline}#toc-list a{color:#08c;text-decoration:none;display:inline}#toc-list h3{margin:10px 0;padding-left:15px}#toc-list hr{margin:10px 0}.dropdown-menu{display:none}.dropdown-menu.pull-right{left:auto;right:0}.theme-white{background-color:#f9f9f5;color:#2c3e50}.pull-right{float:right}.table-of-contents{overflow-x:hidden;overflow-y:auto;width:330px;max-height:400px;padding:5px 0}.toc ul{list-style-type:none}.open>.dropdown-menu{display:block}@media(max-width:550px){.in-page-preview-buttons-full-reader{right:30px;top:-15px;border-radius:50%;width:38px;height:38px}#toc-list{max-width:270px}}</style>
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <?php if($this->user->hasLogin()): ?>
        <!--span><a href="<?php echo __TYPECHO_ADMIN_DIR__.'write-post.php?cid='.$this->cid; ?>">编辑</a></span-->
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

<?php $this->need('footer.php'); ?>
