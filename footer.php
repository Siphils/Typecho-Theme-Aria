<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end #body -->

  <div id="go-top"><img src="<?php $this->options->themeUrl('img/goTop.png'); ?>"><div id="scroll-percentage"></div></div>

<footer id="footer" role="contentinfo">
    <div class="sui-row-fluid">
        <div class="span3"></div>
        <div class="span6" id="footer-div">
            <p>
            &copy; <span><?php echo date('Y'); ?></span> <span><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.</span></p>
            <p id="coder">Theme By <i class="with-love iconfont">&#xe671;</i> <a href="https://siphils.com/">Siphils</a>.</p>
            <p id="typecho">Powered by <a href="http://www.typecho.org">Typecho</a>.</p>

        </div>
    </div>
</footer><!-- end #footer -->
<script src="https://cdn.bootcss.com/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/nprogress/0.2.0/nprogress.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pjax/pjax.min.js"></script>
<script src="https://cdn.bootcss.com/headroom/0.9.4/headroom.min.js"></script>
<div class="pjax-container">
<script src="https://cdn.bootcss.com/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script src="<?php $this->options->themeUrl('js/prism.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/main.js'); ?>"></script>
<script>
    Aria.init();
</script>
<?php if($this->options->statistics) $this->options->statistics(); ?>
</div>
<?php $this->footer(); ?>
</body>
</html>
