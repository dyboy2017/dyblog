<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<?php
	if (!empty($logs)){
		if(blog_tool_ishome() && empty($keyword)) {
			;
		}
		if(!empty($sort)) {

			$des = $sort['description']?$sort['description']:'这家伙很懒，还没填写该栏目的介绍呢~';
			echo '<div class="banner-bg-header"><h1 class="banner-title">'.$sortName.'</h1> <h4 class="banner-sub-title">'.$des.'</h4> </div>';
		}
		if(!empty($record)) {
			$year    = substr($record,0,4);
			$month   = ltrim(substr($record,4,2),'0');
			$day     = substr($record,6,2);
			$archive = $day?$year.'年'.$month.'月'.ltrim($day,'0').'日':$year.'年'.$month.'月';
			echo '<div class="banner-bg-header"><h1 class="banner-title">日志归档</h1> <h4 class="banner-sub-title">'.$archive.'</h4> </div>';
		}
		if(!empty($author_name)) {
			echo '<div class="banner-bg-header"><h1 class="banner-title">作者：'.$author_name.'</h1> <h4 class="banner-sub-title">共计发布文章'.$lognum.'篇</h4> </div>';
		}
		if(!empty($keyword)) {
			echo '<div class="banner-bg-header"><h1 class="banner-title">'.$keyword.'</h1> <h4 class="banner-sub-title">本次搜索帮您找到有关  <a style="color:#fff;" href="'.BLOG_URL.'?keyword='.urlencode($keyword).'" title="'.htmlspecialchars($keyword).'">'.addslashes($keyword).'</a>  的结果'.$lognum.'条</h4> </div>';
		}
		if(!empty($tag)) {
			echo '<div class="banner-bg-header"><h1 class="banner-title">'.$tag.'</h1> <h4 class="banner-sub-title">关于  <a style="color:#fff;" href="'.BLOG_URL.'tag/'.urlencode($tag).'" title="'.$tag.'">'.$tag.'</a>  的文章共有'.$lognum.'条</h4> </div>';
		}
	}

?>

<div class="main-content index-page clearfix">
	<!-- 微语 -->
	<?php if(blog_tool_ishome()):?>
		<div class="noticeHead">
			<div style="position: relative;height: 26px;overflow: hidden;">
		        <ul class="ul1">
		            <?php admin_talk(); ?>
		        </ul>
		        <div style="position: absolute;top: 5px;left:8px" class="fa fa-bullhorn"></div>div>
		    </div>
		</div>
	<?php endif;?>
	
	<!-- 文章列表 -->
    <div class="post-lists">
    	<!-- 文章列钩子 -->
    	<?php doAction('index_loglist_top'); ?>
    	
    	<?php 
			if (!empty($logs)):
			foreach($logs as $value):
				$flag = pic_num($value['content']);
		?>
		        <div class="post-lists-body">
		            <div class="post-list-item">
		            	<div class="post-list-item-container">
		            		<div class="item-thumb bg-deepgrey" style="background-image:url(<?php if($flag){ echo GetThumFromContent($value['content']); }else{ echo getrandomim(); } ?>);">
		            		</div>
		            		
	            			<div class="item-desc">
	            				<span class="sort_tag"><?php blog_sort($value['logid']); ?></span>
	            				<a href="<?php echo $value['log_url']; ?>">
	            				<p><?php echo tool_purecontent($value['log_description']); ?></p>
	            				</a>
	            			</div>
		            		
	            			<div class="item-label">
	            				<div class="item-title">
	            					<a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a>
	            				</div>
            					<div class="item-meta">
            						<i class="fa fa-calendar"></i> <?php echo gmdate('Y-n-j', $value['date']); ?>
            						<i class="fa fa-eye"></i> <?php echo $value['views']; ?>
            						<i class="fa fa-comments"></i> <a href="https://mkblog.cn/1836/#comments"><?php echo $value['comnum']; ?></a>
            					</div>
            				</div>
            			</div>
            		</div>
		        </div>
        <?php 
			endforeach;
			else:
		?>
			<!-- 预留给系统搜索 -->
			<div style="margin-top: 20px;text-align: center;">
				<h1>Not Found</h1>
				<p>抱歉，本破站没有</p>
				<a href="/search.html" title="有本事点我试试？"><img src="<?php echo TEMPLATE_URL?>images/404.jpg"></a><br/>
				<a href="/search.html" title="点击去搜索看看"><button>搜索一下</button></a>
			</div>
			
		<?php endif;?>
    </div>	

    <!-- 分页 -->
    <div id="pagenavi">
    	<div class="lists-navigator clearfix">
    		<ol class="page-navigator">
    			<?php echo sheli_fy($lognum,$index_lognum,$page,$pageurl);?>
    		</ol>
    	</div>
	</div>

	<!-- 友情链接 -->
	<?php if(blog_tool_ishome()):?>
		<div class="friends">
			<h4 class="friend_h4">友情链接<a class="friend_sub" href="<?php echo BLOG_URL;?>friends.html">申请友链 <i class="fa fa-location-arrow"></i></a></h4><?php pages_links();?></article>
		</div>
	<?php endif;?>

</div>


<?php
 include View::getView('footer');
?>