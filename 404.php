<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" role="main">
    <h1>404 页面未找到</h1>
    <p class="rte">您所请求的页面不存在。点击这里
        <a href="<?php $this->options->rootUrl(); ?>">这里</a> 继续浏览。</p>
</div>

<?php $this->need('footer.php'); ?>
