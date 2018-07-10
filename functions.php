<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once('UserAgent/Browser.php');
require_once('UserAgent/OperatingSystem.php');

function themeConfig($form) {

    echo <<<EOF
EOF;

    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, NULL, _t('站点头像'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个头像,需要带上http(s)://'));
    $form->addInput($avatarUrl);

    $defaultThumbnail = new Typecho_Widget_Helper_Form_Element_Textarea('defaultThumbnail', NULL, NULL, _t('默认文章缩略图'), _t('填入默认的缩略图地址，未设置缩略图字段时调用此地址，需要带http(s)://，每一行写一个URL，随机展示'));
    $form->addInput($defaultThumbnail);

    $backgroundUrl = new Typecho_Widget_Helper_Form_Element_Textarea('backgroundUrl', NULL, NULL, _t('首页背景图片'),_t('需要输入http(s)://，每一行写一个URL，随机展示'));
    $form->addInput($backgroundUrl);

    $OwOJson = new Typecho_Widget_Helper_Form_Element_Text('OwOJson', NULL, NULL, _t('OwO'), _t('OwO表情JSON文件的URL'));
    $form->addInput($OwOJson);

    $statistics = new Typecho_Widget_Helper_Form_Element_Textarea('statistics', NULL, NULL, _t('统计代码'), _t('在此填入统计的代码'));
    $form->addInput($statistics);

    $userFooter = new Typecho_Widget_Helper_Form_Element_Textarea('userFooter', NULL, NULL, _t('自定义底部'), _t('填入底部额外的信息，加在copyright之前'));
    $form->addInput($userFooter);

    $navConfig = new Typecho_Widget_Helper_Form_Element_Textarea('navConfig', NULL, 
        '"archives":{
            "text":"归档",
            "link":"#"
        },
        "guestbook":{
            "text":"留言",
            "link":"#"
        },
        "friends":{
            "text":"朋友",
            "link":"#"
        },
        "about":{
            "text":"关于",
            "link":"#"
        }'
    , _t('导航栏配置'), _t('输入导航栏的配置信息'));
    $form->addInput($navConfig);

    $AriaConfig = new Typecho_Widget_Helper_Form_Element_Checkbox('AriaConfig',
        array(
            'showHitokoto' => '页面底部显示一言',
            'showLoadTime' => '页面底部显示加载时间(Processed in xxx second(s).)',
            'usePjax' => '开启PJAX(需要关闭评论反垃圾保护)',
            'useFancybox' => '文章内使用<a href="http://fancyapps.com">fancybox</a>(友情链接页面不会使用fancybox)',
        ),
        array('showHitokoto','showLoadTime','usePjax','useFancybox'), '其他设置'
    );
    $form->addInput($AriaConfig->multiMode());
}


function themeFields($layout) {
    $thumbnail = new Typecho_Widget_Helper_Form_Element_Text('thumbnail', NULL, NULL, _t('文章/页面缩略图Url'), _t('需要带上http(s)://， 默认会调用主题img目录下的thumnail.jpg'));
    $previewContent = new Typecho_Widget_Helper_Form_Element_Text('previewContent', NULL, NULL, _t('文章预览内容'), _t('设置文章的预览内容，留空自动截取文章前300个字。'));
    
    $layout->addItem($thumbnail);
    $layout->addItem($previewContent);
}

function themeInit($archive) {
    $AriaConfig = Typecho_Widget::widget('Widget_Options')->AriaConfig;

    /** 友情链接页面 */
    if($archive->is('page','friends'))
        $archive->content = pageFriends($archive);

    /** 文章内容处理img标签 fanybox */
    if(!empty($AriaConfig) && in_array('useFancybox', $AriaConfig)) {
        if(!$archive->is('page','friends')) {
            $pattern = '/<img(.*?)src="(.*?)"(.*?)>/';
            $replacement = '<a href="$2" data-caption="'.$archive->title.'" no-pjax class="fancyBox">$0</a>';
            $archive->content = preg_replace($pattern, $replacement, $archive->content);
        }
    }
}

function AriaConfig() {
    $AriaConfig = Typecho_Widget::widget('Widget_Options')->AriaConfig;
    //print_r($AriaConfig);
    $showHitokoto = (!empty($AriaConfig) && in_array('showHitokoto', $AriaConfig)) ? 1 : 0;
    $showLoadTime = (!empty($AriaConfig) && in_array('showLoadTime', $AriaConfig)) ? 1 : 0;
    $usePjax = (!empty($AriaConfig) && in_array('usePjax', $AriaConfig)) ? 1 : 0;
    $useFancybox = (!empty($AriaConfig) && in_array('useFancybox', $AriaConfig)) ? 1 : 0;
    echo '<script>
        window.THEME_CONFIG = {
            SHOW_HITOKOTO : '.$showHitokoto.',
            SHOW_LOADTIME : '.$showLoadTime.',
            USE_PJAX : '.$usePjax.',
            USE_FANCYBOX : '.$useFancybox.'
        }
    </script>';
}


