<?php 
/**
 * 页面模板： 友情链接单页，别名：friends
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>


<div class="banner-bg-header">
    <h1 class="banner-title"><?php echo $log_title; ?></h1> 
</div>

<article class="main-content page-page" style="padding: 30px 25px 40px;">
    <div class="post-content" itemprop="articleBody">
    	<!-- 输出文章内容 -->
    	<?php echo unCompress($log_content); ?>

        <!-- 自助友链申请 -->
        <?php doAction('link_web_echo'); ?>
        
        <!-- 友情链接输出 -->
        <?php friends_links();?>
    </div>
</article>

<!-- 评论模块 -->
<div class="comment-container">
	<div id="comments" class="clearfix">
		<span class="response">发表评论 / <a>Comment</a></span>
		<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>

		<?php blog_comments($comments); ?>
	</div>
</div>


<?php
 include View::getView('footer');
?>