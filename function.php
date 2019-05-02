<?php
/*
* 主题自定义扩展功能实现
* author: DYBOY
*/

if(isset($_GET['qqnum'])){
    if($_GET['qqnum']){
        header("Content-type: text/json; charset=UTF-8;API-FROM:DYBOY.CN;"); 
        echo trim(@file_get_contents('https://api.top15.cn/qqinfo/?qq='.intval($_GET['qqnum'])));
        exit(0);
    }
}

// 返回Gravtar头像
function myGravatar($email,$role='' ,$s = 50, $d = 'wavatar', $g = 'g') {
    if(!empty($role)){ return $role; }
    $hash = md5($email);
    $avatar = "https://secure.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
    return $avatar;
}

//获取QQ头像
function getqqtx($qq){
    $url="//q.qlogo.cn/headimg_dl?dst_uin=$qq&spec=3";
    return $url;
}

//获取QQ信息
function getqqxx($qq,$role=''){if(!empty($role)){ return $role; }
    $ssud=explode("@",$qq,2);
    if($ssud[1]=='qq.com'){ return getqqtx($ssud[0]); }else{ return MyGravatar($qq,$role); }
}

//URL规范化-SEO
function gf_url($id){
	if ($id){
		echo '<link rel="canonical" href="'.Url::log($id)."\" />";
	}
}

//文章摘要回复可见输出处理 配合回复可见插件 下载地址：https://blog.dyboy.cn/develop/33.html
function tool_purecontent($content, $strlen = null){
    $content = str_replace('阅读全文&gt;&gt;', '', $content);
    $content = str_replace('&nbsp;','',$content); 
    $content = preg_replace("/[\r\n\t ]/i","",$content);
    $content = preg_replace("/\[cv\](.*)\[\/cv\]/Uims", '|*********此处内容回复可见*********|', strip_tags($content));
    $content = preg_replace("/\[lv\](.*)\[\/lv\]/Uims", '|******此处内容VIP用户登陆可见******|', strip_tags($content));
    if ($strlen) { $content = subString($content, 0,$strlen); }
    return $content;
}

//页面源码压缩
function em_compress_html_main($buffer){
    $initial=strlen($buffer);
    $buffer=explode("<!--dy-html-->", $buffer);
    $count=count ($buffer);
    for ($i = 0; $i <= $count; $i++){
        if (stristr($buffer[$i], '<!--dy-html no compression-->')){
            $buffer[$i]=(str_replace("<!--dy-html no compression-->", " ", $buffer[$i]));
        }else{
            $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
            $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
            $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
            $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
            while (stristr($buffer[$i], '  '))
            {
            $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
            }
        }
        $buffer_out.=$buffer[$i];
    }
    $final=strlen($buffer_out);
    $savings=($initial-$final)/$initial*100;
    $savings=round($savings, 2);
    $buffer_out.="<!--Tips:压缩前: $initial bytes; 压缩后: $final bytes; 节约：$savings% -->";
    return $buffer_out;
}

//内容页面PRE禁止压缩
function unCompress($content){
    if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
        $content = '<!--dy-html--><!--dy-html no compression-->'.$content;
        $content.= '<!--dy-html no compression--><!--dy-html-->';
    }
    return $content;
}

//获取系统随机图片URL
function getrandomim(){ 
	$imgsrc = TEMPLATE_URL."images/random/".rand(1,35).".jpg";
	return $imgsrc; 
}

//获取文章中图片数量
function pic_num($content){
    if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
        $imgNum = count($img[1]);
    }else{
        $imgNum = "0";
    }
    return $imgNum;
}

//从文章中获取缩略图URL
function GetThumFromContent($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = '';
    if(!empty($img[1])){ $imgsrc = $img[1][0]; } else{  $imgsrc =getrandomim(); }
    return $imgsrc;
}


//翻页
function sheli_fy($count,$perlogs,$page,$url,$anchor=''){
    $pnums = @ceil($count / $perlogs);
    $page = @min($pnums,$page);
    $prepg=$page-1;                
    $nextpg=($page==$pnums ? 0 : $page+1); 
    $urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
    $re = "";
    if($pnums<=1) return false;
    if($page!=1) $re .=" <li><a href=\"$urlHome$anchor\">首页</a></li> "; 
    if($prepg) $re .=" <li class='prev'><a href=\"$url$prepg$anchor\" >←</a></li> ";
    for ($i = $page-1;$i <= $page+1 && $i <= $pnums; $i++){
        if ($i > 0){
            if ($i == $page){$re .= " <li class='current'><a href='javascript:;'>$i</a></li> ";
        }
        elseif($i == 1){
            $re .= " <li><a href=\"$urlHome$anchor\">$i</a></li> ";
            }
            else{
                $re .= " <li><a href=\"$url$i$anchor\">$i</a></li> ";}
            }
    }
    if($nextpg) $re .=" <li class='next'><a href=\"$url$nextpg$anchor\" class='nextpages'>→</a></li> "; 
    if($page!=$pnums) $re.=" <a href=\"$url$pnums$anchor\" title=\"尾页\">尾页</a>";
    return $re;
}

//输出作者名字
function author_name($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    echo '<a title="了解更多" href="'.BLOG_URL.'resume.html" >'.htmlspecialchars($author)."</a>";
}

