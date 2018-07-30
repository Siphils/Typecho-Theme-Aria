<?php function threadedComments($comments, $options) {
    $commentClass = '';
/*  if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }*/
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
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
    <div id="<?php $comments->theId(); ?>" class="comment-content">
        <span class="comment-reply"><?php $comments->reply('Reply'); ?></span>
        <?php commentGravatar($comments->mail,$comments->author,128); ?>
        <?php if ($comments->authorId): ?>
        <?php if ($comments->authorId == $comments->ownerId): ?>
        <div class="comment-author comment-by-author">
        <?php endif; ?>
        <?php else: ?>
        <div class="comment-author">
        <?php endif; ?>
            <cite class="fn"><?php $comments->author(); ?></cite>
        </div>
        <div class="comment-meta">
            <a href="<?php $comments->permalink(); ?>">
                <?php $comments->dateWord(); ?>
            </a>
            <?php showCommentUA($comments->agent); ?>
        </div>
        <div class="comment-main">
            <?php showCommentContent($comments->coid); ?>
            <div class="comment-arrow"></div>
        </div>
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php commentReply($this); ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <span id="response"><i class="iconfont icon-aria-comment"></i> <?php $this->commentsNum(_t('0 Comment'), _t('1 Comment'), _t('%d Comments')); ?></span>
    <?php if ($comments->have()): ?>
    
    
    <?php $comments->listComments(); ?>
    
    <div id="page-nav">
        <?php $comments->pageNav('<', '>',1,'...',array('wrapTag' => 'ul', 'wrapClass' => '','itemTag' => 'li','currentClass' => 'page-current',)); ?>  
    </div>
    
    <?php endif; ?>
    
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply('Cancel'); ?>
        </div>
    
        <span id="new-response"><i class="iconfont icon-aria-write"></i> 开始你的表演 </span>
        <!-- New Comments begin -->
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
            <?php else: ?>
            <div id="comment-info">
                <img id="comment-cur-avatar" src="<?php $this->options->themeUrl('assets/img/comment-avatar.jpg'); ?>">
                <p class="comment-input">
                    <label for="author" class="required"><i class="iconfont icon-aria-username"></i></label>
                    <input placeholder="*Your Name" type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
                </p>
                <p class="comment-input">
                    <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><i class="iconfont icon-aria-email"></i></label>
                    <input placeholder="*Your email" type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                </p>
                <p class="comment-input">
                    <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><i class="iconfont icon-aria-link"></i></label>
                    <input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                </p>
            </div>
            <!-- <script type="text/javascript" src="<?php $this->options->themeUrl('js/js-md5.js'); ?>"></script> -->
            <?php endif; ?>
            <p>
                <label for="textarea" class="required"></label>
                <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required placeholder="「&nbsp;温柔正确的人总是难以生存，因为这世界既不温柔，也不正确&nbsp;」"><?php $this->remember('text'); ?></textarea>
            </p>
            <div id="comment-footer">
                <div class="OwO"></div>
                <div class="comment-image"><i class="iconfont icon-aria-picture"></i></div>
                <?php if(!empty($this->options->AriaConfig) && in_array('useCommentToMail', $this->options->AriaConfig)): ?>
                <div id="comment-ban-mail" class="ui toggle checkbox">
                    <input name="banmail" type="checkbox" value="stop">
                    <label for="comment-ban-mail"><strong>不接收</strong>回复邮件通知</label>
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
