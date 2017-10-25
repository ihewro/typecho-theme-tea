<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 首页
 *
 * @package custom
 */
$this->need('header.php'); ?>


<div id="main" role="main">
    <!-- Slot A -->
    <div class="rte content-row">
        <?php $options = Typecho_Widget::widget('Widget_Options'); ?>
        <?php echo $options->IndexIntroduction; ?>
    </div>
    <!-- Slot B -->
    <!--首页幻灯片-->
    <div class="row">
        <div class="flexslider">
            <ul class="slides">
                <!--调用最新文章3篇-->
                <?php
                $obj = $this->widget('Widget_Contents_Post_Recent','pageSize=3')->to($recent);
                while($recent->next()){
                    echo '<li style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;" class=""> <a target="_blank" href="'.$recent->permalink.'"> <div class="onelist-item-thumb" style="background-image:url('.returnHeaderImgSrc($obj).');" alt="Slide 1" draggable="false"><div><div class="item-desc">
                <p class="desc-words"> '.$recent->title.' </p>
                <div class="goTo"> <p class="goToWords">点击访问 ► </p> </div>
            </div></a> </li>';
                }
                ?>
            </ul>
            <ul class="flex-direction-nav">
                <li><a class="flex-prev" href="#">上一页</a></li>
                <li><a class="flex-next" href="#">下一页</a></li>
            </ul>
        </div>
    </div>
    <!-- Slot C -->
    <div class="grid product-list clearfix">
        <?php
        $options = Typecho_Widget::widget('Widget_Options');
        if(!empty($options->ProductsItems)){
            $json = '['.$options->ProductsItems.']';
            $ProductsItems = json_decode($json);
            $ProductItemsOutput = "";
            foreach ($ProductsItems as $productsItem){
                $title = $productsItem->title;
                $price = $productsItem->price;
                $link = $productsItem->link;
                $img = $productsItem->img;

                $ProductItemsOutput .= <<<EOF
            <div class="prod-block column quarter  bleed">
                <div class="prod-image-wrap">
                    <a href="$link"> <span class="helper"></span><img src="$img" alt="$title" /> </a>
                </div>
                <!-- .prod-image-wrap -->
                <div class="prod-caption" style="height: 97px;">
                    <a href="$link">
                        <div class="title">
                            $title
                        </div> <span class="prod-price"> $price </span> </a>
                </div>
                <!-- .prod-caption -->
            </div>
EOF;
            }
        }
        ?>
        <?php echo $ProductItemsOutput; ?>
    </div>
    <!-- Slot D -->
    <div class="grid clearfix">
    </div>
    <!-- Slot E -->
    <div class="rte content-row"></div>
    <!-- Slot F -->
    <!-- Slot G -->
    <div class="grid">
    </div>
</div>


<?php $this->need('footer.php'); ?>

