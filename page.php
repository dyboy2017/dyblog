<?php 
/**
 * 自建页面模板，喜欢折腾的同学，可以根据这个基础页面或其他page-*.php为参考，
 *	扩展自己想要的单页~
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>


<div class="banner-bg-header">
    <h1 class="banner-title"><?php echo $log_title; ?></h1> 
    <h4 class="banner-sub-title">。。。</h4> 
</div>

<article class="main-content page-page" style="padding: 30px 25px 40px;">
    <div class="post-content" itemprop="articleBody">
    	<!-- 输出文章内容 -->
    	<?php echo unCompress($log_content); ?>
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