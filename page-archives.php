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
	<style>html{overflow-x:hidden;overflow-y:auto}#archives-tags,#archives-categories{-webkit-animation:move-to-down 1.2s;margin:30px 0;position:relative}#archives-tags>div,#archives-categories>div{font-size:2.5rem;position:relative;color:rgba(0,0,0,0.6);padding:0 0 0 20px;margin:0 0 20px 0;text-shadow:0 0 5px #b2b2b2}#archives-tags-list,#archives-cate-list{-webkit-animation:move-to-left 1.2s;margin:0;padding:0 0 0 40px}.archives-tags-item:before,.archives-cate-item:before{border-top:12.5px solid transparent;border-right:10px solid rgba(0,0,0,0.6);border-bottom:12.5px solid transparent;content:"";height:0;position:absolute;top:0;left:-10px;width:0}.archives-tags-item:after,.archives-cate-item:after{background-color:#f2f2f2;border-radius:50%;content:"";height:4px;position:absolute;top:50%;transform:translateY(-50%);left:-4px;width:4px}.archives-tags-item,.archives-cate-item{font-size:15px;line-height:15px;list-style:none;padding:5px 8px;margin:4px 6px;height:15px;display:inline-block;position:relative;word-break:break-all;background-color:rgba(0,0,0,0.6);border-radius:0 5px 5px 0}.archives-tags-item>a,.archives-cate-item>a{color:#fff}#timeline-container{position:relative}#timeline-container:before{z-index:-1;-webkit-animation:move-to-down 1.4s;content:'';position:absolute;width:4px;left:73px;top:10px;height:100%;background-color:#dcdcdc}.timeline-ym{animation:move-to-down 1.2s;-webkit-animation:move-to-down 1.2s;position:relative;display:inline-block;margin:10px 0;padding:0 12px;font-size:1rem;left:10px;background-color:#6f6f6f;height:32px;line-height:32px;border-radius:20px}.timeline-ym a{color:#fff}.timeline-box{padding-left:90px;position:relative}.timeline-box:before{-webkit-animation:move-to-right 1.2s;content:'';width:20px;height:20px;line-height:20px;color:#fff;text-align:center;background-color:#8a8a8a;border-radius:50%;position:absolute;left:65px;top:5.5px}.timeline-post:before{content:"";width:12px;height:12px;position:absolute;border-radius:50%;background-color:#f2f2f2;top:9.5px;left:-36px;transition:all .5s ease;-webkit-transition:all .5s ease}.timeline-post{-webkit-animation:move-to-left 1.2s;padding:0;font-size:.95rem;display:block;min-height:2rem;line-height:2rem;border-radius:4px;position:relative;margin:5px 0 5px 15px}.timeline-post a{position:relative}.timeline-post a::after{content:'';display:block;width:0;height:2px;position:absolute;left:0;bottom:-5px;background:#6f6f6f;transition:all .5s ease-in-out}.timeline-post a:hover::after{width:100%}.timeline-post:hover::before{background-color:#474747}.timeline-post-time{position:absolute;color:#6f6f6f;font-family:Consolas;font-size:.9rem;left:-80px;font-weight:600;top:0}@media screen and (max-width:768px){.timeline-post{min-height:1.3rem;line-height:1.3rem}}@-webkit-keyframes move-to-right{0%{left:-1000px}100%{left:65px}}@-webkit-keyframes move-to-left{0%{right:-2000px}100%{right:0}}@-webkit-keyframes move-to-down{0%{top:-3000px}100%{top:0}}</style>
    <div id="archives-tags">
        <div>Tags</div>
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1')->to($tags); ?>
        <ul id="archives-tags-list">
        <?php while($tags->next()): ?>
            <li class="archives-tags-item"><a href="<?php $tags->permalink(); ?>" target="_blank"><?php $tags->name(); ?></a></li>
        <?php endwhile; ?>
        </ul>
    </div>
    <div id="archives-categories">
        <div>Categories</div>
        <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
        <ul id="archives-cate-list">
            <?php while ($category->next()): ?>
            <li class="archives-cate-item"><a href="<?php $category->permalink(); ?>" target="_blank"><?php $category->name(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </div>
    <div id="timeline-container">
		<?php $this->widget('Widget_Contents_Post_Recent')->to($post);?>
		<?php while($post->next()): ?>
			<?php pageArchives($post); ?>
		<?php endwhile; ?>
    </div><!-- end timeline container -->
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>