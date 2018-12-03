<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

define('ARIA_VERSION', '1.8.3');
define('__TYPECHO_GRAVATAR_PREFIX__', Helper::options()->gravatarPrefix ? Helper::options()->gravatarPrefix : 'https://cn.gravatar.com/avatar/');

require_once 'lib/Shortcode.php';

function themeConfig($form)
{
    echo '<script>var ARIA_VERSION = "' . ARIA_VERSION . '";</script>';
    echo <<<EOF
    <style>
    form{position:relative;max-width:100%}
    form input:not([type]),form input[type="date"],form input[type="datetime-local"],form input[type="email"],form input[type="number"],form input[type="password"],form input[type="search"],form input[type="tel"],form input[type="time"],form input[type="text"],form input[type="file"],form input[type="url"]{font-family:'Lato','Helvetica Neue',Arial,Helvetica,sans-serif;margin:0em;outline:none;-webkit-appearance:none;tap-highlight-color:rgba(255,255,255,0);line-height:1.21428571em;padding:0.67857143em 1em;font-size:1em;background:#FFFFFF;border:1px solid rgba(34,36,38,0.15);color:rgba(0,0,0,0.87);border-radius:0.28571429rem;-webkit-box-shadow:0em 0em 0em 0em transparent inset;box-shadow:0em 0em 0em 0em transparent inset;-webkit-transition:color 0.5s ease,border-color 0.5s ease;transition:color 0.5s ease,border-color 0.5s ease}
    form textarea{margin:0em;-webkit-appearance:none;tap-highlight-color:rgba(255,255,255,0);padding:0.78571429em 1em;background:#FFFFFF;border:1px solid rgba(34,36,38,0.15);outline:none;color:rgba(0,0,0,0.87);border-radius:0.28571429rem;-webkit-box-shadow:0em 0em 0em 0em transparent inset;box-shadow:0em 0em 0em 0em transparent inset;-webkit-transition:color 0.1s ease,border-color 0.5s ease;transition:color 0.1s ease,border-color 0.5s ease;font-size:1em;line-height:1.2857;resize:vertical}
    form textarea:not([rows]){height:12em;min-height:8em;max-height:24em}
    form textarea,form input[type="checkbox"]{vertical-align:top}
    form textarea:focus,form input:focus{color:rgba(0,0,0,0.95);border-color:#85B7D9;border-radius:0.28571429rem;background:#FFFFFF;-webkit-box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset;box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset;-webkit-appearance:none}
    .tip{max-width:100%;position:relative;min-height:1em;margin:0 10px;background:#F8F8F9;padding:1em 1.5em;line-height:1.4285em;color:rgba(0,0,0,0.87);-webkit-transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,box-shadow 0.1s ease,-webkit-box-shadow 0.1s ease;border-radius:0.28571429rem;-webkit-box-shadow:0 0 0 1px rgba(34,36,38,.22) inset,0 2px 4px 0 rgba(34,36,38,.12),0 2px 10px 0 rgba(34,36,38,.15);box-shadow:0 0 0 1px rgba(34,36,38,.22) inset,0 2px 4px 0 rgba(34,36,38,.12),0 2px 10px 0 rgba(34,36,38,.15)}
    .tip-header{text-align:center;margin:10px auto 20px auto;color:#444;text-shadow:0 0 2px #c2c2c2}
    .current-ver{position:relative;border-color:#b21e1e!important;background-color:#DB2828!important;color:#FFF!important;left:-37px;padding-left:1rem;border-bottom-right-radius:5px;padding-right:1.2em}
    .current-ver:after{position:absolute;content:'';top:100%;left:0;background-color:transparent!important;border-style:solid;border-width:0 1.2em 1.2em 0;border-color:transparent;border-right-color:inherit;width:0;height:0}
    .btn.primary{cursor:pointer;display:inline-block;background:#E0E1E2 none;color:rgba(0,0,0,0.6);padding:0 1.5em;border-radius:0.28571429rem;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;outline:none;-webkit-transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,background 0.5s ease,-webkit-box-shadow 0.5s ease;transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,background 0.5s ease,-webkit-box-shadow 0.5s ease;transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,box-shadow 0.5s ease,background 0.5s ease;transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,box-shadow 0.5s ease,background 0.5s ease,-webkit-box-shadow 0.5s ease;-webkit-tap-highlight-color:transparent}
    .btn.primary:hover{background-color:#CACBCD;color:rgba(0,0,0,0.8)}
    .btn.primary[type="submit"]{position:fixed;right:100px;bottom:100px}
    .btn.confirm{background-color:#95f798!important}
    .btn.alert{background-color:#fa9492 !important}
    i.confirm{position:absolute;left:.5em}
    i.confirm:after,i.confirm:before{content:"";background:green;display:block;position:absolute;width:3px;border-radius:3px}
    i.confirm:after{height:6px;transform:rotate(-45deg);top:9px;left:6px}
    i.confirm:before{height:11px;transform:rotate(45deg);top:5px;left:10px}
    i.alert{position:absolute;left:.5em}
    i.alert:after,i.alert:before{content:"";background:red;display:block;position:absolute;width:3px;border-radius:3px;left:9px}
    i.alert:after{height:3px;top:14px}
    i.alert:before{height:8px;top:4px}
    .multiline{position:relative;display:inline-block;-webkit-backface-visibility:hidden;backface-visibility:hidden;outline:none;vertical-align:baseline;font-style:normal;min-height:17px;font-size:1rem;line-height:17px;min-width:17px}
    .multiline input[type="checkbox"],.multiline input[type="radio"]{cursor:pointer;position:absolute;top:0px;left:0px;opacity:0 !important;outline:none;z-index:3;width:17px;height:17px}
    .multiline{min-height:1.5rem}
    .multiline input{width:3.5rem;height:1.5rem}
    .multiline .box,.multiline label{min-height:1.5rem;padding-left:4.5rem;color:rgba(0,0,0,0.87)}
    .multiline label{padding-top:0.15em}
    .multiline .box:before,.multiline label:before{cursor:pointer;display:block;position:absolute;content:'';z-index:1;-webkit-transform:none;transform:none;border:none;top:0rem;background:rgba(0,0,0,0.05);-webkit-box-shadow:none;box-shadow:none;width:3.5rem;height:1rem;border-radius:500rem}
    .multiline .box:after,.multiline label:after{cursor:pointer;background:#FFFFFF -webkit-gradient(linear,left top,left bottom,from(transparent),to(rgba(0,0,0,0.05)));background:#FFFFFF -webkit-linear-gradient(transparent,rgba(0,0,0,0.05));background:#FFFFFF linear-gradient(transparent,rgba(0,0,0,0.05));position:absolute;content:'' !important;opacity:1;z-index:2;border:none;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;width:1.2rem;height:1.2rem;top:-.1rem;left:0em;border-radius:500rem;-webkit-transition:background 0.3s ease,left 0.3s ease;transition:background 0.3s ease,left 0.3s ease}
    .multiline input ~ .box:after,.multiline input ~ label:after{left:-0.05rem;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset}
    .multiline input:focus ~ .box:before,.multiline input:focus ~ label:before{background-color:rgba(0,0,0,0.15);border:none}
    .multiline .box:hover::before,.multiline label:hover::before{background-color:rgba(0,0,0,0.15);border:none}
    .multiline input:checked ~ .box,.multiline input:checked ~ label{color:rgba(0,0,0,0.95) !important}
    .multiline input:checked ~ .box:before,.multiline input:checked ~ label:before{background-color:#2185D0 !important}
    .multiline input:checked ~ .box:after,.multiline input:checked ~ label:after{left:2.3rem;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset}
    .multiline input:focus:checked ~ .box,.multiline input:focus:checked ~ label{color:rgba(0,0,0,0.95) !important}
    .multiline input:focus:checked ~ .box:before,.multiline input:focus:checked ~ label:before{background-color:#0d71bb !important}
    </style>
    <script>var r=new XMLHttpRequest();var updating=function(dom){var i=document.createElement("i");i.className="loading";dom.prepend(i)};var checkUpdate=function(dom){updating(dom);try{r.open("GET","https://raw.githubusercontent.com/Siphils/Typecho-Theme-Aria/master/version.json",true);r.send();r.onreadystatechange=function(){if(r.readyState===4){if(r.status==200){try{var d=JSON.parse(r.responseText)}catch(e){}if(d.version==ARIA_VERSION.trim()){dom.className+=" confirm";dom.style.paddingLeft="2em";dom.textContent="已经为最新版";var i=document.createElement("i");i.className="confirm";dom.prepend(i)}else{dom.className+=" alert";dom.style.paddingLeft="2em";dom.textContent="检查到新版本：";var i=document.createElement("i");i.className="alert";dom.prepend(i);if(typeof document.getElementById('update-info')==='undefined'||document.getElementById('update-info')===null){var log=document.createElement('div');log.id='update-info';log.classList.add('tip');log.innerHTML='<ul><li>新版本：'+d.version+'</li><li>更新日志：<a href="'+d.changeLog+'" target="_blank">changeLog</a></li><li>使用帮助：<a href="'+d.wiki+'" target="_blank">Wiki</a></li></ul>';Array.prototype.slice.call(document.getElementsByClassName('tip')).pop().after(log)}}}else{dom.textContent="请求失败！错误码："+r.status}}}}catch(e){dom.textContent="请求失败，请稍后重试！"+e}document.getElementsByTagName("button")[1].onclick=function(e){updating(e.target)}};window.onload=function(){checkUpdate(document.getElementById('check-update'))}</script>
EOF;
    echo '<div class="tip"><span class="current-ver"><strong><code>Ver ' . ARIA_VERSION . '</code></strong></span>
    <div class="tip-header"><h1>Typecho-Theme-Aria</h1></div>
    <p>感谢选择使用 <code>Aria</code> </p>
    <p>查看<a href="https://github.com/Siphils/Typecho-Theme-Aria/wiki">帮助手册</a> <a href="https://github.com/Siphils/Typecho-Theme-Aria/issues">issue</a> <a href="https://github.com/Siphils/Typecho-Theme-Aria/pulls">PR</a></p>
    <p><button id="check-update" onClick="checkUpdate(this);" class="btn primary" style="position:absolute;right:5px;bottom:5px;">检查更新</button></p>
</div>';

    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', null, null, _t('站点头像'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个头像,需要带上http(s)://'));
    $form->addInput($avatarUrl);

    $defaultThumbnail = new Typecho_Widget_Helper_Form_Element_Textarea('defaultThumbnail', null, null, _t('默认文章缩略图'), _t('填入默认的缩略图地址，未设置缩略图字段时调用此地址，需要带http(s)://，每一行写一个URL，随机展示'));
    $form->addInput($defaultThumbnail);

    $backgroundUrl = new Typecho_Widget_Helper_Form_Element_Textarea('backgroundUrl', null, null, _t('首页背景图片'), _t('需要输入http(s)://，每一行写一个URL，随机展示'));
    $form->addInput($backgroundUrl);

    $OwOJson = new Typecho_Widget_Helper_Form_Element_Text('OwOJson', null, null, _t('OwO'), _t('OwO表情JSON文件的URL'));
    $form->addInput($OwOJson);

    $placeholder = new Typecho_Widget_Helper_Form_Element_Text('placeholder', null, null, _t('评论框placeholder'), _t('这里的内容会提前显示在评论框里'));
    $form->addInput($placeholder);

    $statistics = new Typecho_Widget_Helper_Form_Element_Textarea('statistics', null, null, _t('统计代码'), _t('在此填入统计的代码(目前统计代码支持谷歌统计和百度统计的重载，若使用其他统计请关闭PJAX否则得到的统计数据不准确)'));
    $form->addInput($statistics);

    $userHeader = new Typecho_Widget_Helper_Form_Element_Textarea('userHeader', null, null, _t('顶部自定义内容'), _t('会加载在<strong>head</strong>结束标签之前'));
    $form->addInput($userHeader);

    $userFooter = new Typecho_Widget_Helper_Form_Element_Textarea('userFooter', null, null, _t('底部自定义内容'), _t('会加载在<strong>copyright</strong>之前'));
    $form->addInput($userFooter);

    $userScript = new Typecho_Widget_Helper_Form_Element_Textarea('userScript', null, null, _t('自定义JS'), _t('会加载在main.min.js文件加载之前'));
    $form->addInput($userScript);

    $footerWidget = new Typecho_Widget_Helper_Form_Element_Textarea('footerWidget', null, null, _t('底部链接组件'), _t('按照格式填写，以英文逗号分隔'));
    $form->addInput($footerWidget);

    $cpr = new Typecho_Widget_Helper_Form_Element_Text('cpr', null, date('Y'), _t('Copyright年份'), _t('会显示在copyright的年份，例如2018或者2017-2018，留空会默认显示今年年份。<del>当然你想填什么都可以</del>'));
    $form->addInput($cpr);

    $gravatarPrefix = new Typecho_Widget_Helper_Form_Element_Text('gravatarPrefix', null, null, _t('Gravatar头像源'), _t('留空为https://cn.gravatar.com/avatar/，按照前面的url地址格式填写'));
    $form->addInput($gravatarPrefix);

    $navConfig = new Typecho_Widget_Helper_Form_Element_Textarea('navConfig', null,
        '{
            "text":"首页",
            "href":"' . Helper::options()->siteUrl . '",
            "icon":"iconfont icon-aria-home"
        },
        {
            "text":"归档",
            "href":"#",
            "icon":"iconfont icon-aria-archives"
        },
        {
            "text":"留言",
            "href":"#",
            "icon":"iconfont icon-aria-guestbook"
        },
        {
            "text":"朋友",
            "href":"#",
            "icon":"iconfont icon-aria-friends"
        },
        {
            "text":"关于",
            "href":"#",
            "icon":"iconfont icon-aria-about"
        }',
        _t('导航栏配置'),
        _t('输入导航栏的配置信息')
    );
    $form->addInput($navConfig);

    $rewardConfig = new Typecho_Widget_Helper_Form_Element_Textarea('rewardConfig', null, null
        , _t('打赏功能配置'), _t('按照格式填写,留空关闭打赏功能'));
    $form->addInput($rewardConfig);

    $hitokotoOrgin = new Typecho_Widget_Helper_Form_Element_Text('hitokotoOrigin', null, null, _t('自定义「一言」接口地址'), _t('填入接口地址，注意接口需要是只返回一条句子的。如需使用请在开关设置内开启「一言」的显示。留空使用默认接口。如果不知道什么意思留空即可。'));
    $form->addInput($hitokotoOrgin);

    $AriaConfig = new Typecho_Widget_Helper_Form_Element_Checkbox('AriaConfig',
        array(
            'showHitokoto' => '页面底部显示一言',
            'usePjax' => '开启PJAX(需要关闭评论反垃圾保护)',
            'useAjaxComment' => '开启AJAX评论',
            'useFancybox' => '文章/评论图片使用<a href="http://fancyapps.com" target="_blank">fancybox</a>',
            'useLazyload' => '开启图片懒加载<a href="https://appelsiini.net/projects/lazyload" target="_blank">lazyload</a>',
            'showQRCode' => '文章底部显示本文链接二维码',
            'useCommentToMail' => '评论邮件回复按钮（需要配合<a href="https://9sb.org/58">CommentToMail</a>使用）',
            'showCommentUA' => '评论显示UserAgent（显示操作系统和浏览器信息）',
        ),
        array('showHitokoto', 'usePjax', 'useAjaxComment', 'useFancybox', 'useLazyload', 'showQRCode', 'useCommentToMail', 'showCommentUA'),
        '其他设置'
    );
    $form->addInput($AriaConfig->multiMode());

}

function themeFields($layout)
{
    $thumbnail = new Typecho_Widget_Helper_Form_Element_Text('thumbnail', null, null, _t('文章/页面缩略图Url'), _t('需要带上http(s)://， 默认会调用主题img目录下的thumnail.jpg'));
    $previewContent = new Typecho_Widget_Helper_Form_Element_Text('previewContent', null, null, _t('文章预览内容'), _t('设置文章的预览内容，留空自动截取文章前300个字。'));

    $layout->addItem($thumbnail);
    $layout->addItem($previewContent);
}

function themeInit($archive)
{
    Helper::options()->commentsMaxNestingLevels = 999;
    Helper::options()->commentsOrder = 'DESC';
    Helper::options()->commentsAntiSpam = false;
    Helper::options()->commentsPageDisplay = 'first';
    $AriaConfig = Helper::options()->AriaConfig;
    Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Shortcode', 'parse');
    Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Shortcode', 'parse');
}

function AriaConfig()
{
    $AriaConfig = Helper::options()->AriaConfig;
    $options = Helper::options();
    $showHitokoto = isEnabled('showHitokoto', 'AriaConfig');
    $showQRCode = isEnabled('showQRCode', 'AriaConfig');
    $showReward = $options->rewardConfig ? true : false;
    $usePjax = isEnabled('usePjax', 'AriaConfig');
    $useAjaxComment = isEnabled('useAjaxComment', 'AriaConfig');
    $useFancybox = isEnabled('useFancybox', 'AriaConfig');
    $useLazyload = isEnabled('useLazyload', 'AriaConfig');
    $OwOJson = $options->OwOJson ? $options->OwOJson : $options->themeUrl . "/assets/OwO/OwO.json";
    $hitokotoOrigin = $options->hitokotoOrigin ? $options->hitokotoOrigin : 'https://v1.hitokoto.cn/?c=a&encode=text';
    $gravatarPrefix = __TYPECHO_GRAVATAR_PREFIX__;
    $THEME_CONFIG = json_encode((object) array(
        "THEME_VERSION" => ARIA_VERSION,
        "SITE_URL" => rtrim($options->siteUrl,"/"),
        "THEME_URL" => $options->themeUrl,
        "SHOW_HITOKOTO" => $showHitokoto,
        "SHOW_QRCODE" => $showQRCode,
        "SHOW_REWARD" => $showReward,
        "USE_PJAX" => $usePjax,
        "USE_AJAX_COMMENT" => $useAjaxComment,
        "USE_FANCYBOX" => $useFancybox,
        "USE_LAZYLOAD" => $useLazyload,
        "OWO_JSON" => $OwOJson,
        "HITOKOTO_ORIGIN" => $hitokotoOrigin,
        "GRAVATAR_PREFIX" => $gravatarPrefix,
    ));
    echo "<script>window.THEME_CONFIG = $THEME_CONFIG</script>\n";
}

/**
 * 根据配置的JSON数据输出导航栏
 * @param $mode
 */
function showNav($mode,$slugs)
{
    $data = convertConfigData('navConfig', true);
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

/**
 * 输出文章打赏二维码和本文链接二维码
 */
function postOther($archive)
{
    $html = '<div class="post-other">';
    $AriaConfig = Helper::options()->AriaConfig;
    $rewardConfig = convertConfigData('rewardConfig', false);
    $showQRCode = isEnabled('showQRCode', 'AriaConfig');
    if ($rewardConfig) {
        $html .= '<div class="post-reward"><a href="javascript:;" no-pjax ><i class="iconfont icon-aria-reward"></i></a>
            <ul>';
        foreach ($rewardConfig as $key => $data) {
            $html .= '<li><img no-lazyload src="' . $data . '">' . $key . '</li>';
        }
        $html .= "</ul></div>";
    }
    if ($showQRCode) {
        $url = Helper::options()->themeUrl . '/lib/getQRCode.php?url=';
        $html .= '<div class="post-qrcode"><a href="javascript:;" no-pjax ><i class="iconfont icon-aria-qrcode"></i></a><div>手机上阅读<br><br><img no-lazyload src="' . $url . $archive->permalink . '"></div></div>';
    }
    $html .= "</div>";
    echo $html;
}

/**
 * 文章浏览次数
 */
function getPostView($archive)
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
 * 根据$coid获取链接
 */
function getPermalinkFromCoid($coid)
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
 * page-archives.php 归档页输出时光轴
 */
function pageArchives($post)
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
 * 获取背景图片
 */
function getBackground()
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
function getThumbnail()
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
 * 输出底部链接组件
 */

function getfooterWidget()
{
    $data = convertConfigData('footerWidget', true);
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
 * 数据库查询上下文
 * @return mixed
 */

function queryNextPrev($mode, $widget)
{
    $where = $mode ? 'table.contents.created < ?' : 'table.contents.created > ?';
    $sorted = $mode ? Typecho_Db::SORT_DESC : Typecho_Db::SORT_ASC;
    $name = 'thumbnail';
    $thumbnail = 'str_value';
    $options = Helper::options();
    $db = Typecho_Db::get();
    $query = $db->select()->from('table.contents')
        ->where($where, $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', $sorted)
        ->limit(1);
    $content = $db->fetchRow($query);
    if ($content) {
        $content = $widget->filter($content);
        $title = $content['title'];
        $link = $content['permalink'];

        $query = $db->select()->from('table.fields')
            ->where('table.fields.cid = ?', $content['cid'])
            ->where('table.fields.name = ?', $name)
            ->limit(1);

        $content = $db->fetchRow($query);
        if ($content) {
            $img = $content[$thumbnail] ? $content[$thumbnail] : getThumbnail();
        } else {
            $img = getThumbnail();
        }
        $result = array('img' => $img, 'title' => $title, 'link' => $link);
        return $result;
    } else {
        return false;
    }
}

/**
 * 显示上下篇文章详情
 */

function theNextPrev($widget)
{
    $html = '';
    $prevResult = queryNextPrev(true, $widget);
    $nextResult = queryNextPrev(false, $widget);
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
 * 输出评论回复内容，配合 commentAtContent($coid)一起使用
 */
function showCommentContent($comments)
{
    $options = Helper::options();
    $atStr = commentAtContent($comments->coid);
    $text = $comments->content;

    if ($atStr !== '') {
        $text = substr_replace($text, $atStr, 0, 3);
    }
    
    echo $text;
}

/**
 * 评论回复加@
 */
function commentAtContent($coid)
{
    $db = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')->where('coid = ?', $coid));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                ->where('coid = ?', $parent));
        $author = $arow['author'];
        $href = '<p><a href="#comment-' . $parent . '">@' . $author . '</a><br>';
        return $href;
    } else {
        return '';
    }
}

/**
 * 获取评论者头像
 */

function commentGravatar($email, $author, $s = 80)
{
    $d = 'mp';
    $r = 'g';
    $size = $s;
    $url = __TYPECHO_GRAVATAR_PREFIX__;
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    echo '<img class="comment-avatar" src="' . $url . '" alt="' .
        $author . '" width="' . $size . '" height="' . $size . '" />';
}

/**
 * 输出评论回复/取消回复按钮
 */
function commentReply($archive)
{
    echo "<script type=\"text/javascript\">
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
                response = this.dom('$archive->respondId'), input = this.dom('comment-parent'),
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
            return false;
        },

        cancelReply : function () {
            var response = this.dom('$archive->respondId'),
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
            //console.log(inputs);
            for(var i=0;i<inputs.length;++i)
            {
                inputs[i].getElementsByTagName('label')[0].style.left='8px';
                inputs[i].getElementsByTagName('label')[0].style.bottom='12px';
            }
            return false;
        }
    }
</script>
";
}

/**
 * 将主题配置中textarea内的string转换为JSON数据
 * 用作部分配置
 */
function convertConfigData($item, $mode)
{
    $options = Helper::options();
    $data = $options->$item ? $options->$item : "";
    if ($data) {
        if ($mode) {
            $json = json_decode("[" . $data . "]", true);
        } else {
            $json = json_decode(trim("{" . $data . "}"), true);
        }

        return $json;
    } else {
        return false;
    }

}

/**
 * 解析 user-agent 返回对应的操作系统和浏览器信息
 * @param $ua user-agent
 *
 * @return string html 标签
 */
function parseUseragent($ua)
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

/**
 * 返回设置状态
 */

function isEnabled($item, $config)
{
    return (!empty(Helper::options()->$config) && in_array($item, Helper::options()->$config)) ? true : false;
}

/**
 * 根据slug获取页面地址
 */
function getPermalinkFromSlug()
{
    $Contents = Typecho_Widget::widget('Widget_Abstract_Contents');
    $db = Typecho_Db::get();
    $query = $db->select()->from('table.contents')
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', 'page')
        ->where('table.contents.password IS NULL');
    $_contents = $db->fetchAll($query);
    if ($_contents) {
        $contents = array();
        foreach ($_contents as $val) {
            $val = $Contents->push($val);
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
        return false;
    }
}
