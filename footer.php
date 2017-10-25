<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->footer(); ?>
<footer id="pagefooter">
    <nav class="nav" role="navigation">
        <ul>
            <li><a href="/search" title="搜索">搜索</a></li>
            <li><a href=""<?php $this->options->rootUrl(); ?>/about.html"" title="关于我们">关于我们</a></li>
        </ul>
    </nav>
    <div class="social-icons size-">
        <a title="Twitter" class="email" target="_blank" href="emalito:37540116@qq.com">emali</a>
        <a title="Facebook" class="rss" target="_blank" href="<?php $this->options->feedUrl(); ?>">Rss</a>
        <span class="div">|</span>
        <a title="Search" class="search " href="/search">Search</a>
    </div>
    <!-- .social -->
    <p class="copyright" role="contentinfo"> <span class="seg">&copy; 2017 <?php $this->options->title() ?>	</span> <span>All rights reserved.</span> </p>
    <ul class="payment-methods">
        <li class="pay-paypal">PayPal</li>
        <li class="pay-visa">Visa</li>
        <li class="pay-mastercard">Mastercard</li>
        <li class="pay-amex">Amex</li>
        <li class="pay-discover">Discover</li>
        <li class="pay-maestro">Maestro</li>
        <li class="pay-jcb">JCB</li>
        <li class="pay-diners">Diners Club</li>
    </ul>
</footer>
</div>
<!-- end of .container -->
<!-- Search form -->
<div id="search-modal">
    <div class="container">
        <form action="" method="post">
            <input type="text" name="s" placeholder="搜索……" autocomplete="off" required="" />
            <input type="submit" value="→" />
        </form>
    </div>
</div>
<!-- Scroll to top -->
<a id="scroll-top" href="#">返回顶部</a>
<script src="<?php $this->options->themeUrl('assets/js/libs.js') ?>" type="text/javascript"></script>
<script src="<?php $this->options->themeUrl('assets/js/main.js') ?>" type="text/javascript"></script>
<div id="cboxOverlay" style="display: none;"></div>
<div id="colorbox" class="" role="dialog" tabindex="-1" style="display: none;">
    <div id="cboxWrapper">
        <div>
            <div id="cboxTopLeft" style="float: left;"></div>
            <div id="cboxTopCenter" style="float: left;"></div>
            <div id="cboxTopRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxMiddleLeft" style="float: left;"></div>
            <div id="cboxContent" style="float: left;">
                <div id="cboxTitle" style="float: left;"></div>
                <div id="cboxCurrent" style="float: left;"></div>
                <button type="button" id="cboxPrevious"></button>
                <button type="button" id="cboxNext"></button>
                <button id="cboxSlideshow"></button>
                <div id="cboxLoadingOverlay" style="float: left;"></div>
                <div id="cboxLoadingGraphic" style="float: left;"></div>
            </div>
            <div id="cboxMiddleRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxBottomLeft" style="float: left;"></div>
            <div id="cboxBottomCenter" style="float: left;"></div>
            <div id="cboxBottomRight" style="float: left;"></div>
        </div>
    </div>
    <div style="position: absolute; width: 9999px; visibility: hidden; display: none; max-width: none;"></div>
</div>
<a href="#" class="mobile-nav-toggle" id="mobile-nav-return"></a>
<div class="yformater-layer">
    <div class="yformater-layer-content">
        <i class="yformater-layer-icon"></i>
    </div>
</div>
</body>
<!--end of #body-->
</html>