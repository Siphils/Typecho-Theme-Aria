<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Contents.php
 * 文章/页面相关组件
 *
 * @author     Siphils
 * @version    since 1.9.0
 */

class Contents
{
    /**
     * 从数据库查询上/下篇文章内容信息
     * 返回内容包括文章缩略、标题、链接
     *
     * @param bool $mode 查询上或下篇
     * @param mixed $archive
     *
     * @return array|bool
     */

    public static function getNextPrev($mode, $archive)
    {
        $options = Helper::options();
        $db = Typecho_Db::get();
        //数据准备
        $where = null;
        $sorted = null;
        $name = 'thumbnail';
        $thumbnail = 'str_value';
        //$mode为true查询上文，false查询下文
        if ($mode) {
            $where = 'table.contents.created < ?';
            $sorted = Typecho_Db::SORT_DESC;
        } else {
            $where = 'table.contents.created > ?';
            $sorted = Typecho_Db::SORT_ASC;
        }

        $query = $db->select()->from('table.contents')
            ->where($where, $archive->created)
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.type = ?', $archive->type)
            ->where('table.contents.password IS NULL')
            ->order('table.contents.created', $sorted)
            ->limit(1);
        $content = $db->fetchRow($query);
        $result = null;
        if ($content) {
            $content = $archive->filter($content);
            $title = $content['title'];
            $link = $content['permalink'];

            $query = $db->select()->from('table.fields')
                ->where('table.fields.cid = ?', $content['cid'])
                ->where('table.fields.name = ?', $name)
                ->limit(1);

            $content = $db->fetchRow($query);
            if ($content) {
                $img = $content[$thumbnail] ? $content[$thumbnail] : Utils::getThumbnail();
            } else {
                $img = Utils::getThumbnail();
            }

            $result = array('img' => $img, 'title' => $title, 'link' => $link);
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * 输出上下文内容，包括缩略图、标题、链接
     *
     * @param mixed $archive
     *
     * @return void
     */
    public static function theNextPrev($archive)
    {
        $html = null;

        $prevResult = self::getNextPrev(true, $archive);
        $nextResult = self::getNextPrev(false, $archive);

        if (!$prevResult && !$nextResult) {
            //第一篇文章，什么也不需要输出
            $html .= '';
        } else if (!$prevResult) {
            //没有上一篇了
            //只显示下一篇
            $html .= '<div class="post-footer-box half next" style="width:100%"><a href="' . $nextResult["link"] . '" rel="next"><div class="post-footer-thumbnail"><img src="' . $nextResult["img"] . '"></div><span class="post-footer-label">Next Post</span><div class="post-footer-title"><h3>' . $nextResult["title"] . '</h3></div></a></div>';
        } else if (!$nextResult) {
            //没有下一篇
            //只显示上一篇
            $html .= '<div class="post-footer-box half previous" style="width:100%"><a href="' . $prevResult["link"] . '" rel="prev"><div class="post-footer-thumbnail"><img src="' . $prevResult["img"] . '"></div><span class="post-footer-label">Previous Post</span><div class="post-footer-title"><h3>' . $prevResult["title"] . '</h3></div></a></div>';
        } else {
            $html .= '<div class="post-footer-box half previous"><a href="' . $prevResult["link"] . '" rel="prev"><div class="post-footer-thumbnail"><img src="' . $prevResult["img"] . '"></div><span class="post-footer-label">Previous Post</span><div class="post-footer-title"><h3>' . $prevResult["title"] . '</h3></div></a></div>';
            $html .= '<div class="post-footer-box half next"><a href="' . $nextResult["link"] . '" rel="next"><div class="post-footer-thumbnail"><img src="' . $nextResult["img"] . '"></div><span class="post-footer-label">Next Post</span><div class="post-footer-title"><h3>' . $nextResult["title"] . '</h3></div></a></div>';
        }

        echo $html;
    }

    /**
     * 输出文章浏览次数
     *
     * @param mixed $archive
     *
     * @return void
     */
    public static function getPostView($archive)
    {
        $cid = $archive->cid;
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();

        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
            echo 0;
            return;
        }

        $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));

