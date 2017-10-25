<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" role="main">
    <?php if ($this->have()): ?>
    <h1 class="starry"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h1>
    <ul class="mini-nav clearfix buttons">
        <?php $this->widget('Widget_Metas_Category_List')
            ->parse('<li> <a href="{permalink}" title="Show articles tagged Aged Tea">{name}</a> </li>'); ?>
    </ul>
    <!--文章列表-->
    <ul class="articles">
        <?php while($this->next()): ?>
            <li class="article"> <h2 class="title"> <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a> </h2> <p class="meta"> <time pubdate="" datetime="<?php $this->date('c'); ?>"><?php $this->date('F j, Y'); ?></p>
                <div class="rte">
                    <p><?php $this->excerpt(300, '...'); //200就是摘要的字数，...是后缀; ?></p>
                </div>
                <a class="blog-read-more" href="<?php $this->permalink() ?>">阅读更多 →</a>

            </li>
        <?php endwhile; ?>
    </ul>

    <?php else: ?>
        <div class="content-row">
            <form action="" method="post" class="search-form" role="search">
                <input type="text" name="s" placeholder="输入关键字">
                <input type="submit" value="Search">
            </form>
            <p>没有查找到相关结果，请更换关键词后再次搜索</p>
        </div>
    <?php endif; ?>

    <!--分页按钮-->
    <div class="pagination">
        <?php $this->pageNav('« NEWER ARTICLES', 'OLDER ARTICLES »'); ?>
    </div>
</div>
<?php $this->need('footer.php'); ?>
