<?php
/**
 * The Aria of the Maple Leaves.
 * 
 * @package Aria
 * @author Siphils
 * @version 1.0 Beta
 * @link https://siphils.com/typecho-theme-Aria
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div id="main" class="col-mb-12 col-8 col-offset-2 index-main" >
	<?php while($this->next()): ?>
            <article itemscope itemtype="http://schema.org/BlogPosting" class="evenflow">
    			<header class="card-header evenflow_scale" style="background: url(
                    <?php if(!empty($this->fields->thumbnail))
                            $this->fields->thumbnail();
                        else
                            echo getThumbnail();
                        ?>) center center no-repeat;background-size: 100% auto;">
                    <h3 class="card-title"><a href="<?php $this->permalink() ?>" class="card-link"><?php $this->title() ?></a></h3>
                    <div class="card-meta">
                        <span class="card-meta-label card-meta-comments"><i class="iconfont">&#xe6f3;</i> <a href="<?php $this->permalink(); ?>" title="comments"><i class="webfont"><?php $this->commentsNum('%d'); ?></i></a></span>
                        <span class="card-meta-label card-meta-views"><i class="iconfont">&#xe619;</i> <i class="webfont"><?php getPostView($this); ?></i></span>
                        <span class="card-meta-label card-meta-cate"><i class="iconfont">&#xe609;</i> <i class="webfont"><?php $this->category(' '); ?></i></span>
                        <span class="card-meta-label card-meta-date"><i class="iconfont">&#xe65f;</i> <i class="webfont"><?php $this->date('F jS, Y'); ?></i></span>
                    </div>   
                </header>
            </article>
	<?php endwhile; ?>

     <div id="page-nav">
        <?php $this->pageNav('<', '>',1,'...',array('wrapTag' => 'ul', 'wrapClass' => '','itemTag' => 'li','currentClass' => 'page-current',)); ?>  
     </div>
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>