        if ($archive->is('single')) {
            $views = Typecho_Cookie::get('extend_contents_views');
            if (empty($views)) {
                $views = array();
            } else {
                $views = explode(',', $views);
            }
            if (!in_array($cid, $views)) {
                $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
                array_push($views, $cid);
                $views = implode(',', $views);
                Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
            }
        }
        echo $row['views'];
    }

    /**
     * 输出文章打赏二维码和本文链接二维码
     *
     * @param mixed $archive
     *
     * @return void
     */
    public static function getPostOther($archive)
    {
        $html = '<div class="post-other">';
        $AriaConfig = Helper::options()->AriaConfig;
        $rewardConfig = Utils::convertConfigData('rewardConfig', false);
        $showQRCode = Utils::isEnabled('showQRCode', 'AriaConfig');

        if ($rewardConfig) {
            $html .= '<div class="post-reward"><a href="javascript:void(0);" onclick="togglePostOther(this);" no-pjax ><i class="iconfont icon-aria-reward"></i></a>
                <ul>';
            foreach ($rewardConfig as $key => $data) {
                $html .= '<li><img no-lazyload src="' . $data . '">' . $key . '</li>';
            }
            $html .= "</ul></div>";
        }
        if ($showQRCode) {
            $url = Helper::options()->themeUrl . '/lib/getQRCode.php?url=';
            $html .= '<div class="post-qrcode"><a href="javascript:void(0);" onclick="togglePostOther(this);" no-pjax ><i class="iconfont icon-aria-qrcode"></i></a><div><span>手机上阅读<img no-lazyload src="' . $url . $archive->permalink . '"></span></div></div>';
        }
        $html .= "</div>";
        echo $html;
    }

    /**
     * 输出归档页时间轴
     *
     * @param mixed $_POST
     *
     * @return void
     */
    public static function pageArchives($post)
    {
        static $lastY = null,
        $lastM = null;
        $t = $post->created;
        $href = $post->permalink;
        $title = $post->title;
        $y = date('Y', $t) . ' 年';
        $m = date('m', $t) . ' 月';
        $d = date('d', $t) . ' 日';
        $t_href = Helper::options()->siteUrl . date('Y/m', $t);
        $html = '';
        if ($lastY == date('Y', $t) || $lastY == null) {
            if ($lastM != date('m', $t)) {
                $lastM = date('m', $t);
                $html .= "<div class=\"timeline-ym timeline-item\"><a href=\"$t_href\" target=\"_blank\">$y $m</a></div>";
            }
        } else {
            $lastY = date('Y', $t);
        }
        $html .= '<div class="timeline-box"><div class="timeline-post timeline-item">' . '<a href="' . $href . '" target="_blank">' . $title . '</a><span class="timeline-post-time">' . $d . '</span></div></div>';
        echo $html;
    }

    /**
     * 解析所有文章内容
     *
     * @param mixed $content
     * @param mixed $widget
     * @param mixed $lastResult
     *
     * @return mixed
     */

    public static function parse($content, $widget, $lastContent)
    {
        $content = empty($lastContent) ? $content : $lastContent;
        if ($widget instanceof Widget_Abstract) {
            add_shortcode('link-item', 'Contents::shortcode_linkitem');
            add_shortcode('link-box', 'Contents::shortcode_linkbox');
            $content = self::parseHljsWrap($content, $widget);

            $content = do_shortcode($content);
        }

        return $content;
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
        $preg = "/<pre.*?>/";
        $replace = '<pre class="highlight-wrap">';

        $content = preg_replace($preg, $replace, $content);

        return $content;
    }

    /**
     * [link-item]短代码
     *
     * @param $atts
     * @param $content
     *
     * @return mixed
     */

    public static function shortcode_linkitem($atts, $content = '')
    {
        $args = shortcode_atts(array(
            'href' => '',
            'title' => '',
            'img' => '',
            'name' => '',
        ), $atts);
        $href = $args['href'] ? 'href="' . $args['href'] . '"' : "";
        return '<a ' . $href . 'title="' . $args['title'] . '" target="_blank"><div class="link-item"><img class="link-avatar" src="' . $args['img'] . '"><span class="link-name">' . $args['name'] . '</span></div></a>';
    }

    /**
     * [link-box]短代码
     *
     * @param $atts
     * @param $content
     *
     * @return mixed
     */

    public static function shortcode_linkbox($atts, $content = '')
    {
        return '<div class="link-box">' . do_shortcode($content) . '</div>';
    }
    //[link-item]
}