/**
 * 根据配置的JSON数据输出导航栏
 * @param $mode 
 *  {
        "archives":{
            "text":"归档",
            "link":"https://xxx.com"
        },
        "guestbook":{
            "text":"留言",
            "link":"https://xxx.com"
        }
    }
    目前可配置的有'archives','guestbook','friends','about'
 */
function showNav($mode) {
    //$archive->widget('Widget_Contents_Page_List')->to($pages);
    //print_r($pages->stack[0]['slug']);
    //$options = Typecho_Widget::widget('Widget_Options')->navConfig;
    //$options = Typecho_Widget::widget('Widget_Options');
    //$data = $options->navConfig ? $options->navConfig : "";
    //if($data) 
    //    $data = json_decode(trim('{'.$data.'}'),true);
    $data = convertToJSON('navConfig',0);
    if($data) {
        $html = '';
        if($mode) {
            //输出水平导航栏
            if(array_key_exists('archives', $data)) {
                //输出‘归档’
                $html.='<li class="nav-right-item"><a href="'.$data['archives']['link'].'"><i class="iconfont">&#xe612;</i>'.$data['archives']['text'].'</a></li>';
            }
            if(array_key_exists('guestbook', $data)) {
                //输出‘留言’
                $html.='<li class="nav-right-item"><a href="'.$data['guestbook']['link'].'"><i class="iconfont">&#xe6ac;</i>'.$data['guestbook']['text'].'</a></li>';
            }
            if(array_key_exists('friends', $data)) {
                //输出‘朋友’
                $html.='<li class="nav-right-item"><a href="'.$data['friends']['link'].'"><i class="iconfont">&#xe65e;</i>'.$data['friends']['text'].'</a></li>';
            }
            if(array_key_exists('about', $data)) {
                //输出‘关于’
                $html.='<li class="nav-right-item"><a href="'.$data['about']['link'].'"><i class="iconfont">&#xe648;</i>'.$data['about']['text'].'</a></li>';
            }
        }
        else {
            //输出垂直导航栏
            if(array_key_exists('archives', $data)) {
                //输出‘归档’
                $html.='<a href="'.$data['archives']['link'].'"><i class="iconfont">&#xe612;</i>'.$data['archives']['text'].'</a>';
            }
            if(array_key_exists('guestbook', $data)) {
                //输出‘留言’
                $html.='<a href="'.$data['guestbook']['link'].'"><i class="iconfont">&#xe6ac;</i>'.$data['guestbook']['text'].'</a>';
            }
            if(array_key_exists('friends', $data)) {
                //输出‘朋友’
                $html.='<a href="'.$data['friends']['link'].'"><i class="iconfont">&#xe65e;</i>'.$data['friends']['text'].'</a>';
            }
            if(array_key_exists('about', $data)) {
                //输出‘关于’
                $html.='<a href="'.$data['about']['link'].'"><i class="iconfont">&#xe648;</i>'.$data['about']['text'].'</a>';
            }
        }
        
        echo $html;
    }
    //转换失败
    echo false;
}

/**
 * 文章浏览次数
 */
