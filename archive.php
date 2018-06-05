<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2 index-main" >
    <div style="    border-radius: 5px;
    background-color: #f1f1f18a;
    margin-bottom: 30px;
    color: rgba(0,0,0,.7);
    padding: 15px;">
    <?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?><br><?php echo $this->getDescription(); ?>
    </div>
    <?php while($this->next()): ?>
            <article itemscope itemtype="http://schema.org/BlogPosting" class="evenflow">
                <header class="card-header evenflow_scale" style="background: url(<?php if(!empty($this->fields->thumbnail))
                            $this->fields->thumbnail();
                        else
                            $this->options->themeUrl("img/thumbnail.jpg");
                        ?>) center center no-repeat;background-size: 100% auto;">
                    <!--div class="card-preview">
                        <?php if(!empty($this->fields->thumbnail)): ?>
                            <img src="<?php $this->fields->thumbnail(); ?>" alt="Preview img">
                        <?php else: ?>
                            <img src="<?php $this->options->themeUrl("img/thumbnail.jpg"); ?>" alt="Preview img">
                        <?php endif; ?>
                    </div-->
                    <h3 class="card-title"><a href="<?php $this->permalink() ?>" class="card-link"><?php $this->title() ?></a></h3>
                    <div class="card-meta">
                    <!--a href="#popup-article" class="card-link card-readmore" title="read more"><i class="iconfont">&#xe625;&#xe625;</i></a-->
                            <span class="card-meta-label card-meta-comments"><i class="iconfont">&#xe6f3;</i> <a href="<?php $this->permalink(); ?>" title="comments"><i class="webfont"><?php $this->commentsNum('%d'); ?></i></a></span>
                            <span class="card-meta-label card-meta-views"><i class="iconfont">&#xe619;</i> <i class="webfont"><?php getPostView($this); ?></i></span>
                            <span class="card-meta-label card-meta-cate"><i class="iconfont">&#xe609;</i> <i class="webfont"><?php $this->category(' '); ?></i></span>
                            <span class="card-meta-label card-meta-date"><i class="iconfont">&#xe65f;</i> <i class="webfont"><?php $this->date('F jS, Y'); ?></i></span>
                    </div>   
                </header>
                <div class="card-body">
                    <div class="card-content">
                    <p>
                        <i class="webfont">
                            <?php if(!empty($this->fields->previewContent)): ?><!-- 设置文章预览内容 -->
                                <?php $this->fields->previewContent(); ?>
                            <?php else: ?>
                                <?php $this->excerpt(40,' ... '); ?>
                            <?php endif; ?>
                        </i>
                    </p>
                </div>
                <footer class="card-footer">
                    
                </footer>
            </div>
            </article>
    <?php endwhile; ?>

     <div id="page-nav">
        <?php $this->pageNav('<', '>',1,'...',array('wrapTag' => 'ul', 'wrapClass' => '','itemTag' => 'li','currentClass' => 'page-current',)); ?>  
     </div>
</div><!-- end #main-->

	
	<?php $this->need('footer.php'); ?>
