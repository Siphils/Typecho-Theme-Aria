<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, NULL, _t('站点头像'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个头像,需要带上http(s)://'));

    $defaultThumbnail = new Typecho_Widget_Helper_Form_Element_Text('defaultThumbnail', NULL, NULL, _t('默认文章缩略图'), _t('填入默认的缩略图地址，未设置缩略图字段时调用此地址，需要带http(s)://'));
    $backgroundUrl = new Typecho_Widget_Helper_Form_Element_Textarea('backgroundUrl', NULL, NULL, _t('首页背景图片'),_t('需要输入http(s)://，每一行写一个URL，随机展示'));
    $OwOJson = new Typecho_Widget_Helper_Form_Element_Text('OwOJson', NULL, NULL, _t('OwO'), _t('OwO表情JSON文件的URL'));
    $googleAnalysis = new Typecho_Widget_Helper_Form_Element_Textarea('googleAnalysis', NULL, NULL, _t('谷歌统计'), _t('谷歌统计代码'));
    $baiduAnalysis = new Typecho_Widget_Helper_Form_Element_Textarea('baiduAnalysis', NULL, NULL, _t('百度统计'), _t('百度统计代码'));

    $form->addInput($avatarUrl);
    $form->addInput($defaultThumbnail);
    $form->addInput($backgroundUrl);
    $form->addInput($OwOJson);
    $form->addInput($googleAnalysis);
    $form->addInput($baiduAnalysis);
}

function getPostView($archive){
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
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

function themeFields($layout) {
    $thumbnail = new Typecho_Widget_Helper_Form_Element_Text('thumbnail', NULL, NULL, _t('文章/页面缩略图Url'), _t('需要带上http(s)://， 默认会调用主题img目录下的postThumnail.jpg'));
    $previewContent = new Typecho_Widget_Helper_Form_Element_Text('previewContent', NULL, NULL, _t('文章预览内容'), _t('设置文章的预览内容，留空自动截取文章前300个字。'));
    
    $layout->addItem($thumbnail);
    $layout->addItem($previewContent);
}

/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

function getPrevOrNextThumbnail($archive, $type = "prev") {
            $content = $archive->db->fetchRow($archive->select()->where('table.contents.created > ? AND table.contents.created < ?',
            $archive->created, $archive->options->gmtTime)
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.type = ?', $archive->type)
            ->where('table.contents.password IS NULL')
            ->order('table.contents.created', Typecho_Db::SORT_ASC)
            ->limit(1));

        if ($content) {
            $content = $archive->filter($content);
            $default = array(
                'title' => NULL,
                'tagClass' => NULL
            );
            $custom = array_merge($default, $custom);
            extract($custom);

            $linkText = empty($title) ? $content['title'] : $title;
            $linkClass = empty($tagClass) ? '' : 'class="' . $tagClass . '" ';
            $link = '<a ' . $linkClass . 'href="' . $content['permalink'] . '" title="' . $content['title'] . '">' . $linkText . '</a>';

            echo $content['cid'];
        } else {
            echo $default;
        }
}

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

function printCommentContent($coid) {
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

function printCommentAddr($ip) {
    //echo $ip.''.gettype($ip);
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


function archives($day, $_month, $year, $title, $time, $link) {
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
        '09' => 'Sept', 
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
            $html.= '<div class="timeline-month timeline-item">' . $month . '</div>';
        } else {
            //存在就直接输出标题
            $html.= '<div class="timeline-box"><div class="timeline-post timeline-item">' . '<a href="' . $link . '">' . $title . '</a><span class="timeline-post-time">'. $time .'</span></div></div>';
        }
    }
    echo $html;
};

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

function getCommentAvatar($email,$author='') {
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
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=128&r=g";
    }
    else {
        $url=Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/comment-avatar.jpg';
    }
    $tag.='src="'.$url.'">';
    echo $tag;
}

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