function getPostView($archive){
    $cid  = $archive->cid;
    $db   = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
        if(!in_array($cid,$views)){
            $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}
/**
 * 根据$coid获取链接
 */
function getPermalinkFromCoid($coid) {
    $db = Typecho_Db::get();
    $options = Typecho_Widget::widget('Widget_Options');
    $contents = Typecho_Widget::widget('Widget_Abstract_Contents');
    $row = $db->fetchRow($db->select('cid, type, author, text')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
    if (empty($row)) return 'Comment not found!';
    $cid = $row['cid'];
    $select = $db->select('coid, parent')->from('table.comments')->where('cid = ? AND status = ?', $cid, 'approved')->order('coid');
    if ($options->commentsShowCommentOnly) $select->where('type = ?', 'comment');
    $comments = $db->fetchAll($select);
    if ($options->commentsOrder == 'DESC') $comments = array_reverse($comments);
    foreach ($comments as $key => $val) $array[$val['coid']] = $val['parent'];
    $i = $coid;
    while ($i != 0) {
        $break = $i;
        $i = $array[$i];
    }
    $count = 0;
    foreach ($array as $key => $val) {
        if ($val == 0) $count++;
        if ($key == $break) break;
    }
    $parentContent = $contents->push($db->fetchRow($contents->select()->where('table.contents.cid = ?', $cid)));
    $permalink = rtrim($parentContent['permalink'], '/');
    $page = ($options->commentsPageBreak) ? '/comment-page-' . ceil($count / $options->commentsPageSize) : (substr($permalink, -5, 5) == '.html' ? '' : '/');
    return array("author" => $row['author'], "text" => $row['text'], "href" => "{$permalink}{$page}#{$row['type']}-{$coid}");
} 

/**
 * page-archives.php 归档页输出时光轴
 */
function pageArchives($day, $_month, $year, $title, $time, $link) {
    static $date = array();
    $__month = array(
        '01' => 'Jan', 
        '02' => 'Feb', 
        '03' => 'Mar', 
        '04' => 'Apr', 
        '05' => 'May', 
        '06' => 'June', 
        '07' => 'July', 
        '08' => 'Aug', 
        '09' => 'Sep', 
        '10' => 'Oct', 
        '11' => 'Nov', 
        '12' => 'Dec');
    $month=$__month[$_month];
    $html = '';
    if (!array_key_exists($year, $date)) {
        //不存在这个年份，年份放入数组,且放入这个月份
        $date[$year] = array($month);
        //打印年份以及月份标签
        $html.= '<div class="timeline-year timeline-item">' . $year . '</div>' . '<div class="timeline-month timeline-item">' . $month . '</div><div class="timeline-box"><div class="timeline-post timeline-item">' . '<a href="' . $link . '">' . $title . '</a><span class="timeline-post-time">'. $time .'</span></div></div>';
    } else {
        //如果年份存在，检查是否存在对应月份
        if (!in_array($month, $date[$year])) {
            //不存在就放入并且输出标签
            array_push($date[$year], $month);
            $html.= '<div class="timeline-month timeline-item">' . $month . '</div><div class="timeline-box"><div class="timeline-post timeline-item">' . '<a href="' . $link . '">' . $title . '</a><span class="timeline-post-time">'. $time .'</span></div></div>';
        } else {
            //存在就直接输出标题
            $html.= '<div class="timeline-box"><div class="timeline-post timeline-item">' . '<a href="' . $link . '">' . $title . '</a><span class="timeline-post-time">'. $time .'</span></div></div>';
        }
    }
    echo $html;
};

/**
 * page-friends.php 友情链接页面输出
 */

function pageFriends($archive) {
    $string=$archive->content;
    $pattern=array(
        '/\[link-box\]/',
        '/\[\/link-box\]/',
        '/\[link-item href=(.*?)(\s)title=(.*?)(\s)img=(.*?)(\s)name=(.*?)\]/'
    );
    $replacement=array(
        '<div class="link-box">',
        '</div><!--end .link-box-->',
        '<a href=$1 title=$3 target="_blank"><div class="link-item"><img class="link-avatar" src=$5><span class="link-name">$7</span></div></a>');
    return preg_replace($pattern, $replacement, $string);
}

/**
 * 获取背景图片
 */
function getBackground() {
    $options = Typecho_Widget::widget('Widget_Options');
    if($options->backgroundUrl) {
        $str = $options->backgroundUrl;
        $imgs = trim($str);
        $urls = explode("\r\n", $imgs);
        $n = mt_rand(0, count($urls)-1);
        echo $urls[$n];
    }
    else
        $options->themeUrl('img/background.jpg');
}

/**
 * 获取随机默认缩略图
 */
function getThumbnail() {
    $options = Typecho_Widget::widget('Widget_Options');
    if($options->defaultThumbnail) {
        $str = $options->defaultThumbnail;
        $imgs = trim($str);
        $urls = explode("\r\n", $imgs);
        $n = mt_rand(0, count($urls)-1);
        return $urls[$n];
    }
    else
        return $options->themeUrl.'/img/thumbnail.jpg';
}

/**
 * 显示上一篇详情
 * @return array
 */
function thePrev($widget)
{
    $name='thumbnail';
    $thumbnail='str_value';
    $options = Typecho_Widget::widget('Widget_Options');
    $db = Typecho_Db::get();
    $query = $db->select()->from('table.contents')
    ->where('table.contents.created < ?', $widget->created)
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.type = ?', $widget->type)
    ->where('table.contents.password IS NULL')
    ->order('table.contents.created', Typecho_Db::SORT_DESC)
    ->limit(1);
    $content = $db->fetchRow($query);
    if($content) {
        $content=$widget->filter($content);
        $title=$content['title'];
        $link=$content['permalink'];

        $query=$db->select()->from('table.fields')
        ->where('table.fields.cid = ?', $content['cid'])
        ->where('table.fields.name = ?', $name)
        ->limit(1);

        $content = $db->fetchRow($query);
        if($content) {
            $img = $content[$thumbnail] ? $content[$thumbnail] : getThumbnail();
        }
        else {
            $img = getThumbnail();
        }
    }
    else {
        $img = getThumbnail();
        $title='没有了';
        $link='#';
    }
    $result=array('img'=>$img,'title'=>$title,'link'=>$link);
    return $result;
}

/**
 * 显示下一篇详情
 * @return array
 */
function theNext($widget)
{
    $name='thumbnail';
    $thumbnail='str_value';
    $options = Typecho_Widget::widget('Widget_Options');
    $db = Typecho_Db::get();
    $query = $db->select()->from('table.contents')
    ->where('table.contents.created > ?', $widget->created)
    ->where('table.contents.status = ?', 'publish')
    ->where('table.contents.type = ?', $widget->type)
    ->where('table.contents.password IS NULL')
    ->order('table.contents.created', Typecho_Db::SORT_ASC)
    ->limit(1);
    $content = $db->fetchRow($query);
    if($content) {
        $content=$widget->filter($content);
        $title=$content['title'];
        $link=$content['permalink'];

        $query=$db->select()->from('table.fields')
        ->where('table.fields.cid = ?', $content['cid'])
        ->where('table.fields.name = ?', $name)
        ->limit(1);
        $content = $db->fetchRow($query);
        if($content) {
            $img = $content[$thumbnail] ? $content[$thumbnail] : getThumbnail();
        }
        else {
            $img = getThumbnail();
        }
    }
    else {
        $img = getThumbnail();
        $title='没有了';
        $link='#';
    }
    $result=array('img'=>$img,'title'=>$title,'link'=>$link);
    return $result;
}

//

/**
 * 输出评论回复内容，配合 commentAtContent($coid)一起使用
 */
function showCommentContent($coid) {
    $db = Typecho_Db::get();
    $result=$db->fetchRow($db->select('text')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
    $text=$result['text'];
    $atStr = commentAtContent($coid);
    $_content=Markdown::convert($text);
    //<p>
    if($atStr!==''){
        $content = substr_replace($_content, $atStr,0,3);
        echo $content;
    }
    else
    {
        $content=$_content;
        echo $content;
    }
}

/**
 * 评论回复加@
 */
function commentAtContent($coid) {
    $db = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                                     ->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href   = '<p><a href="#comment-' . $parent . '">@' . $author . '</a><br>';
        return $href;
    } else {
        return '';
    }
}

/**
 * 评论地址显示
 */
function showCommentAddr($ip) {
    if ((!$ip) || (strchr($ip, '127.0.')) || (strchr($ip, '192.168')) || ($ip === '::1')) {
        //这部分为真则返回‘火星’类似的地址
        echo "火星";
    } else {
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
        $content = file_get_contents($url);
        $data = json_decode($content, true);
        if ($data['code'] == '0') {
            $addr = '';
            foreach ($data['data'] as $key => $value) {
                if ($key === 'ip' || $key === 'country_id' || $key === 'area_id' || $key === 'region_id' || $key === 'city_id' || $key === 'county_id' || $key === 'isp_id' || !$value || $value == "XX") continue;
                else $addr.= ' ' . $value;
            }
            echo $addr;
        } else {
            echo '火星';
        }
    }
}

/**
 * 获取评论者头像
 */

function commentGravatar( $email, $author , $s = 80 ) {
    $d = 'mp'; $r = 'g';
    $size=$s;
    $url = 'https://cn.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    echo '<img class="comment-avatar" src="' . $url . '" alt="' . 
    $author . '" width="' . $size . '" height="' . $size . '" />';
}


/**
 * 评论判断gravatar是否存在
 */

function judgeGravatar($email,$author='') {
    $hash = md5(strtolower(trim($email)));
    $uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
    $headers = @get_headers($uri);
    if (preg_match('/404/', $headers[0])) {
        $has_valid_avatar = FALSE;
    } else {
        $has_valid_avatar = TRUE;
    }
    $tag='<img class="avatar" alt="'.$author.'" ';
    if($has_valid_avatar) {
        $url = 'https://cn.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=128&r=g";
    }
    else {
        $url=Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/comment-avatar.jpg';
    }
    $tag.='src="'.$url.'">';
    echo $tag;
}

/**
 * 输出评论回复/取消回复按钮
 */

function commentReply($archive) {
    echo "<script type=\"text/javascript\">
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('" . $archive->respondId . "'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }
            var inputs=document.getElementsByClassName('comment-input');
            console.log(inputs);
            for(var i=0;i<inputs.length;++i)
            {
                console.log(inputs[i].getElementsByTagName('label'));
                inputs[i].getElementsByTagName('label')[0].style.left='18px';
                inputs[i].getElementsByTagName('label')[0].style.bottom='22px';
            }
            return false;
        },

        cancelReply : function () {
            var response = this.dom('{$archive->respondId}'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            var inputs=document.getElementsByClassName('comment-input');
            console.log(inputs);
            for(var i=0;i<inputs.length;++i)
            {
                console.log(inputs[i].getElementsByTagName('label'));
                inputs[i].getElementsByTagName('label')[0].style.left='8px';
                inputs[i].getElementsByTagName('label')[0].style.bottom='12px';
            }
            return false;
        }
    };
})();
</script>
";
}

