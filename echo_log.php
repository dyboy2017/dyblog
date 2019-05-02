<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>


<article class="main-content page-page" itemscope itemtype="http://schema.org/Article">
	<!-- 标题 -->
	<div class="post-header">
		<h1 class="post-title" itemprop="name headline"> <?php echo $log_title; ?> </h1>
		<div class="post-data">
			<div class="article-meta">
				<span><i class="fa fa-folder"></i> <?php blog_sort($logid); ?>&nbsp;</span>
				<span><i class="fa fa-user"></i> <?php echo blog_author($author); ?>&nbsp;</span>
				<span style="padding-right: 3px"><i class="fa fa-eye"></i> <?php echo $views; ?></span> 
				<span><i class="fa fa-calendar"></i> <?php echo gmdate('Y-n-j', $date); ?>&nbsp;</span>
				<?php editflg($logid,$author); ?>
			</div>
		</div>
	</div>
	<!-- 内容 -->
	<div id="post-content" class="post-content" itemprop="articleBody" >
		<!-- 输出标签列表 -->
        <p class="post-tags">
            <?php blog_tag($logid); ?>
        </p>

        <!-- 输出文章内容 -->
        <div class="content_body">
			<?php echo unCompress($log_content); ?>
		</div>

		<!-- 上下一篇文章 -->
		<div class="neigborhood">
			<?php 
				extract($neighborLog);
				if($prevLog){
					echo '<div class="prevlog">上一篇<br/><a href="'.Url::log($prevLog['gid']).'" title="'.$prevLog['title'].'">'.$prevLog['title'].'</a></div>';}
				else{
					echo '<div class="prevlog"><a href="#" title="没有上一篇了">没有上一篇了</a></div>';
				}
				if($nextLog){
					echo '<div class="nextlog">下一篇<br/><a href="'.Url::log($nextLog['gid']).'" title="'.$nextLog['title'].'">'.$nextLog['title'].'</a></div>';}
				else{
					echo '<div class="nextlog"><a href="#" title="没有下一篇了">没有下一篇了</a></div>';
				}
			?>
		</div>

		<!-- 版权备注 -->
		<p class="post-info">
			版权声明：《 <a href="<?php echo Url::log($logid); ?>" title="<?php echo $log_title; ?>"><?php echo $log_title; ?></a> 》为<?php echo blog_author($author); ?>原创文章，转载请注明出处！<br/>最后编辑:<?php echo gmdate('Y-n-j H:m:s', $date); ?>
		</p>
	</div>
	<!-- 关联 -->
	<div class="related-article">
		<?php related_logs($logData);?>
	</div>
</article>



<!-- 文章目录 -->
<div class="auto-hide" id="article-menu" data-autoMenu> </div>

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