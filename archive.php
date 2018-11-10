<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" class="col-mb-12 col-8 col-offset-2" >
    <div style="border-radius: 5px;
    background-color: #fff;
    margin: 30px 0;
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
            <article itemscope itemtype="http://schema.org/BlogPosting" class="card">
                <div class="card-title">
                    <a href="<?php $this->permalink(); ?>"><?php $this->sticky();$this->title(); ?></a>
                </div>
                <div class="card-meta-top">
                    <span class="card-meta-cate"><i class="iconfont icon-aria-category"></i> <?php $this->category(' ',true,'无'); ?></span><span class="card-meta-date"><i class="iconfont icon-aria-date"></i> <?php $this->date('F jS, Y'); ?></span>
                </div>
                <a class="card-thumbnail" href="<?php $this->permalink(); ?>" style="background: url(
                    <?php if($this->fields->thumbnail)
                            $this->fields->thumbnail();
                        else
                            echo getThumbnail();
                        ?>) center center no-repeat;background-size: 100% auto;">
                </a>
                <div class="card-body">
                    <?php 
                        if($this->fields->previewContent)
                            $this->fields->previewContent();
                        else
                            $this->excerpt(50, '...');
                    ?>
                </div>
                <ul class="card-meta-bottom">
                    <li class="card-meta-label card-meta-more">
                        <a href="<?php $this->permalink(); ?>" target="_blank"><i class="iconfont icon-aria-more"></i><i class="iconfont icon-aria-more"></i></a>
                    </li>
                    <li class="card-meta-label card-meta-views card-meta-right">
                        <i class="iconfont icon-aria-view"></i> <?php getPostView($this); ?>
                    </li>
                    <li class="card-meta-label card-meta-comments card-meta-right">
                        <i class="iconfont icon-aria-comment"></i> <?php $this->commentsNum('%d'); ?>
                    </li>
                    <!--li class="card-meta-label card-meta-likes"></li-->
                </ul>
            </article>
    <?php endwhile; ?>

     <div id="page-nav">
        <?php $this->pageNav('<', '>',1,'...',array('wrapTag' => 'ul', 'wrapClass' => '','itemTag' => 'li','currentClass' => 'page-current',)); ?>  
     </div>
</div><!-- end #main-->

	
	<?php $this->need('footer.php'); ?>
