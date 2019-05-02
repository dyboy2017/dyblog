<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="banner-bg-header">
    <h1 class="banner-title">微语</h1> 
    <h4 class="banner-sub-title">看看站长 <?php echo author_name(1); ?> 最近在干嘛</h4> 
</div>
<div class="main-content index-page clearfix">
    <div class="cleft">
        <ul class="twiter">
        <?php 
            foreach($tws as $val):
                $author = $user_cache[$val['author']]['name'];
                $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                            BLOG_URL . 'admin/views/images/avatar.jpg' : 
                            BLOG_URL . $user_cache[$val['author']]['avatar'];
                $tid = intval($val['id']);
                $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
            ?>

            <li class="twiter_list">
                <section class="comments">
                    <article class="comment">
                        <a class="comment-img" href="#non">
                            <img src="<?php echo $avatar; ?>" width="50" height="50">
                        </a> 
                        <div class="comment-body">
                            <div class="text">
                                <p><?php echo $val['t'].'<br/>'.$img;?></p>
                                <p class="twiter_info">
                                    <i class="fa fa-user"></i>
                                    <span class="twiter_author"><?php echo $author; ?></span>
                                    <time class="twiter_time"><i class="fa fa-clock-o"></i> <?php echo $val['date'];?></time>
                                </p>
                            </div>
                        </div>
                    </article>
                </section>

            </li>
        <?php endforeach;?>
    </ul>
    <div class="twwiter">
        <div class="page comment-page">
            <?php echo $pageurl;?>
        </div>
    </div>
    </div>
</div>
<?php
 include View::getView('footer');
?>