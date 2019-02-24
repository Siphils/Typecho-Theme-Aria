<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #body -->
</div><!-- end #pjax-container -->
<div id="go-top" onclick="goTop(this);"><img no-lazyload src="<?php $this->options->themeUrl('assets/img/goTop.png'); ?>"><!--div id="scroll-percentage"></div--></div>
<footer id="footer" role="contentinfo">
    <?php $this->options->customFooter(); ?>
    <?php if(Utils::isEnabled('showHitokoto','AriaConfig')): ?><p id="hitokoto"></p><?php endif; ?>
    <p id="footer-info">&copy; <span><?php echo $this->options->cpr ? $this->options->cpr : date('Y'); ?></span><?php Utils::getFooterWidget(); ?></p>
</footer><!-- end #footer -->
<?php if(Utils::isEnabled('enablePjax','AriaConfig')): ?>
<script src="<?php $this->options->themeUrl('assets/js/jquery.pjax.min.js'); ?>"></script>
<?php endif; ?>
<?php if(Utils::isEnabled('enableFancybox','AriaConfig')): ?>
<script src="<?php $this->options->themeUrl('assets/js/jquery.fancybox.min.js'); ?>"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('assets/js/highlight.min.js'); ?>"></script>
<?php if(Utils::isEnabled('enableLazyload','AriaConfig')): ?>
<script src="<?php $this->options->themeUrl('assets/js/jquery.lazyload.min.js'); ?>"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('assets/OwO/OwO.min.js') ?>"></script>
<?php if(Utils::isEnabled('enableMathJax','AriaConfig')): ?>
<script type="text/x-mathjax-config"><?php $this->options->MathJaxConfig(); ?></script>
<script src="//cdn.jsdelivr.net/npm/mathjax@latest/MathJax.js?config=TeX-AMS-MML_SVG.js"></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('assets/js/functions.min.js?v=8b426df9ab'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/main.min.js?v=de446d9d66'); ?>"></script>
<?php echo $this->options->customScript ? "<script>".$this->options->customScript."</script>\n" : ""; ?>
<?php if($this->options->statistics) $this->options->statistics(); ?>
<?php $this->footer(); ?>
</body>
</html>
