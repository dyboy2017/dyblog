<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div style="clear:both;"></div>

<footer id="footer" class="footer"> 
	<div class="footer-social"> 
		<div class="footer-container clearfix"> 
			<div class="social-list">
				<a class="social" target="_blank" href="/rss.php" title="RSS"><i class="fa fa-rss"></i> 订阅</a>
				<a class="social" target="_blank" href="https://blog.dyboy.cn/go/?url=<?php echo $web_config['github_url']?>" title="Github"><i class="fa fa-github"></i> 仓库</a>
				<a class="social" target="_blank" href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $web_config['admin_qq'];?>&site=qq&menu=yes" title="QQ"><i class="fa fa-qq"></i> QQ</a>
				<a class="social" target="_blank" href="/resume.html" title="Profile"><i class="fa fa-user"> 简介</i></a>
				<a class="social" target="_blank" rel="nofollow" href="<?php echo $web_config['email_me'];?>" title="Email"><i class="fa fa-paper-plane"></i> 邮件</a>
			</div> 
		</div>
	</div>
	<div class="footer-meta" style="text-align:center;"> 
		Powered by <a href="http://www.emlog.net" title="Emlog系统强力驱动">Emlog</a> | Theme：<span>DYBLOG</span> by <a href="https://blog.dyboy.cn">DYBOY</a>
	<br/><a href="http://www.miibeian.gov.cn" rel="nofollow" target="_blank"><?php echo $icp; ?></a> <br/> <?php echo $footer_info; ?>
		<?php doAction('index_footer'); ?>
	</div> 
</footer>

</div>
<!-- end #dyblog -->

<!-- 自动目录 -->


<!-- 到顶部 -->
<div id="scroll-to-top" title="返回顶部" class="headroom show" style="z-index: 9">
	<i class="fa fa-chevron-up"></i>
</div>

<!-- pjax 动画 -->
<div class="loading">
	<div id="loader"></div>
</div>

<!-- JavaScript -->
<script src="//libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="//cdn.bootcss.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="//api.top15.cn/static/script/jquery.prettify.js"></script>
<script src="<?php echo TEMPLATE_URL?>script/main.js?v1.0.3"></script>
</body>
</html>
<?php $html=ob_get_contents();ob_get_clean();echo em_compress_html_main($html); ?>