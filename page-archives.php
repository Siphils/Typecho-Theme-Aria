<?php
/**
 * 归档页面 时间轴
 * 
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div id="main" class="col-mb-12 col-8 col-offset-2">
     <style>
     html{overflow-x:hidden;overflow-y:auto}#archives-tags,#archives-categories{-webkit-animation:move-to-left 1.2s;margin:30px 0;position:relative}#archives-tags>div,#archives-categories>div{font-size:2.7rem;position:relative;font-family:Trebuchet MS,Consolas,Microsoft YaHei;font-weight:bolder;font-style:italic;color:rgba(0,0,0,0.6);padding:0 0 0 20px;margin:0 0 20px 0}#archives-tags-list,#archives-cate-list{-webkit-animation:move-to-left 1.2s;margin:0;padding:0 0 0 40px}.archives-tags-item:before,.archives-cate-item:before{border-top:10px solid transparent;border-right:7px solid rgba(0,0,0,0.6);border-bottom:10px solid transparent;content:"";height:0;position:absolute;top:.5px;left:-7px;width:0}.archives-tags-item:after,.archives-cate-item:after{background-color:#f2f2f2;border-radius:50%;content:"";height:4px;position:absolute;top:8px;left:-4px;width:4px}.archives-tags-item,.archives-cate-item{font-size:15px;line-height:15px;list-style:none;padding:3px 5px;margin:0 4px;display:inline-block;position:relative;word-break:break-all;background-color:rgba(0,0,0,0.6);border-radius:0 5px 5px 0}.archives-tags-item>a,.archives-cate-item>a{color:#fff}#timeline-container{padding-left:20px;position:relative}#timeline-container:before{-webkit-animation:move-to-down 1.4s;content:'';position:absolute;width:4px;left:3px;top:0;height:100%;background-color:#dcdcdc}.timeline-year,.timeline-month{-webkit-animation:move-to-left 1.2s;position:relative;font-family:Trebuchet MS,Consolas,Microsoft YaHei;font-weight:bolder;font-style:italic;color:rgb(97,98,100)}.timeline-year{margin:10px 0;font-size:2.7rem}.timeline-month{font-size:2rem}.timeline-box{}.timeline-box:before{-webkit-animation:move-to-right 1.2s;content:'';width:30px;height:30px;line-height:20px;color:#fff;text-align:center;background-color:#8a8a8a;border-radius:50%;position:absolute;left:-10px}.timeline-post:before{content:'';position:absolute;top:3px;left:-8px;display:block;width:0;height:0;border-top:8px solid transparent;border-bottom:8px solid transparent;border-right:8px solid rgb(138,138,138)}.timeline-post{-webkit-animation:move-to-left 1.2s;padding:5px 0 5px 15px;font-size:0.95rem;display:block;min-height:2rem;line-height:2rem;border-radius:4px;position:relative;background-color:rgb(138,138,138);margin:20px auto;margin-left:20px}.timeline-post a{color:#ededed}.timeline-post-time{position:absolute;color:#ffffff;font-style:italic;font-family:Consolas;font-size:.7rem;left:-48px;top:0}@media screen and (max-width:768px){.timeline-box:before{left:-10px}.timeline-post{min-height:1.3rem;line-height:1.3rem}.timeline-post-time{top:5px}}@-webkit-keyframes move-to-right{0%{left:-1000px}100%{left:0}}@-webkit-keyframes move-to-left{0%{right:-2000px}100%{right:0}}@-webkit-keyframes move-to-down{0%{top:-3000px}100%{top:0}}
 </style>
    <div id="archives-tags">
        <div>Tags</div>
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1')->to($tags); ?>
        <ul id="archives-tags-list">
        <?php while($tags->next()): ?>
            <li class="archives-tags-item"><a data-pjax=true href="<?php $tags->permalink(); ?>"title='<?php $tags->name(); ?>'><?php $tags->name(); ?></a></li>
        <?php endwhile; ?>
        </ul>
    </div>
    <div id="archives-categories">
        <div>Categories</div>
        <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
        <ul id="archives-cate-list">
            <?php while ($category->next()): ?>
            <li class="archives-cate-item"><a data-pjax=true href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a></li>
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
            pageArchives($day,$month,$year,$title,$time,$link);
            //$this->widget('Widget_Contents_Post_Date', 'type=year&format=F Y')->parse('<a href="{permalink}">{date}</a>');
         ?>
    <?php endwhile; ?>
    
    </div><!-- end timeline container -->
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>
