<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Comments.php
 * 评论相关组件
 *
 * @author     Siphils
 * @version    since 1.9.0
 */

class Comments
{
    /**
     * 由$coid查询评论相关内容
     * 返回未解析评论内容以及链接
     *
     * @param int $coid
     *
     * @return array
     */

    public static function getInfo($coid)
    {
        $db = Typecho_Db::get();
        $options = Helper::options();
        $contents = Typecho_Widget::widget('Widget_Abstract_Contents');
        $row = $db->fetchRow($db->select('cid, type, author, text')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
        if (empty($row)) {
            return 'Comment not found!';
        }

        $cid = $row['cid'];
        $select = $db->select('coid, parent')->from('table.comments')->where('cid = ? AND status = ?', $cid, 'approved')->order('coid');
        if ($options->commentsShowCommentOnly) {
            $select->where('type = ?', 'comment');
        }

        $comments = $db->fetchAll($select);
        if ($options->commentsOrder == 'DESC') {
            $comments = array_reverse($comments);
        }

        foreach ($comments as $key => $val) {
            $array[$val['coid']] = $val['parent'];
        }

        $i = $coid;
        while ($i != 0) {
            $break = $i;
            $i = $array[$i];
        }
        $count = 0;
        foreach ($array as $key => $val) {
            if ($val == 0) {
                $count++;
            }

            if ($key == $break) {
                break;
            }

        }
        $parentContent = $contents->push($db->fetchRow($contents->select()->where('table.contents.cid = ?', $cid)));
        $permalink = rtrim($parentContent['permalink'], '/');
        $page = ($options->commentsPageBreak) ? '/comment-page-' . ceil($count / $options->commentsPageSize) : (substr($permalink, -5, 5) == '.html' ? '' : '/');
        return array("author" => $row['author'], "text" => $row['text'], "href" => "{$permalink}{$page}#{$row['type']}-{$coid}");
    }

    /**
     * 评论内容解析
     *
     * @param mixed $content
     * @param mixed $widget
     * @param mixed $lastContent
     *
     * @return mixed
     */

    public static function parse($content, $widget, $lastContent)
    {
        $content = empty($lastContent) ? $content : $lastContent;
        if ($widget instanceof Widget_Abstract) {
            $content = self::commentAt($content, $widget);
            $content = self::parseHljsWrap($content, $widget);
        }

        return $content;
    }

    /**
     * 评论回复加上@
     *
     * @param mixed $content
     * @param mixed $widget
     *
     * @return mixed
     */

    public static function commentAt($content, $widget)
    {
        $coid = $widget->coid;
        $db = Typecho_Db::get();
        $prow = $db->fetchRow($db->select('parent')->from('table.comments')->where('coid = ?', $coid));
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('author')->from('table.comments')
                    ->where('coid = ?', $parent));
            $author = $arow['author'];
            $tag = '<a href="#comment-' . $parent . '">@' . $author . '</a><br>';
            return $tag . $content;
        } else {
            return $content;
        }
    }

    /**
     * 给<pre>增加class
     *
     * @param mixed $content
     * @param mixed $widget
     *
     * @return mixed
     */

    public static function parseHljsWrap($content, $widget)
    {
        $preg = "/<pre>/";
        $replace = '<pre class="highlight-wrap">';

        $content = preg_replace($preg, $replace, $content);
        
        return $content;
    }

    /**
     * 评论回复/取消回复按钮JS代码
     *
     * @param mixed $archive
     *
     * @return void
     */

    public static function commentReply($archive)
    {
        if ($archive->allow('comment')) {
            echo "<script type=\"text/javascript\">(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom('$archive->respondId'),input=this.dom('comment-parent'),form='form'==response.tagName?response:response.getElementsByTagName('form')[0],textarea=response.getElementsByTagName('textarea')[0];if(null==input){input=this.create('input',{'type':'hidden','name':'parent','id':'comment-parent'});form.appendChild(input)}input.setAttribute('value',coid);if(null==this.dom('comment-form-place-holder')){var holder=this.create('div',{'id':'comment-form-place-holder'});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.dom('cancel-comment-reply-link').style.display='';if(null!=textarea&&'text'==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom('$archive->respondId'),holder=this.dom('comment-form-place-holder'),input=this.dom('comment-parent');if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.dom('cancel-comment-reply-link').style.display='none';holder.parentNode.insertBefore(response,holder);return false}}})();</script>";
        }
    }

    /**
     * 解析评论user-agent
     *
     * @param string $ua
     *
     * @return string
     */

    public static function parseUseragent($ua)
    {
        // 解析操作系统
        $htmlTag = "";
        $os = null;
        $fontClass = null;
        if (preg_match('/Windows NT 6.0/i', $ua)) {$os = "Windows Vista";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 6.1/i', $ua)) {$os = "Windows 7";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 6.2/i', $ua)) {$os = "Windows 8";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 6.3/i', $ua)) {$os = "Windows 8.1";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 10.0/i', $ua)) {$os = "Windows 10";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 5.1/i', $ua)) {$os = "Windows XP";
            $fontClass = "windows";} elseif (preg_match('/Windows NT 5.2/i', $ua) && preg_match('/Win64/i', $ua)) {$os = "Windows XP 64 bit";
            $fontClass = "windows";} elseif (preg_match('/Android ([0-9.]+)/i', $ua, $matches)) {$os = "Android " . $matches[1];
            $fontClass = "android";} elseif (preg_match('/iPhone OS ([_0-9]+)/i', $ua, $matches)) {$os = 'iPhone ' . $matches[1];
            $fontClass = "iphone";} elseif (preg_match('/iPad/i', $ua)) {$os = "iPad";
            $fontClass = "ipad";} elseif (preg_match('/Mac OS X ([_0-9]+)/i', $ua, $matches)) {$os = 'Mac OS X ' . $matches[1];
            $fontClass = "mac";} elseif (preg_match('/Gentoo/i', $ua)) {$os = 'Gentoo Linux';
            $fontClass = "gentoo";} elseif (preg_match('/Ubuntu/i', $ua)) {$os = 'Ubuntu Linux';
            $fontClass = "ubuntu";} elseif (preg_match('/Debian/i', $ua)) {$os = 'Debian Linux';
            $fontClass = "debian";} elseif (preg_match('/X11; FreeBSD/i', $ua)) {$os = 'FreeBSD';
            $fontClass = "freebsd";} elseif (preg_match('/X11; Linux/i', $ua)) {$os = 'Linux';
            $fontClass = "linux";} else { $os = 'unknown os';
            $fontClass = "os";}

        $htmlTag = "<i class=\"iconfont icon-aria-$fontClass\"></i>";

        $browser = null;
        //解析浏览器
        if (preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Sogou browser';
            $fontClass = "sogou";} elseif (preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = '360 browser ';
            $fontClass = "360";} elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Maxthon ';
            $fontClass = "maxthon";} elseif (preg_match('#Edge( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Edge ';
            $fontClass = "edge";} elseif (preg_match('#MicroMessenger/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Wechat ';
            $fontClass = "wechat";} elseif (preg_match('#QQ/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'QQ Mobile ';
            $fontClass = "qq";} elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chrome ';
            $fontClass = "chrome";} elseif (preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chrome ';
            $fontClass = "chrome";} elseif (preg_match('#Chromium/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chromium ';
            $fontClass = "chrome";} elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Safari ';
            $fontClass = "safari";} elseif (preg_match('#opera mini#i', $ua)) {
            preg_match('#Opera/([a-zA-Z0-9.]+)#i', $ua, $matches);
            $browser = 'Opera Mini ';
            $fontClass = "opera";
        } elseif (preg_match('#Opera.([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Opera ';
            $fontClass = "opera";} elseif (preg_match('#QQBrowser ([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'QQ browser ';
            $fontClass = "qqbrowser";} elseif (preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'UCWEB ';
            $fontClass = "uc";} elseif (preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Internet Explorer ';
            $fontClass = "ie";} elseif (preg_match('#Trident/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Internet Explorer 11';
            $fontClass = "ie";} elseif (preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Firefox ';
            $fontClass = "firefox";} else { $browser = 'unknown br';
            $fontClass = 'browser';}

        $htmlTag .= "&nbsp;";
        $htmlTag .= "<i class=\"iconfont icon-aria-$fontClass\"></i>";
        return $htmlTag;
    }

}
