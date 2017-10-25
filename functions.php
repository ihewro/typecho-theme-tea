<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    /** @var TYPE_NAME $indexProducts */

    $IndexIntroduction = new Typecho_Widget_Helper_Form_Element_Textarea('IndexIntroduction', NULL, '        <p>你看到的这张照片是在中国福建省西北部的武义山路上的一条路。我在拍乌龙茶的时候拍了这张照片。浏览本网站，了解传统茶，手工茶壶以及丰富的茶文化历史，我在过去12年中发现，蜿蜒蜿蜒的中国最大的茶园。今天，我为私人客户寻找定制的茶。没有订单太小或太大。你一直梦想着有一杯茶吗？让我来找你，带给你最好的中国提供的。</p>

        <p>我通过亚洲旅行，与农民和茶主人会面，寻求发现传奇和罕见的茶。我从极小的收成来源，难以找到，精选的手工茶。我的热情是通过亲身体验茶来学习茶，我可以与你分享这个世界的奥秘和美食。</p>

        <p>为什么是“红圈”？有一圈茶连接起来：从农民开始，茶拣选人，处理茶叶的主人，茶叶供应商，进口商，最后喝茶的人继续说道。这个人最终成为这些叶子的守护者。但是，一起，这些人都被同样的叶子所感动。他们连接在一个神圣的圆圈，受这种茶约束。红色当然是庆祝的颜色，红圈茶庆祝这个光荣的人群。尽管他们分开生活，他们都欣赏茶艺术。
        </p>', '首页大段文字介绍', '填写一些文字，支持HTML代码');
    $form->addInput($IndexIntroduction);

    $ProductsItems = new Typecho_Widget_Helper_Form_Element_Textarea('ProductsItems', NULL, '{
    "title": "1996年，云南省孟海煮松散的普洱", 
    "price": "$0.00", 
    "img": "http://cdn.shopify.com/s/files/1/0201/4318/products/1996MenghaiPuerh_grande.jpg?v=1432502154", 
    "link": "#"
},
{
    "title": "中国福建省武夷山吴义水仙老树", 
    "price": "$0.00", 
    "img": "http://cdn.shopify.com/s/files/1/0201/4318/products/LapsangSouchong2_grande.jpg?v=1432703519", 
    "link": "#"
},
{
    "title": "中国福建省武夷山吴义水仙老树", 
    "price": "$0.00", 
    "img": "http://cdn.shopify.com/s/files/1/0201/4318/products/OldTreeShuiXian_grande.jpg?v=1432705318", 
    "link": "#"
},
{
    "title": "夏冠200g中国云南2004年", 
    "price": "$0.00", 
    "img": "http://cdn.shopify.com/s/files/1/0201/4318/products/2004XiaGuanPuerh_grande.jpg?v=1432705661", 
    "link": "#"
}

', '首页商品信息配置', '基本配置直接修改框中的value值和link值即可，高级配置请看文档');
    $form->addInput($ProductsItems);
}

/**
 * 显示上一篇
 *
 * @access public
 * @param string $default 如果没有上一篇,显示的默认文字
 * @return void
 */
function theNext($widget, $default = NULL)
{
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created > ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_ASC)
        ->limit(1);
    $content = $db->fetchRow($sql);

    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '" > ← 上一篇 </a>
';
        echo $link;
    } else {
        $link = '';
        echo $link;
    }
}

/**
 * 显示下一篇
 *
 * @access public
 * @param string $default 如果没有下一篇,显示的默认文字
 * @return void
 */
function thePrev($widget, $default = NULL)
{
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created < ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1);
    $content = $db->fetchRow($sql);

    if ($content) {
        $content = $widget->filter($content);
        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '" > 下一篇 → </a>';
        echo $link;
    } else {
        $link = '';
        echo $link;
    }
}

//返回文章的图片

function returnHeaderImgSrc($widget){
    $options = Typecho_Widget::widget('Widget_Options');
    $rand = rand(1,3);
    $howToThumb = $options->RandomPicChoice;
    $random = $widget->widget('Widget_Options')->themeUrl . '/img/random/' . $rand . '.jpg';

    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
    $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|png))/i';
    $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|png))/i';

    // 随机缩略图路径
    //正则匹配 主题目录下的/images/sj/的图片（以数字按顺序命名）
    @$attach = $widget->attachments(1)->attachment;//附件中的图片
    $thumbField = $widget->fields->thumb;
    if (!empty($thumbField)){
        return $thumbField;
    }elseif (isset($attach->isImage) && $attach->isImage == 1){
        return $attach->url;
    }else{
        if (preg_match_all($pattern, $widget->content, $thumbUrl)){
            $thumb = $thumbUrl[1][0];
        }elseif (preg_match_all($patternMD, $widget->content, $thumbUrl)){
            $thumb = $thumbUrl[1][0];
        }elseif (preg_match_all($patternMDfoot, $widget->content, $thumbUrl)){
            $thumb = $thumbUrl[1][0];
        }else{//文章中没有图片
            return $random;
        }
        return $thumb;
    }
}