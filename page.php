<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" role="main">
    <h1 class="starry"><?php $this->title() ?></h1>
    <div class="rte">
        <?php $this->content(); ?>
    </div>
</div>

<?php $this->need('footer.php'); ?>
