<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" role="main">
    <div class="article">
        <h1 class="page-title starry"> <?php $this->title() ?> </h1>
        <p class="date"> <time pubdate="" datetime="<?php $this->date('c'); ?>"><?php $this->date('F jS , Y'); ?></time> </p>
        <div class="rte">
            <?php if($this->fields->intro): ?>
            <p class="excerpt"><?php $this->fields->intro() ?></p>
            <?php endif; ?>
            <?php $this->content(); ?>
        </div>
    </div>
    <?php
    $categories = $this->categories;
    foreach($categories as $cate) {
        if ($cate['slug'] == "reservation"){
            $this->need('subscribe.php');
            break;
        }
    }
    ?>
    <p class="left-right-links">
        <?php theNext($this); ?>
        <?php thePrev($this); ?>
    </p>
</div>

<?php $this->need('footer.php'); ?>
