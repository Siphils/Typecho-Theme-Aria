<?php if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Utils.php
 * 部分工具
 *
 * @author     Siphils
 * @version    since 1.9.0
 */

class Utils
{
    /**
     * 输出博客以及主题部分配置信息为前端提供接口
     *
     * @return void
     */
    public static function AriaConfig()
    {
        $AriaConfig = Helper::options()->AriaConfig;
        $options = Helper::options();

        $showHitokoto = self::isEnabled('showHitokoto', 'AriaConfig');
        $showQRCode = self::isEnabled('showQRCode', 'AriaConfig');
        $showReward = $options->rewardConfig ? true : false;
        $enablePjax = self::isEnabled('enablePjax', 'AriaConfig');
        $enableAjaxComment = self::isEnabled('enableAjaxComment', 'AriaConfig');
        $enableFancybox = self::isEnabled('enableFancybox', 'AriaConfig');
        $enableLazyload = self::isEnabled('enableLazyload', 'AriaConfig');
        $enableMathJax = self::isEnabled('enableMathJax', 'AriaConfig');
        $OwOJson = $options->OwOJson ? $options->OwOJson : $options->themeUrl . "/assets/OwO/OwO.json";
        $hitokotoOrigin = $options->hitokotoOrigin ? $options->hitokotoOrigin : 'https://v1.hitokoto.cn/?c=a&encode=text';
        $gravatarPrefix = __TYPECHO_GRAVATAR_PREFIX__;

        $THEME_CONFIG = json_encode((object) array(
            "THEME_VERSION" => ARIA_VERSION,
            "SITE_URL" => rtrim($options->siteUrl, "/"),
            "THEME_URL" => $options->themeUrl,
            "SHOW_HITOKOTO" => $showHitokoto,
            "SHOW_QRCODE" => $showQRCode,
            "SHOW_REWARD" => $showReward,
            "ENABLE_PJAX" => $enablePjax,
            "ENABLE_AJAX_COMMENT" => $enableAjaxComment,
            "ENABLE_FANCYBOX" => $enableFancybox,
            "ENABLE_LAZYLOAD" => $enableLazyload,
            "ENABLE_MATHJAX" => $enableMathJax,
            "OWO_JSON" => $OwOJson,
            "HITOKOTO_ORIGIN" => $hitokotoOrigin,
            "GRAVATAR_PREFIX" => $gravatarPrefix,
        ));

        echo "<script>window.THEME_CONFIG = $THEME_CONFIG</script>\n";
    }

    /**
     * 获取第一管理员的头像
     *
     * @param int $size 尺寸
     * @return void
     */
    public static function getAdminAvatar($size = 50)
    {
        $options = Helper::options();
        $db = Typecho_Db::get();
        $mail = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', 1))['mail'];
        $avatarUrl = $options->avatarUrl;
        $param = __TYPECHO_GRAVATAR_PREFIX__ . md5(strtolower(trim($mail))) . '?d=mp&r=g&s=' . $size;
        echo $avatarUrl ? $avatarUrl : $param;
    }

    /**
     * 获取所有页面的信息，根据slug构造键值对数组
     *
     * @return array|bool
     */
    public static function getPagesInfo()
    {
        //$widget = ypecho_Widget::widget('Widget_Abstract_Contents');
        $db = Typecho_Db::get();

        $query = $db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.type = ?', 'page')
            ->where('table.contents.password IS NULL');

        $_contents = $db->fetchAll($query);

        if ($_contents) {
            $contents = array();

            foreach ($_contents as $val) {
                $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
                $slug = $val['slug'];
                $title = $val['title'];
                $permalink = $val['permalink'];
                $contents[$slug] = array(
                    'title' => $title,
                    'permarlink' => $permalink,
                );
            }
            return $contents;
        } else {
            //查询失败
            return false;
        }
    }

    /**
     * 返回主题设置中某项开关的开启/关闭状态
     *
     * @param string $item 项目名
     * @param string $config 设置名
     *
     * @return bool
     */
    public static function isEnabled($item, $config)
    {
        $config = Helper::options()->$config;
        $status = !empty($config) && in_array($item, $config) ? true : false;
        return $status;
    }

    /**
     * 将部分主题配置中的string数据转换为array或键值对
     *
     * @param string $item 设置名
     * @param bool $mode 转换类型
     *
     * @return array|bool
     */
    public static function convertConfigData($item, $mode)
    {
        $options = Helper::options();
        //根据$item获取对应的设置中的string数据
        $data = $options->$item ? $options->$item : false;
        $content = null;
        if (!$data) {
            //不存在对应的设置名或内容为空
            $content = false;
        } else {
            if ($mode) {
                //转换为数组
                $content = json_decode("[" . $data . "]", true);
            } else {
                //转换为键值对
                $content = json_decode(trim("{" . $data . "}"), true);
            }
        }
        return $content;
    }

    /**
     * 获取背景图片
     *
     * @return void
     */
    public static function getBackground()
    {
        $options = Helper::options();

        if ($options->backgroundUrl) {
            $str = $options->backgroundUrl;
            $imgs = trim($str);
            $urls = explode("\r\n", $imgs);
            $n = mt_rand(0, count($urls) - 1);
            echo $urls[$n];
        } else {
            $options->themeUrl('assets/img/background.jpg');
        }
    }

    /**
     * 获取随机默认缩略图
     */
    public static function getThumbnail()
    {
        $options = Helper::options();
        if ($options->defaultThumbnail) {
            $str = $options->defaultThumbnail;
            $imgs = trim($str);
            $urls = explode("\r\n", $imgs);
            $n = mt_rand(0, count($urls) - 1);
            return $urls[$n];
        } else {
            return $options->themeUrl . '/assets/img/thumbnail.jpg';
        }
    }

