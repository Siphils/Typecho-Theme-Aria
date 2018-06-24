<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
    <div id="main" class="col-mb-12 col-8 col-offset-2">
        <style>
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
        <div class="error-page">
            <h2 class="post-title">404</h2>
            <?php echo $this->_archiveSingle;echo $this->_archiveType;echo $this->archiveSlug; ?>
            <p><?php _e('来到了一个不存在的位置, 要不要搜索看看: '); ?></p>
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus /></p>
                <p><center><button type="submit" class="submit"><?php _e('搜索'); ?></button></center></p>
            </form>
        </div>

    </div><!-- end #content-->
	<?php $this->need('footer.php'); ?>