//输出作者信息
function author_des($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $des = $user_cache[$uid]['des'];
    if($des) return $des;
    else{
        return "这个家伙很懒什么也没说...";
    }
}

//输出作者头像URL
function author_head($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    if($user_cache[$uid]['photo']['src']){
        $head_url = BLOG_URL.$user_cache[$uid]['photo']['src'];
    }
    else{
        $head_url = BLOG_URL."content/templates/dy_monkey/img/noAvator.jpg";
    }
    return $head_url;
}

//相关文章推荐
function related_logs($logData = []) {
    $related_log_type = 'sort';
    $related_log_sort = 'rand';
    $related_log_num = '5'; 
    $related_inrss = 'y'; 
    
    global $value;
    $DB = MySqlii::getInstance();
    $CACHE = Cache::getInstance();
    extract($logData);
    if($value)
    {
        global $abstract;
    }
    $sql = "SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog'";
    if($related_log_type == 'tag')
    {
        $log_cache_tags = $CACHE->readCache('logtags');
        $Tag_Model = new Tag_Model();
        $related_log_id_str = '0';
        foreach($log_cache_tags[$logid] as $key => $val)
        {
            $related_log_id_str .= ','.$Tag_Model->getTagByName($val['tagname']);
        }
        $sql .= " AND gid!=$logid AND gid IN ($related_log_id_str)";
    }else{
        $sql .= " AND gid!=$logid AND sortid=$sortid";
    }
    switch ($related_log_sort)
    {
        case 'views_desc':
        {
            $sql .= " ORDER BY views DESC";
            break;
        }
        case 'views_asc':
        {
            $sql .= " ORDER BY views ASC";
            break;
        }
        case 'comnum_desc':
        {
            $sql .= " ORDER BY comnum DESC";
            break;
        }
        case 'comnum_asc':
        {
            $sql .= " ORDER BY comnum ASC";
            break;
        }
        case 'rand':
        {
            $sql .= " ORDER BY rand()";
            break;
        }
    }
    $sql .= " LIMIT 0,$related_log_num";
    $related_logs = [];
    $query = $DB->query($sql);
    while($row = $DB->fetch_array($query)){
        array_push($related_logs, $row);
    }
    $out = '';
    if(!empty($related_logs))
    {
        $out.='<div class="title"><h3 style="font-size: 1.2em;color: #444;border-left: 5px solid #fc8d0c;margin-right: 15px;padding-left: 5px;margin-bottom: 8px;" class="menuexcept">相关推荐</h3>';
        foreach($related_logs as $val)
        {
            $out .= '<div class="single-item"><div class="image" style="background-image:url('.GetThumFromContent($val['content']).')"><a href="'.Url::log($val['gid']).'"><div class="overlay"></div><div class="title"><span> '.$val['views'].'人看过</span><h3 class="menuexcept">'.$val['title'].'</h3></div></a></div> </div>';
        }
        $out.='</div>';
    }
    if(!empty($value['content']))
    {
        if($related_inrss == 'y')
        {
            $abstract .= $out;
        }
    }else{
        echo $out;
    }
}

//判断当前页面是否为首页
function blog_tool_ishome(){
    $self_domain = explode("/",BLOG_URL);
    if (($_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"] == $self_domain[2]."/index.php") || ($_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"] == $self_domain[2]."/") || ($_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]== $self_domain[2]."/?_pjax=%23dyblog_pjax")){
        return TRUE;
    } else {
        return FALSE;
    }
}

//page-tags：搜索页面输出热门标签
function page_tags(){
    global $CACHE;
    $tag_cache = $CACHE->readCache('tags');
    $count = 0;
    $hot_num = 5;       // 可修改，定义变量
    foreach ($tag_cache as $value){
        if($value['usenum'] < $hot_num) {continue;}
        echo '<a href="'.Url::tag($value['tagurl']).'" target="_blank" class="bg-white"><i class="fa fa-tags"></i> '.$value['tagname'].'('.$value['usenum'].')</a>';
        $count += 1;
        if($count == 30){
            break;
        }
    }
}

//输出友情链接: 友情链接单页输出友情链接
function friends_links(){
    global $CACHE; 
    $link_cache = $CACHE->readCache('link');
    echo '<ul class="flinks" style="text-align: center; display: inline-block; width: 100%; border: 1px solid #ececec; padding: 10px;">';
    foreach ($link_cache as $value) {
        echo '<li title="'.$value['des'].'" style="float: left;width: 33%;"><span><img src="https://api.top15.cn/favicon/?url='.$value['url'].'" width="16px" height="16px" style="vertical-align: middle;display: inline-block;padding-right: 2px;"><a href="'.$value['url'].'" target="_blank">'.$value['link'].'</a></span></li>';
    }
    echo '</ul><p></p>';
}

// 输出微语
function admin_talk(){
    $db = Mysqlii::getInstance();
    $result = $db->query("SELECT * FROM ".DB_PREFIX."twitter ORDER BY id DESC LIMIT 0,5");
    while($row = $result->fetch_array()){
        echo '<li><a href="/t">'.$row['content'].'</a></li>';
    }
}
?>