    /**
     * 输出底部组件
     *
     * @return void
     */
    public static function getFooterWidget()
    {
        $data = self::convertConfigData('footerWidget', true);
        $opt = Helper::options();
        $html = '<span><a href="' . $opt->siteUrl . '"> • ' . $opt->title . '</a></span><span><a href="http:\/\/www.typecho.org" title="念念不忘，必有回响。" target="_blank"> • Typecho</a></span><span><a href="https:\/\/eriri.ink/archives/Typecho-Theme-Aria.html" title="Typecho-Theme-Aria Ver ' . ARIA_VERSION . ' by Siphils" target="_blank"> • Aria</a></span>';

        if (!$data) {
            echo $html;
            return;
        }
        foreach ($data as $val) {
            $tmp = $val;
            if ((array) $tmp) {
                $href = array_key_exists('href', $val) ? 'href="' . $val['href'] . '"' : "";
                $title = array_key_exists('title', $val) ? 'title="' . $val['title'] . '"' : "";
                $target = array_key_exists('target', $val) ? 'target="' . $val['target'] . '"' : "";
                $text = array_key_exists('text', $val) ? $val['text'] : "";
                $html .= "<span><a $href $title $target> • $text</span>";
            }
        }
        echo $html;
    }

    /**
     * 根据配置的JSON数据输出导航栏
     * @param int $mode
     * @param string $slugs
     * 
     * @return void
     */
    public static function showNav($mode, $slugs)
    {
        $data = self::convertConfigData('navConfig', true);
        if (!$data) {
            return;
        }

        $text = null;
        $href = null;
        $icon = null;
        $target = null;
        $sub = null;

        if ($data) {
            $html = '';
            if ($mode) {
                foreach ($data as $v) {
                    $text = array_key_exists('text', $v) ? $v['text'] : "";
                    $href = array_key_exists('href', $v) ? 'href="' . $v['href'] . '"' : "";
                    $icon = array_key_exists('icon', $v) ? 'class="' . $v['icon'] . '"' : "";
                    $target = array_key_exists('target', $v) ? 'target="' . $v['target'] . '"' : "";
                    $slug = (array_key_exists('slug', $v) && $slugs && array_key_exists($v['slug'], $slugs)) ? $slugs[$v['slug']] : false;
                    if ($slug) {
                        $href = 'href="' . $slug['permarlink'] . '"';
                        $text = $slug['title'];
                    }
                    $html .= "<li class=\"nav-right-item\"><a $href $target><i $icon></i>$text</a>";
                    if (array_key_exists('sub', $v)) {
                        $html .= '<ul class="nav-sub">';
                        foreach ($v['sub'] as $_k => $_v) {
                            $text = array_key_exists('text', $_v) ? $_v['text'] : "";
                            $href = array_key_exists('href', $_v) ? 'href="' . $_v['href'] . '"' : "";
                            $icon = array_key_exists('icon', $_v) ? 'class="' . $_v['icon'] . '"' : "";
                            $target = array_key_exists('target', $_v) ? 'target="' . $_v['target'] . '"' : "";
                            $slug = (array_key_exists('slug', $_v) && $slugs && array_key_exists($_v['slug'], $slugs)) ? $slugs[$_v['slug']] : false;
                            if ($slug) {
                                $href = 'href="' . $slug['permarlink'] . '"';
                                $text = $slug['title'];
                            }
                            $html .= "<li class=\"sub-item\"><a $href $target><i $icon></i>$text</a></li>";
                        }
                        $html .= "</ul>";
                    }
                    $html .= "</li>";
                }
            } else {
                foreach ($data as $v) {
                    $text = array_key_exists('text', $v) ? $v['text'] : "";
                    $href = array_key_exists('href', $v) ? 'href="' . $v['href'] . '"' : "";
                    $icon = array_key_exists('icon', $v) ? 'class="' . $v['icon'] . '"' : "";
                    $target = array_key_exists('target', $v) ? 'target="' . $v['target'] . '"' : "";
                    $slug = (array_key_exists('slug', $v) && $slugs && array_key_exists($v['slug'], $slugs)) ? $slugs[$v['slug']] : false;
                    if ($slug) {
                        $href = 'href="' . $slug['permarlink'] . '"';
                        $text = $slug['title'];
                    }
                    $html .= "<li class=\"nav-vertical-item\"><a $href $target><i $icon></i>  $text</a>";
                    if (array_key_exists('sub', $v)) {
                        $html .= '<ul class="nav-vertical-sub">';
                        foreach ($v['sub'] as $_k => $_v) {
                            $text = array_key_exists('text', $_v) ? $_v['text'] : "";
                            $href = array_key_exists('href', $_v) ? 'href="' . $_v['href'] . '"' : "";
                            $icon = array_key_exists('icon', $_v) ? 'class="' . $_v['icon'] . '"' : "";
                            $target = array_key_exists('target', $_v) ? 'target="' . $_v['target'] . '"' : "";
                            $slug = (array_key_exists('slug', $_v) && $slugs && array_key_exists($_v['slug'], $slugs)) ? $slugs[$_v['slug']] : false;
                            if ($slug) {
                                $href = 'href="' . $slug['permarlink'] . '"';
                                $text = $slug['title'];
                            }
                            $html .= "<li class=\"vertical-sub-item\"><a $href $target><i $icon></i>  $text</a></li>";
                        }
                        $html .= "</ul>";
                    }
                    $html .= "</li>";
                }
            }

            echo $html;
        }
        //转换失败
        echo false;
    }
}
