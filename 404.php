<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<style>
        #header {
            height: 70vh;
        }
        .filter:before {
            height: 70vh;
        }
        #site-meta {
            display: none;
        }
        #background {
            background: url(<?php $this->options->themeUrl('img/404.jpg') ?>) center bottom no-repeat;
            background-size: 100% auto;
        } 
        .error-page {
            margin-bottom: 30px;
        }
        input[type="text"] {
            padding: 10px;
        }
        .submit {
            width: 50%;
            max-width: 200px;
        }
</style>
    <div class="col-mb-12 col-tb-8 col-tb-offset-2">

        <div class="error-page">
            <h2 class="post-title">404</h2>
            <p><?php _e('来到了一个不存在的位置, 要不要搜索看看: '); ?></p>
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus /></p>
                <p><center><button type="submit" class="submit"><?php _e('搜索'); ?></button></center></p>
            </form>
        </div>

    </div><!-- end #content-->
	<?php $this->need('footer.php'); ?>
