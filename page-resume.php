<?php 
/**
 * 页面模板： 站长简介，别名：resume
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<div class="banner-bg-header">
    <h1 class="banner-title">简介</h1> 
    <h4 class="banner-sub-title">站长公开简历</h4> 
</div>

<article class="main-content page-page" style="padding: 30px 25px 40px;">
    <div class="post-content" itemprop="articleBody">
    	<?php echo unCompress($log_content); ?>
    </div>
</article>

<?php
 include View::getView('footer');
?>