<?php function threadedComments($comments, $singleCommentOptions) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    } 
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>

<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>">
		<a class="comment-avatar" href="<?php $comments->permalink(); ?>">
			<?php $comments->gravatar('120', ''); ?>
		</a>
		<div class="comment-content">
			<div class="comment-text"><span class="comment-reply" style="float:right"><?php $comments->reply('<i class="iconfont icon-aria-reply"></i>'); ?></span>
			<p><?php if('waiting'==$comments->status) echo '<em>您的评论正等待被审核！</em>'; ?><?php showCommentContent($comments); ?></p>
			</div>
<p class="comment-meta">By <span><?php echo "<a href=\"$comments->url\" rel=\"external nofollow\" target=\"_blank\">$comments->author</a>"; ?></span> at <?php $comments->date(); ?>. <?php if(isEnabled('showCommentUA','AriaConfig')): ?><span class="comment-ua"><?php echo parseUserAgent($comments->agent); ?></span><?php endif; ?></p>
		</div>
    </div><!-- 单条评论者信息及内容 -->
    <?php if ($comments->children) { ?> 
	<div class="comment-children">
		<?php $comments->threadedComments($singleCommentOptions); ?> 
	</div>
	<?php } ?> 
</li>
 
<?php } ?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>


<?php commentReply($this); ?>
<div id="comments">
	<?php if($this->allow('comment')): ?>
	<?php $this->comments()->to($comments); ?>
	<span id="response">
		<p>
			<i class="iconfont icon-aria-comment"></i>
			<?php $this->commentsNum(_t('0 条评论'), _t('1 条评论'), _t('%d 条评论')); ?>
		</p>	
	</span>
		
		<?php if ($comments->have()): ?>
		
	<div class="comment-data">

		<?php $comments->listComments(); ?>

	</div>
		<div id="page-nav">
			<?php $comments->pageNav('<', '>',1,'...',array('wrapTag' => 'ul', 'wrapClass' => '','itemTag' => 'li','currentClass' => 'page-current',)); ?>
		</div>

		<?php endif; ?>
	<div id="<?php $this->respondId(); ?>" class="respond">
		<div class="cancel-comment-reply">
			<?php $comments->cancelReply('<i class="iconfont icon-aria-cancel"></i>'); ?>
		</div>

		<span id="new-response">
			<i class="iconfont icon-aria-write"></i> 添加新评论 </span>
		<!-- New Comments begin -->
		<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form"
		 role="form">
			<?php if($this->user->hasLogin()): ?>
			<p>
				<?php _e('登录身份: '); ?>
				<a href="<?php $this->options->profileUrl(); ?>">
					<?php $this->user->screenName(); ?>
				</a>.
				<a href="<?php $this->options->logoutUrl(); ?>" title="Logout" no-pjax>
					<?php _e('退出'); ?>&raquo;</a>
			</p>
			<?php else: ?>
			<div id="comment-info">
				<p>
					<img no-lazyload id="comment-cur-avatar" src="<?php echo __TYPECHO_GRAVATAR_PREFIX__ ?>">
				</p>
				<p class="comment-input">
					<label for="author" class="required">
						<i class="iconfont icon-aria-username"></i>
					</label>
					<input placeholder="（必填）昵称" type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>"
					 required />
				</p>
				<p class="comment-input">
					<label for="mail" <?php if ($this->options->commentsRequireMail): ?> class="required"
						<?php endif; ?>>
						<i class="iconfont icon-aria-email"></i>
					</label>
					<input placeholder="<?php echo $this->options->commentsRequireMail ? '（必填）' : '（选填）';echo '邮箱'; ?>" type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"
					 <?php if ($this->options->commentsRequireMail): ?> required
					<?php endif; ?>/>
				</p>
				<p class="comment-input">
					<label for="url" <?php if ($this->options->commentsRequireURL): ?> class="required"
						<?php endif; ?>>
						<i class="iconfont icon-aria-link"></i>
					</label>
					<input type="url" name="url" id="url" class="text" placeholder="<?php echo $this->options->commentsRequireURL ? '（必填）' : '（选填）';echo '网站'; ?>"
					 value="<?php $this->remember('url'); ?>" <?php
					 if ($this->options->commentsRequireURL): ?> required
					<?php endif; ?>/>
				</p>
			</div>
			<?php endif; ?>
			<?php if($this->options->commentsMarkdown): ?>
				<div style="float:right">
					<i class="iconfont icon-aria-markdown"></i><span style="font-style:italic;font-size:13px;color:#444"> Markdown is supported.</span>
				</div>
			<?php endif; ?>
			<p>
				<label for="textarea" class="required"></label>
				<textarea style="background: url('<?php $this->options->themeUrl('assets/img/textarea.gif'); ?>') right bottom no-repeat;background-size: 180px 180px;"
				 rows="8" cols="50" name="text" id="textarea" class="textarea" placeholder="<?php $this->options->placeholder(); ?>"><?php $this->remember('text'); ?></textarea>
			</p>
			<div id="comment-footer">
				<div class="OwO">
				</div><!--end .OwO-->
				<div class="comment-image">
					<span><i class="iconfont icon-aria-picture"></i>图片</span>
				</div>
				<?php if(isEnabled('useCommentToMail','AriaConfig')): ?>
				<div id="comment-ban-mail" class="ui toggle checkbox">
					<input name="banmail" type="checkbox" value="stop">
					<label for="comment-ban-mail">
						<strong>不接收</strong>回复邮件通知</label>
				</div>
				<?php endif; ?>
			</div>
			<center>
				<button type="submit" class="submit"><i class="iconfont icon-aria-submit"></i> 发射</button>
			</center>
		</form>
	</div>
	<?php else: ?>
        <style>.comment-reply {display:none;}</style>
    <span style="font-size: 20px;display: block;user-select: none;"><i class="iconfont icon-aria-close" sytle="font-size:20px"></i> 评论关闭了哟</span>
    <?php endif; ?>
</div>