<?php
/**
 * The Aria of the Maple Leaves.
 * 
 * @package Aria
 * @author Siphils
 * @version 1.3 
 * @link https://siphils.com/typecho-theme-Aria
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div id="main" class="col-mb-12 col-8 col-offset-2" >
	<?php while($this->next()): ?>
            <article itemscope itemtype="http://schema.org/BlogPosting" class="card">
                <div class="card-title">
                    <a href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a>
                </div>
                <div class="card-meta-top">
                    <span class="card-meta-cate"><i class="iconfont">&#xe61d;</i> <?php $this->category(' ',true,'无'); ?></span><span class="card-meta-date"><i class="iconfont">&#xe74f;</i> <?php $this->date('F jS, Y'); ?></span>
                </div>
                <a class="card-thumbnail" href="<?php $this->permalink(); ?>" style="background: url(
                    <?php if(!empty($this->fields->thumbnail))
                            $this->fields->thumbnail();
                        else
                            echo getThumbnail();
                        ?>) center center no-repeat;background-size: 100% auto;">
                </a>
                <div class="card-body">
                    <?php 
                        if(!empty($this->fields->previewContent))
                            $this->fields->previewContent();
                        else
                            $this->excerpt(50, '...');
                    ?>
                </div>
                <ul class="card-meta-bottom">
                    <li class="card-meta-label card-meta-more">
                        <a href="<?php $this->permalink(); ?>"><i class="iconfont">&#xe625;&#xe625;</i></a>
                    </li>
                    <li class="card-meta-label card-meta-views card-meta-right">
                        <i class="iconfont">&#xe619;</i> <?php getPostView($this); ?>
                    </li>
                    <li class="card-meta-label card-meta-comments card-meta-right">
                        <i class="iconfont">&#xe6f3;</i> <?php $this->commentsNum('%d'); ?>
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
