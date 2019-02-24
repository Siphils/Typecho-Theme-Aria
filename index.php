<?php
/**
 * 书写属于自己的篇章
 * 
 * <a href="https://github.com/Siphils/Typecho-Theme-Aria" target="_blank">Github</a> | <a href="https://eriri.ink" target="_blank">Home</a>
 * 
 * @package Aria
 * @author Siphils
 * @version 1.9.0
 * @link https://eriri.ink/archives/Typecho-Theme-Aria.html
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div id="main" class="col-mb-12 col-8 col-offset-2" >
	<?php while($this->next()): ?>
            <article itemscope itemtype="http://schema.org/BlogPosting" class="card animated wow fadeIn" data-wow-duration="1s" data-wow-offset="10">
                <div class="card-title">
                    <a href="<?php $this->permalink(); ?>"><?php $this->sticky();$this->title(); ?></a>
                </div>
                <div class="card-meta-top">
                    <span class="card-meta-cate"><i class="iconfont icon-aria-category"></i> <?php $this->category(' • ',true,'无'); ?></span><span class="card-meta-date"><i class="iconfont icon-aria-date"></i> <?php $this->date(); ?></span>
                </div>
                <a href="<?php $this->permalink(); ?>">
                    <?php if(Utils::isEnabled('enableLazyload','AriaConfig')): ?>
                    <div class="card-thumbnail lazyload" data-original=<?php if($this->fields->thumbnail)
                                $this->fields->thumbnail();
                            else
                                echo Utils::getThumbnail();
                        ?> style="background:url(<?php $this->options->themeUrl('assets/img/loading.svg') ?>) center center no-repeat;background-size: 100% auto;">
                    </div>
                    <?php else: ?>
                    <div class="card-thumbnail" style="background:url(<?php if($this->fields->thumbnail)
                                $this->fields->thumbnail();
                            else
                                echo Utils::getThumbnail();
                        ?>) center center no-repeat;background-size: 100% auto;">
                    </div>
                    <?php endif; ?>
                </a>
                <div class="card-body"><?php 
                        if($this->fields->previewContent)
                            $this->fields->previewContent();
                        else
                            $this->excerpt(50, '...');
                    ?></div>
                <div class="card-line"></div>
                <ul class="card-meta-bottom">
                    <li class="card-meta-label card-meta-more"><a href="<?php $this->permalink(); ?>" title="Read More" target="_blank"><i class="iconfont icon-aria-more"></i><i class="iconfont icon-aria-more"></i></a></li>
                    <li class="card-meta-label card-meta-views card-meta-right"><i class="iconfont icon-aria-view"></i> <?php Contents::getPostView($this); ?></li>
                    <li class="card-meta-label card-meta-comments card-meta-right"><i class="iconfont icon-aria-comment"></i> <?php $this->commentsNum('%d'); ?></li>
                    <!--li class="card-meta-label card-meta-likes"></li-->
                </ul>
            </article>
	<?php endwhile; ?>

     <div id="page-nav">
        <?php $this->pageNav('<', '>',1,'...',array('wrapTag' => 'ul', 'wrapClass' => '','itemTag' => 'li','currentClass' => 'page-current',)); ?>  
     </div>
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>
