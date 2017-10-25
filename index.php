<?php
/**
 * 一款为茶饮相关量身打造的主题
 *
 * @package tea
 * @author 友人C
 * @version 1.1.1
 * @link https://www.ihewro.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div id="main" role="main">
    <h1 class="starry">所有分类</h1>
    <ul class="mini-nav clearfix buttons">
        <?php $this->widget('Widget_Metas_Category_List')
            ->parse('<li> <a href="{permalink}" title="Show articles tagged Aged Tea">{name}</a> </li>'); ?>
    </ul>
    <!--文章列表-->
    <ul class="articles">
        <?php while($this->next()): ?>
            <li class="article"><h2 class="title"> <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a> </h2> <p class="meta"> <time pubdate="" datetime="<?php $this->date('c'); ?>"><?php $this->date('F j, Y'); ?></p>
            <div class="rte">
                <p><?php $this->excerpt(300, '...'); //200就是摘要的字数，...是后缀; ?></p>
            </div>
            <a class="blog-read-more" href="<?php $this->permalink() ?>">阅读更多 →</a>

        </li>
        <?php endwhile; ?>
    </ul>


    <!--分页按钮-->
    <div class="pagination">
        <?php $this->pageNav('« NEWER ARTICLES', 'OLDER ARTICLES »'); ?>
    </div>
</div>
<?php $this->need('footer.php'); ?>