/**
 * 显示评论者的ua信息,直接输出html标签
 * echo <i class="iconfont"></i>
 */
function showCommentUA($userAgent)
{
    $browser=useragent_detect_browser::analyze($userAgent);
    $os=useragent_detect_os::analyze($userAgent);
    $html='';
    //匹配浏览器
    if(preg_match('/QQ/i', $browser['name'])) {
        $html.='<i class="iconfont">&#xe608;';
    }
    else if(preg_match('/UC/i', $browser['name'])) {
        $html.='<i class="iconfont">&#xe64a;';
    }
    else if(preg_match('/Internet Explorer/i', $browser['name'])) {
        $html.='<i class="iconfont">&#xe646;';
    }
    else if(preg_match('/Safari/i', $browser['name'])) {
        $html.='<i class="iconfont">&#xe6ef;';
    }
    else if(preg_match('/Opera/i', $browser['name'])) {
        $html.='<i class="iconfont">&#xe6d4;';
    }
    else if(preg_match('/Firefox/i', $browser['name'])) {
        $html.='<i class="iconfont">&#xe67f;';
    }
    else if($browser['name']==='Google Chrome') {
        $html.='<i class="iconfont">&#xe691;';
    }
    else {
        $html.='<i class="iconfont">&#xe602;';
    }
    //匹配os
    $html.=" ";
    if($os['name']==='Fedora') {
        $html.='&#xe655;';
    }
    else if(preg_match('/Android|ADR /i', $os['name'])) {
        $html.="&#xe632;";
    }
    else if(preg_match('/Ubuntu/i',$os['name'])) {
        $html.='&#xe681;';
    }
    else if($os['name']==='Debian GNU/Linux') {
        $html.='&#xe679;';
    }
    else if($os['name']==='CentOS') {
        $html.='&#xe676;';
    }
    else if(preg_match('/Windows|Win(NT|32|95|98|16)|ZuneWP7|WPDesktop/i', $os['name'])) {
        $html.='&#xe86f;';
    }
    else if(preg_match('/Mac/i', $os['name'])||$os['name']==='iOS') {
        $html.='&#xe605;';
    }
    else if($os['name']==='Arch Linux') {
        $html.='&#xe600;';
    }
    else 
        $html.='&#xe613;';
    $html.="</i> ";
    echo $html;
}

/**
 * 将主题配置中textarea内的string转换为JSON数据
 * 用作部分配置
 */
function convertToJSON($item, $mode) {
    $options = Typecho_Widget::widget('Widget_Options');
    $data = $options->$item ? $options->$item : "";
    if($data) {
        if($mode)
            $json = json_decode(trim("[".$data."]"),true);
        else
            $json = json_decode(trim("{".$data."}"),true);
        return $json;

    }
    else 
        return false;
}

/**
 * 页面加载耗时
 */
function timer_start() {
    global $timestart;
    $mtime = explode( ' ', microtime() );
    $timestart = $mtime[1] + $mtime[0];
    return true;
}
timer_start();
 
function timer_stop( $display = 0, $precision = 3 ) {
    global $timestart, $timeend;
    $mtime = explode( ' ', microtime() );
    $timeend = $mtime[1] + $mtime[0];
    $timetotal = $timeend - $timestart;
    $r = number_format( $timetotal, $precision );
    if ( $display )
    echo $r;
    return $r;
}