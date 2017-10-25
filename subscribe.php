<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="template">
    <form method="post" action="<?php $this->options->themeUrl(); ?>report.php" id="comment_form" class="comment-form" accept-charset="UTF-8">
        <h3 id="add-comment-title">开始预约</h3>
        <div class="large_form">
            <label for="comment-author">手机号</label>
            <input required="" type="text" name="phoneNumber" id="comment-author" value="">
        </div>
        <div class="large_form">
            <label for="comment-email">姓名</label>
            <input required="" type="text" name="name" id="comment-email" value="">
        </div>
        <div class="large_form">
            <label for="comment-body">留言</label>
            <textarea required="" name="message" id="comment-body"></textarea>
        </div>
        <input type="hidden" value="<?php $this->permalink() ?>	" name="permalink">
        <input type="hidden" value="<?php $this->title() ?>" name="title">
        <input type="hidden" value="<?php $this->themeUrl() ?>" name="themeUrl">
        <div class="action_bottom">
            <input type="submit" value="提交">
        </div>
    </form>
</div>