<?php 
/**
 * 页面模版 ： 搜索，别名设置为：search
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="banner-bg-header">
    <h1 class="banner-title">搜索</h1> 
    <h4 class="banner-sub-title">找找小破站有没有你想要的？</h4> 
</div>

<div class="main-content page-page" style="padding: 80px 25px 40px;">
    <div class="search-page">
        <form class="search-form" method="GET" action="<?php echo BLOG_URL;?>?search" role="search">
            <span class="search-box clearfix">
                <input type="text" id="keyword" class="input" name="keyword" required="true" placeholder="Search..." maxlength="30" autocomplete="off" autofocus>
                <a href="" class="spsubmit">
                    <i class="icon-search"></i>
                </a>
            </span>
        </form>
        <div class="search-tags">
            <p>👇 推荐热门的搜索关键词~</p>
            <?php page_tags();?>
            <div class="search-tags-hr bg-deepgrey"></div>
        </div>
    </div>
</div>


<?php
 include View::getView('footer');
?>