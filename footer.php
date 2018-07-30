<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #body -->

  <div id="go-top"><img src="<?php $this->options->themeUrl('assets/img/goTop.png'); ?>"><div id="scroll-percentage"></div></div>

<footer id="footer" role="contentinfo">
    <div>
        <?php $this->options->userFooter(); ?>
        <p>
        &copy; <span><?php echo date('Y'); ?></span> <span><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.</span></p>
        <?php if(!empty($this->options->AriaConfig) && in_array('showHitokoto', $this->options->AriaConfig)): ?><p id="hitokoto"></p><?php endif; ?>
        <p id="footer-info"><span><a href="http://www.typecho.org" title="念念不忘，必有回响。">Typecho</a></span><span><a href="https://eriri.ink/Typecho-Theme-Aria.html" title="Typecho-Theme-Aria">Theme</a></span><?php if(!empty($this->options->AriaConfig) && in_array('showLoadTime', $this->options->AriaConfig)): ?><span class="pjax-container">Processd in <?php timer_stop(1) ?> second(s).</span><?php endif; ?></p>
    </div>
</footer><!-- end #footer -->
</div><!-- end #wrapper -->
<script src="//cdn.bootcss.com/jquery/1.8.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/nprogress/0.2.0/nprogress.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/pjax/pjax.min.js"></script>
<script src="//cdn.bootcss.com/headroom/0.9.4/headroom.min.js"></script>
<div class="pjax-container">
<script src="//cdn.bootcss.com/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script src="//cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
<?php AriaConfig(); ?>
<script src="<?php $this->options->themeUrl('assets/main.min.js'); ?>"></script>
<?php if($this->options->statistics) $this->options->statistics(); ?>
</div>
<script>
    window.onload = Aria.init();
</script>
<?php $this->footer(); ?>
</body>
</html>
