<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #body -->
</div><!-- end #pjax-container -->
<div id="go-top"><img no-lazyload src="<?php $this->options->themeUrl('assets/img/goTop.png'); ?>"><!--div id="scroll-percentage"></div--></div>
<footer id="footer" role="contentinfo">
    <p><i class="iconfont icon-aria-paperboat"></i></p>
    <?php $this->options->userFooter(); ?>
    <?php if(isEnabled('showHitokoto','AriaConfig')): ?><p id="hitokoto"></p><?php endif; ?>
    <p id="footer-info">&copy; <span><?php echo $this->options->cpr ? $this->options->cpr : date('Y'); ?></span><?php getFooterWidget(); ?></p>
</footer><!-- end #footer -->
<?php if(isEnabled('usePjax','AriaConfig')): ?>
<script src="<?php $this->options->themeUrl('assets/js/jquery.pjax.min.js'); ?>"></script>
<?php endif; ?>
<?php if(isEnabled('useFancybox','AriaConfig')): ?>
<script src="<?php $this->options->themeUrl('assets/js/jquery.fancybox.min.js'); ?>"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('assets/js/highlight.min.js'); ?>"></script>
<?php if(isEnabled('useLazyload','AriaConfig')): ?>
<script src="<?php $this->options->themeUrl('assets/js/jquery.lazyload.min.js'); ?>"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('assets/OwO/OwO.min.js') ?>"></script>
<?php echo $this->options->userScript ? "<script>".$this->options->userScript."</script>\n" : ""; ?>
<script src="<?php $this->options->themeUrl('assets/js/main.min.js?v=d3e38dcfad'); ?>"></script>
<?php if($this->options->statistics) $this->options->statistics(); ?>
<?php $this->footer(); ?>
</body>
</html>
