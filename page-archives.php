<?php
/**
 * 归档页面 时间轴
 * 
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div id="main" class="col-mb-12 col-8 col-offset-2 index-main">
    <link rel="stylesheet" href="<?php $this->options->themeUrl("css/archives.css"); ?>">
    <div id="archives-tags">
        <div>Tags</div>
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1')->to($tags); ?>
        <ul id="archives-tags-list">
        <?php while($tags->next()): ?>
            <li class="archives-tags-item"><a href="<?php $tags->permalink(); ?>"title='<?php $tags->name(); ?>'><?php $tags->name(); ?></a></li>
        <?php endwhile; ?>
        </ul>
    </div>
    <div id="archives-categories">
        <div>Categories</div>
        <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
        <ul id="archives-cate-list">
            <?php while ($category->next()): ?>
            <li class="archives-cate-item"><a href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div id="timeline-container">
    <?php $this->widget('Widget_Contents_Post_Recent')->to($post);?>
    <?php while($post->next()): ?>
        <?php 
            $year=$post->__get('year');
            $month=$post->__get('month');
            $day=$post->__get('day');
            $title=$post->title;
            $time=date('jS',$post->created);
            $link=$post->permalink;
            $html='';
            archives($day,$month,$year,$title,$time,$link);
            //$this->widget('Widget_Contents_Post_Date', 'type=year&format=F Y')->parse('<a href="{permalink}">{date}</a>');
         ?>
    <?php endwhile; ?>
    </div><!-- end timeline container -->
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>
