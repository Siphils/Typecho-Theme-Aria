<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define('ARIA_VERSION','1.7.1');

require_once('lib/Shortcode.php');

function themeConfig($form) {
    echo '<script>var ARIA_VERSION = "'.ARIA_VERSION.'"</script>';
    echo <<<EOF
    <style>
        .ui.button{cursor:pointer;display:inline-block;min-height:1em;outline:none;border:none;vertical-align:baseline;background:#E0E1E2 none;color:rgba(0,0,0,0.6);font-family:'Lato','Helvetica Neue',Arial,Helvetica,sans-serif;margin:0em 0.25em 0em 0em;padding:0.78571429em 1.5em 0.78571429em;text-transform:none;text-shadow:none;font-weight:bold;line-height:1em;font-style:normal;text-align:center;text-decoration:none;border-radius:0.28571429rem;-webkit-box-shadow:0px 0px 0px 1px transparent inset,0px 0em 0px 0px rgba(34,36,38,0.15) inset;box-shadow:0px 0px 0px 1px transparent inset,0px 0em 0px 0px rgba(34,36,38,0.15) inset;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-transition:opacity 0.1s ease,background-color 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,background-color 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,background-color 0.1s ease,color 0.1s ease,box-shadow 0.1s ease,background 0.1s ease;transition:opacity 0.1s ease,background-color 0.1s ease,color 0.1s ease,box-shadow 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;will-change:'';-webkit-tap-highlight-color:transparent}
        .ui.loading.loading.loading.loading.loading.loading.button{position:relative;cursor:default;text-shadow:none !important;color:transparent !important;opacity:1;pointer-events:auto;-webkit-transition:all 0s linear,opacity 0.1s ease;transition:all 0s linear,opacity 0.1s ease}
        .ui.loading.button:before{position:absolute;content:'';top:50%;left:50%;margin:-0.64285714em 0em 0em -0.64285714em;width:1.28571429em;height:1.28571429em;border-radius:500rem;border:0.2em solid rgba(0,0,0,0.15)}
        .ui.loading.button:after{position:absolute;content:'';top:50%;left:50%;margin:-0.64285714em 0em 0em -0.64285714em;width:1.28571429em;height:1.28571429em;-webkit-animation:button-spin 0.6s linear;animation:button-spin 0.6s linear;-webkit-animation-iteration-count:infinite;animation-iteration-count:infinite;border-radius:500rem;border-color:#FFFFFF transparent transparent;border-style:solid;border-width:0.2em;-webkit-box-shadow:0px 0px 0px 1px transparent;box-shadow:0px 0px 0px 1px transparent}
        .ui.labeled.icon.loading.button .icon{background-color:transparent;-webkit-box-shadow:none;box-shadow:none}
        @-webkit-keyframes button-spin{from{-webkit-transform:rotate(0deg);transform:rotate(0deg)}
        to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}
        }@keyframes button-spin{from{-webkit-transform:rotate(0deg);transform:rotate(0deg)}
        to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}
        }.ui.basic.loading.button:not(.inverted):before{border-color:rgba(0,0,0,0.1)}
        .ui.basic.loading.button:not(.inverted):after{border-top-color:#767676}
        .ui.primary.button{background-color:#2185D0;color:#FFFFFF;text-shadow:none;background-image:none}
        .ui.primary.button{-webkit-box-shadow:0px 0em 0px 0px rgba(34,36,38,0.15) inset;box-shadow:0px 0em 0px 0px rgba(34,36,38,0.15) inset}
        .ui.primary.button:hover{background-color:#1678c2;color:#FFFFFF;text-shadow:none}
        .ui.primary.button:focus{background-color:#0d71bb;color:#FFFFFF;text-shadow:none}
        .ui.primary.button:active{background-color:#1a69a4;color:#FFFFFF;text-shadow:none}
        .ui.primary.active.button,.ui.primary.button .active.button:active{background-color:#1279c6;color:#FFFFFF;text-shadow:none}
        .ui.checkbox{position:relative;display:inline-block;-webkit-backface-visibility:hidden;backface-visibility:hidden;outline:none;vertical-align:baseline;font-style:normal;min-height:17px;font-size:1rem;line-height:17px;min-width:17px}
        .ui.checkbox input[type="checkbox"],.ui.checkbox input[type="radio"]{cursor:pointer;position:absolute;top:0px;left:0px;opacity:0 !important;outline:none;z-index:3;width:17px;height:17px}
        .ui.toggle.checkbox{min-height:1.5rem}
        .ui.toggle.checkbox input{width:3.5rem;height:1.5rem}
        .ui.toggle.checkbox .box,.ui.toggle.checkbox label{min-height:1.5rem;padding-left:4.5rem;color:rgba(0,0,0,0.87)}
        .ui.toggle.checkbox label{padding-top:0.15em}
        .ui.toggle.checkbox .box:before,.ui.toggle.checkbox label:before{display:block;position:absolute;content:'';z-index:1;-webkit-transform:none;transform:none;border:none;top:0rem;background:rgba(0,0,0,0.05);-webkit-box-shadow:none;box-shadow:none;width:3.5rem;height:1.5rem;border-radius:500rem}
        .ui.toggle.checkbox .box:after,.ui.toggle.checkbox label:after{background:#FFFFFF -webkit-gradient(linear,left top,left bottom,from(transparent),to(rgba(0,0,0,0.05)));background:#FFFFFF -webkit-linear-gradient(transparent,rgba(0,0,0,0.05));background:#FFFFFF linear-gradient(transparent,rgba(0,0,0,0.05));position:absolute;content:'' !important;opacity:1;z-index:2;border:none;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;width:1.5rem;height:1.5rem;top:0rem;left:0em;border-radius:500rem;-webkit-transition:background 0.3s ease,left 0.3s ease;transition:background 0.3s ease,left 0.3s ease}
        .ui.toggle.checkbox input ~ .box:after,.ui.toggle.checkbox input ~ label:after{left:-0.05rem;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset}
        .ui.toggle.checkbox input:focus ~ .box:before,.ui.toggle.checkbox input:focus ~ label:before{background-color:rgba(0,0,0,0.15);border:none}
        .ui.toggle.checkbox .box:hover::before,.ui.toggle.checkbox label:hover::before{background-color:rgba(0,0,0,0.15);border:none}
        .ui.toggle.checkbox input:checked ~ .box,.ui.toggle.checkbox input:checked ~ label{color:rgba(0,0,0,0.95) !important}
        .ui.toggle.checkbox input:checked ~ .box:before,.ui.toggle.checkbox input:checked ~ label:before{background-color:#2185D0 !important}
        .ui.toggle.checkbox input:checked ~ .box:after,.ui.toggle.checkbox input:checked ~ label:after{left:2.15rem;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset}
        .ui.toggle.checkbox input:focus:checked ~ .box,.ui.toggle.checkbox input:focus:checked ~ label{color:rgba(0,0,0,0.95) !important}
        .ui.toggle.checkbox input:focus:checked ~ .box:before,.ui.toggle.checkbox input:focus:checked ~ label:before{background-color:#0d71bb !important}
        .ui.form{position:relative;max-width:100%}
        .ui.form .field > label{display:block;margin:0em 0em 0.28571429rem 0em;color:rgba(0,0,0,0.87);font-size:0.92857143em;font-weight:bold;text-transform:none}
        .ui.form textarea,.ui.form input:not([type]),.ui.form input[type="date"],.ui.form input[type="datetime-local"],.ui.form input[type="email"],.ui.form input[type="number"],.ui.form input[type="password"],.ui.form input[type="search"],.ui.form input[type="tel"],.ui.form input[type="time"],.ui.form input[type="text"],.ui.form input[type="file"],.ui.form input[type="url"]{width:100%;vertical-align:top}
        .ui.form::-webkit-datetime-edit,.ui.form::-webkit-inner-spin-button{height:1.21428571em}
        .ui.form input:not([type]),.ui.form input[type="date"],.ui.form input[type="datetime-local"],.ui.form input[type="email"],.ui.form input[type="number"],.ui.form input[type="password"],.ui.form input[type="search"],.ui.form input[type="tel"],.ui.form input[type="time"],.ui.form input[type="text"],.ui.form input[type="file"],.ui.form input[type="url"]{font-family:'Lato','Helvetica Neue',Arial,Helvetica,sans-serif;margin:0em;outline:none;-webkit-appearance:none;tap-highlight-color:rgba(255,255,255,0);line-height:1.21428571em;padding:0.67857143em 1em;font-size:1em;background:#FFFFFF;border:1px solid rgba(34,36,38,0.15);color:rgba(0,0,0,0.87);border-radius:0.28571429rem;-webkit-box-shadow:0em 0em 0em 0em transparent inset;box-shadow:0em 0em 0em 0em transparent inset;-webkit-transition:color 0.1s ease,border-color 0.1s ease;transition:color 0.1s ease,border-color 0.1s ease}
        .ui.form textarea{margin:0em;-webkit-appearance:none;tap-highlight-color:rgba(255,255,255,0);padding:0.78571429em 1em;background:#FFFFFF;border:1px solid rgba(34,36,38,0.15);outline:none;color:rgba(0,0,0,0.87);border-radius:0.28571429rem;-webkit-box-shadow:0em 0em 0em 0em transparent inset;box-shadow:0em 0em 0em 0em transparent inset;-webkit-transition:color 0.1s ease,border-color 0.1s ease;transition:color 0.1s ease,border-color 0.1s ease;font-size:1em;line-height:1.2857;resize:vertical}
        .ui.form textarea:not([rows]){height:12em;min-height:8em;max-height:24em}
        .ui.form textarea,.ui.form input[type="checkbox"]{vertical-align:top}
        .ui.form input:not([type]):focus,.ui.form input[type="date"]:focus,.ui.form input[type="datetime-local"]:focus,.ui.form input[type="email"]:focus,.ui.form input[type="number"]:focus,.ui.form input[type="password"]:focus,.ui.form input[type="search"]:focus,.ui.form input[type="tel"]:focus,.ui.form input[type="time"]:focus,.ui.form input[type="text"]:focus,.ui.form input[type="file"]:focus,.ui.form input[type="url"]:focus{color:rgba(0,0,0,0.95);border-color:#85B7D9;border-radius:0.28571429rem;background:#FFFFFF;-webkit-box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset;box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset}
        .ui.form textarea:focus{color:rgba(0,0,0,0.95);border-color:#85B7D9;border-radius:0.28571429rem;background:#FFFFFF;-webkit-box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset;box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset;-webkit-appearance:none}
        .ui.message{position:relative;min-height:1em;margin:1em 0em;background:#F8F8F9;padding:1em 1.5em;line-height:1.4285em;color:rgba(0,0,0,0.87);-webkit-transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,box-shadow 0.1s ease,-webkit-box-shadow 0.1s ease;border-radius:0.28571429rem;-webkit-box-shadow:0px 0px 0px 1px rgba(34,36,38,0.22) inset,0px 0px 0px 0px rgba(0,0,0,0);box-shadow:0px 0px 0px 1px rgba(34,36,38,0.22) inset,0px 0px 0px 0px rgba(0,0,0,0)}
        .ui.message:first-child{margin-top:0em}
        .ui.message:last-child{margin-bottom:0em}
        .ui.message .header{display:block;font-family:'Lato','Helvetica Neue',Arial,Helvetica,sans-serif;font-weight:bold;margin:-0.14285714em 0em 0rem 0em}
        .ui.message .header:not(.ui){font-size:1.14285714em}
        .ui.message p{opacity:0.85;margin:0.75em 0em}
        .ui.message p:first-child{margin-top:0em}
        .ui.message p:last-child{margin-bottom:0em}
        .ui.message .header + p{margin-top:0.25em}
    </style>
    <script>
        window.onload = function(){
            var multiline = document.getElementsByClassName("multiline");
            for(var i=0;i<multiline.length;++i) {multiline[i].className+=" ui toggle checkbox";};
            document.getElementsByTagName("form")[0].parentNode.parentNode.className += " ui form";
            document.getElementsByTagName("button")[0].classList.remove("btn");
            var btn = document.getElementsByTagName("button");
            for(var i=0;i<btn.length;++i) {
                btn[i].className += " ui button";
                btn[i].style.width = "100%";
            }
        }
        var r = new XMLHttpRequest();
        var checkUpdate = function(dom) {
            dom.className += " loading";
            try {
                r.open("GET","https://raw.githubusercontent.com/Siphils/typecho-theme-Aria/master/version.txt",true);
                r.send();
                r.onreadystatechange = function() {
                    if(r.readyState === 4) {
                        if(r.status == 200 && !isNaN(parseInt(r.responseText))) {
                            dom.textContent = r.responseText.trim() == ARIA_VERSION.trim() ? "已经为最新版" : "最新版：" + r.responseText.trim();
                        }
                        else if(isNaN(parseInt(r.responseText))) {
                            dom.textContent = "请求失败，请稍后重试！";
                        }
                        else {
                            dom.textContent = "请求失败！错误码：" + r.status;
                        }
                    }
                }
            }
            catch(e) {
                dom.textContent = "请求失败，请稍后重试！" + e;
            }
            finally {
                
            }
            dom.className = dom.className.replace(/loading/g,"");
        }
    </script>  
EOF;
    echo '<div class="ui message">
    <div class="header" style="text-align:center;margin:10px auto 20px auto;color: #444;text-shadow:0 0 5px #bbb"><h2>Typecho-Theme-Aria</h2></div>
    <p>感谢您选择使用<a href="https://eriri.ink/archives/Typecho-Theme-Aria.html">Typecho-Theme-Aria</a></p>
    <p>当前版本<strong>Ver '.ARIA_VERSION.'</strong></p>
    <p>查看<a href="https://github.com/Siphils/typecho-theme-Aria/blob/master/README.md#%E4%BD%BF%E7%94%A8%E6%96%B9%E6%B3%95">帮助手册</a> <a href="https://github.com/Siphils/typecho-theme-Aria/issues">issue</a> <a href="https://github.com/Siphils/typecho-theme-Aria/pulls">PR</a></p>
    <p><button onclick="checkUpdate(this);" class="primary">检查更新</button></p>
</div>';
    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, NULL, _t('站点头像'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个头像,需要带上http(s)://'));
    $form->addInput($avatarUrl);

    $defaultThumbnail = new Typecho_Widget_Helper_Form_Element_Textarea('defaultThumbnail', NULL, NULL, _t('默认文章缩略图'), _t('填入默认的缩略图地址，未设置缩略图字段时调用此地址，需要带http(s)://，每一行写一个URL，随机展示'));
    $form->addInput($defaultThumbnail);

    $backgroundUrl = new Typecho_Widget_Helper_Form_Element_Textarea('backgroundUrl', NULL, NULL, _t('首页背景图片'),_t('需要输入http(s)://，每一行写一个URL，随机展示'));
    $form->addInput($backgroundUrl);

    $OwOJson = new Typecho_Widget_Helper_Form_Element_Text('OwOJson', NULL, NULL, _t('OwO'), _t('OwO表情JSON文件的URL'));
    $form->addInput($OwOJson);

    $placeholder = new Typecho_Widget_Helper_Form_Element_Text('placeholder',NULL, NULL,_t('评论框placeholder'), _t('这里的内容会提前显示在评论框里'));
    $form->addInput($placeholder);

    $statistics = new Typecho_Widget_Helper_Form_Element_Textarea('statistics', NULL, NULL, _t('统计代码'), _t('在此填入统计的代码(目前统计代码支持谷歌统计和百度统计的重载，若使用其他统计请关闭PJAX否则得到的统计数据不准确)'));
    $form->addInput($statistics);

    $userHeader = new Typecho_Widget_Helper_Form_Element_Textarea('userHeader', NULL, NULL, _t('顶部额外内容'), _t('会加载在<strong>head</strong>标签之前'));
    $form->addInput($userHeader);

    $userFooter = new Typecho_Widget_Helper_Form_Element_Textarea('userFooter', NULL, NULL, _t('底部额外内容'), _t('会加载在<strong>copyright</strong>之前'));
    $form->addInput($userFooter);

    $footerSpan = new Typecho_Widget_Helper_Form_Element_Textarea('footerSpan', NULL, NULL, _t('底部链接组件'), _t('按照格式填写，以英文逗号分隔'));
    $form->addInput($footerSpan);

    $cpr = new Typecho_Widget_Helper_Form_Element_Text('cpr', NULL, date('Y'), _t('Copyright年份'), _t('会显示在copyright的年份，例如2018或者2017-2018，留空会默认显示今年年份。<del>当然你想填什么都可以</del>'));
    $form->addInput($cpr);

    $navConfig = new Typecho_Widget_Helper_Form_Element_Textarea('navConfig', NULL, 
        '"archives":{
            "text":"归档",
            "link":"#",
            "icon":"icon-aria-archives"
        },
        "guestbook":{
            "text":"留言",
            "link":"#",
            "icon":"icon-aria-guestbook"
        },
        "friends":{
            "text":"朋友",
            "link":"#",
            "icon":"icon-aria-friends"
        },
        "about":{
            "text":"关于",
            "link":"#",
            "icon":"icon-aria-about"
        }', 
        _t('导航栏配置'), 
        _t('输入导航栏的配置信息')
    );
    $form->addInput($navConfig);

    $rewardConfig = new Typecho_Widget_Helper_Form_Element_Textarea('rewardConfig', NULL, NULL
    , _t('打赏功能配置'), _t('按照格式填写,留空关闭打赏功能'));
    $form->addInput($rewardConfig);

    $AriaConfig = new Typecho_Widget_Helper_Form_Element_Checkbox('AriaConfig',
        array(
            'showHitokoto' => '页面底部显示一言',
            'usePjax' => '开启PJAX(需要关闭评论反垃圾保护)',
            'useAjaxComment' => '开启AJAX评论',
            'useFancybox' => '文章/评论图片使用<a href="http://fancyapps.com">fancybox</a>',
            'useLazyload' => '开启图片懒加载',
            'showQRCode' => '文章底部显示本文链接二维码',
            'useCommentToMail' => '评论邮件回复按钮（需要配合<a href="https://9sb.org/58">CommentToMail</a>使用）',
            'showCommentUA' => '评论显示UserAgent（显示操作系统和浏览器信息）'
        ),
        array('showHitokoto','usePjax','useAjaxComment','useFancybox','useLazyload','showQRCode','useCommentToMail','showCommentUA'),
        '其他设置'
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
    Helper::options()->commentsMaxNestingLevels = 999;
    $AriaConfig = Typecho_Widget::widget('Widget_Options')->AriaConfig;
    Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Shortcode','parse');
    Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Shortcode','parse');
}

function AriaConfig() {
    $AriaConfig = Typecho_Widget::widget('Widget_Options')->AriaConfig;
    $options = Typecho_Widget::widget('Widget_Options');
    //print_r($AriaConfig);
    $showHitokoto = isEnabled('showHitokoto');
    $showQRCode = isEnabled('showQRCode');
    $showReward = $options->rewardConfig ? true : false;
    $usePjax = isEnabled('usePjax');
    $useAjaxComment = isEnabled('useAjaxComment');
    $useFancybox = isEnabled('useFancybox');
    $useLazyload = isEnabled('useLazyload');
    $OwOJson= $options->OwOJson ? $options->OwOJson : $options->themeUrl."/assets/OwO/OwO.json";
    $THEME_CONFIG = json_encode((object)array(
        "THEME_VERSION" => ARIA_VERSION,
        "SITE_URL" => $options->siteUrl,
        "THEME_URL" => $options->themeUrl,
        "SHOW_HITOKOTO" => $showHitokoto,
        "SHOW_QRCODE" => $showQRCode,
        "SHOW_REWARD" => $showReward,
        "USE_PJAX" => $usePjax,
        "USE_AJAX_COMMENT" => $useAjaxComment,
        "USE_FANCYBOX" => $useFancybox,
        "USE_LAZYLOAD" => $useLazyload,
        "OWO_JSON" => $OwOJson
    ));
    echo "<script>window.THEME_CONFIG = $THEME_CONFIG</script>\n";
}


/**
 * 根据配置的JSON数据输出导航栏
 * @param $mode 
 *  {
 *   "archives":{
 *       "text":"归档",
 *       "link":"https://xxx.com",
 *       "icon": "icon-aria-archives"
 *   },
 *   "guestbook":{
 *       "text":"留言",
 *       "link":"https://xxx.com"
 *       "icon":"icon-aria-guestbook"
 *   }
 *  目前可配置的有'archives','guestbook','friends','about'
 */
function showNav($mode) {
    $data = convertConfigData('navConfig', false);
    if($data) {
        $html = '';
        if($mode) {
            //输出水平导航栏
            if(array_key_exists('archives', $data)) {
                //输出‘归档’
                $html.='<li class="nav-right-item"><a href="'.$data['archives']['link'].'"><i class="iconfont '.$data['archives']['icon'].'"></i>'.$data['archives']['text'].'</a></li>';
            }
            if(array_key_exists('guestbook', $data)) {
                //输出‘留言’
                $html.='<li class="nav-right-item"><a href="'.$data['guestbook']['link'].'"><i class="iconfont '.$data['guestbook']['icon'].'"></i>'.$data['guestbook']['text'].'</a></li>';
            }
            if(array_key_exists('friends', $data)) {
                //输出‘朋友’
                $html.='<li class="nav-right-item"><a href="'.$data['friends']['link'].'"><i class="iconfont '.$data['friends']['icon'].'"></i>'.$data['friends']['text'].'</a></li>';
            }
            if(array_key_exists('about', $data)) {
                //输出‘关于’
                $html.='<li class="nav-right-item"><a href="'.$data['about']['link'].'"><i class="iconfont '.$data['about']['icon'].'"></i>'.$data['about']['text'].'</a></li>';
            }
        }
        else {
            //输出垂直导航栏
            if(array_key_exists('archives', $data)) {
                //输出‘归档’
                $html.='<a href="'.$data['archives']['link'].'"><i class="iconfont '.$data['archives']['icon'].'"></i>'.$data['archives']['text'].'</a>';
            }
            if(array_key_exists('guestbook', $data)) {
                //输出‘留言’
                $html.='<a href="'.$data['guestbook']['link'].'"><i class="iconfont '.$data['guestbook']['icon'].'"></i>'.$data['guestbook']['text'].'</a>';
            }
            if(array_key_exists('friends', $data)) {
                //输出‘朋友’
                $html.='<a href="'.$data['friends']['link'].'"><i class="iconfont '.$data['friends']['icon'].'"></i>'.$data['friends']['text'].'</a>';
            }
            if(array_key_exists('about', $data)) {
                //输出‘关于’
                $html.='<a href="'.$data['about']['link'].'"><i class="iconfont '.$data['about']['icon'].'"></i>'.$data['about']['text'].'</a>';
            }
        }
        
        echo $html;
    }
    //转换失败
    echo false;
}

/**
 * 输出文章打赏二维码和本文链接二维码
 * 输出的结构如下
 * <div class="post-other">
 *  <div class="post-reward">
 *      <a href="javascript:;" no-pjax ><i class="iconfont icon-aria-reward"></i></a>
 *      <ul>
 *          <li><img src="{qrcode image link}">支付宝</li>
 *          <li><img src="{qrcode image link}">QQ</li>
 *          <li><img src="{qrcode image link}">微信</li>
 *      </ul>
 * </div>
 * <div class="post-qrcode">
 *      <a href="javascript:;" no-pjax ><i class="iconfont icon-aria-qrcode"></i></a>
 * <div>手机上阅读<br><br><img src="path/to/qrcode"></div>
 *  </div>
 * </div>
 * 打赏二维码配置方案如下
 * "QQ钱包":"link",
 * "支付宝":"link",
 * "微信":"link"
 */
function postOther($archive)
{
    $html = '<div class="post-other">';
    $AriaConfig = Typecho_Widget::widget('Widget_Options')->AriaConfig;
    $rewardConfig = convertConfigData('rewardConfig', false);
    $showQRCode = isEnabled('showQRCode');
    if($rewardConfig) {
        $html .='<div class="post-reward"><a href="javascript:;" no-pjax ><i class="iconfont icon-aria-reward"></i></a>
            <ul>';
        foreach( $rewardConfig as $key => $data) {
            $html.='<li><img no-lazyload src="' . $data . '">'. $key .  '</li>';
        }
        $html.="</ul></div>";
    }
    if($showQRCode) {
        $url = Typecho_Widget::widget('Widget_Options')->themeUrl.'/lib/getQRCode.php?url=';
        $html.='<div class="post-qrcode"><a href="javascript:;" no-pjax ><i class="iconfont icon-aria-qrcode"></i></a><div>手机上阅读<br><br><img no-lazyload src="' .$url.$archive->permalink . '"></div></div>';
    }
    $html.="</div>";    
    echo $html;
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
function pageArchives($post) {
    static $ys = array();
    $t = $post->created;
    $href = $post->permalink;
    $title = $post->title;
    $y = date('Y',$t).' 年';
    $m = date('m',$t).' 月';
    $d = date('d',$t).' 日';
    $t_href = Helper::options()->siteUrl.date('Y/m',$t);
    $html = '';
    if(!in_array($y,$ys)) {
        array_push($ys,$y);
        $html .= "<div class=\"timeline-ym timeline-item\"><a href=\"$t_href\" target=\"_blank\">$y $m</a></div>";
    }
    $html.= '<div class="timeline-box"><div class="timeline-post timeline-item">' . '<a href="' . $href . '" target="_blank">' . $title . '</a><span class="timeline-post-time">'. $d .'</span></div></div>';
    echo $html;
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
        $options->themeUrl('assets/img/background.jpg');
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
        return $options->themeUrl.'/assets/img/thumbnail.jpg';
}

/**
 * 输出底部链接组件
 */

function getFooterSpan() {
    $data = convertConfigData('footerSpan', true);
    $opt = Typecho_Widget::widget('Widget_Options');
    if(!$data) {
        $html = '<span><a href="'.$opt->siteUrl.'">'.$opt->title.'</a></span><span><a href="http:\/\/www.typecho.org" title="念念不忘，必有回响。" target="_blank">Typecho</a></span><span><a href="https:\/\/eriri.ink/archives/Typecho-Theme-Aria.html" title="Typecho-Theme-Aria Ver '.ARIA_VERSION.' by Siphils" target="_blank">Aria</a></span>';
        echo $html;
        return;
    }
    $html = '<span><a href="'.$opt->siteUrl.'">'.$opt->title.'</a></span><span><a href="http:\/\/www.typecho.org" title="念念不忘，必有回响。" target="_blank">Typecho</a></span><span><a href="https:\/\/eriri.ink/archives/Typecho-Theme-Aria.html" title="Typecho-Theme-Aria Ver '.ARIA_VERSION.' by Siphils" target="_blank">Aria</a></span>';
    foreach($data as $val) {
        $tmp = $val;
        if((array)$tmp) {
            $href = property_exists($val, 'href') ? "href=\"$val->href\"": "";
            $title = property_exists($val, 'title') ? "title=\"$val->title\"": "";
            $target = property_exists($val, 'target') ? "target=\"$val->target\"" : "";
            $text = property_exists($val, 'text') ? $val->text : "";
            $html .= "<span><a $href $title $target>$text</span>";
        }
    }
    echo $html;
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
    
    //输出html
    $html = '<div class="post-footer-box half previous"><a href="'.$result["link"].'" rel="prev"><div class="post-footer-thumbnail"><img src="'.$result["img"].'"></div><span class="post-footer-label">Previous Post</span><div class="post-footer-title"><h3>'.$result["title"].'</h3></div></a></div>';
    echo $html;
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
    //输出html
    $html = '<div class="post-footer-box half next"><a href="'.$result["link"].'" rel="next"><div class="post-footer-thumbnail"><img src="'.$result["img"].'"></div><span class="post-footer-label">Next Post</span><div class="post-footer-title"><h3>'.$result["title"].'</h3></div></a></div>';
    echo $html;

}

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
    if($atStr !== '')
        $content = substr_replace($_content, $atStr,0,3);
    else
        $content=$_content;
    echo $content;
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
 * 输出评论回复/取消回复按钮
 */
function commentReply($archive) {
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
            //console.log(inputs);
            for(var i=0;i<inputs.length;++i)
            {
                //console.log(inputs[i].getElementsByTagName('label'));
                //inputs[i].getElementsByTagName('label')[0].style.left='18px';
                //inputs[i].getElementsByTagName('label')[0].style.bottom='22px';
            }
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
                //console.log(inputs[i].getElementsByTagName('label'));
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
function convertConfigData($item, $mode) {
    $options = Typecho_Widget::widget('Widget_Options');
    $data = $options->$item ? $options->$item : "";
    if($data) {
        if($mode)
            $json = json_decode("[".$data."]");
        else
            $json = json_decode(trim("{".$data."}"),true);
        return $json;
    }
    else 
        return false;
}

/**
 * 解析 user-agent 返回对应的操作系统和浏览器信息
 * @param $ua user-agent
 *
 * @return string html 标签
 */
function parseUseragent($ua) {

    // 解析操作系统
    $htmlTag = "";
    $os = null;
    $fontClass = null;
    if (preg_match('/Windows NT 6.0/i', $ua)) { $os = "Windows Vista"; $fontClass = "windows"; } 
    elseif(preg_match('/Windows NT 6.1/i', $ua)) { $os = "Windows 7"; $fontClass = "windows"; }
    elseif(preg_match('/Windows NT 6.2/i', $ua)) { $os = "Windows 8"; $fontClass = "windows"; }
    elseif(preg_match('/Windows NT 6.3/i', $ua)) { $os = "Windows 8.1"; $fontClass = "windows"; }
    elseif(preg_match('/Windows NT 10.0/i', $ua)) { $os = "Windows 10"; $fontClass="windows"; }
    elseif(preg_match('/Windows NT 5.1/i', $ua)) { $os = "Windows XP"; $fontClass = "windows"; }
    elseif(preg_match('/Windows NT 5.2/i', $ua) && preg_match('/Win64/i', $ua)) { $os = "Windows XP 64 bit"; $fontClass = "windows"; }
    elseif(preg_match('/Android ([0-9.]+)/i', $ua, $matches)) { $os = "Android ".$matches[1]; $fontClass = "android"; }
    elseif(preg_match('/iPhone OS ([_0-9]+)/i', $ua, $matches)) { $os = 'iPhone '.$matches[1]; $fontClass = "iphone"; }
    elseif(preg_match('/iPad/i', $ua)) { $os = "iPad"; $fontClass = "ipad";}
    elseif(preg_match('/Mac OS X ([_0-9]+)/i', $ua, $matches)) { $os = 'Mac OS X '.$matches[1]; $fontClass = "mac"; }
    elseif(preg_match('/Gentoo/i', $ua)) {$os = 'Gentoo Linux';$fontClass = "gentoo";}
    elseif(preg_match('/Ubuntu/i', $ua)) {$os = 'Ubuntu Linux';$fontClass = "ubuntu";}
    elseif(preg_match('/Debian/i', $ua)) { $os = 'Debian Linux'; $fontClass = "debian";}
    elseif(preg_match('/X11; FreeBSD/i', $ua)) {$os = 'FreeBSD';$fontClass = "freebsd";}
    elseif(preg_match('/X11; Linux/i', $ua)) {$os = 'Linux';$fontClass = "linux";}
    else {$os = 'unknown os';$fontClass = "os"; }
    
    $htmlTag = "<i class=\"iconfont icon-aria-$fontClass\"></i>";//<span class=\"os-$fontClass\">&nbsp;$os</span>";

    $browser = null;
    //解析浏览器
    if(preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) { $browser = 'Sogou browser'; $fontClass = "sogou"; }
    elseif(preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = '360 browser ';$fontClass = "360";}
    elseif(preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Maxthon ';$fontClass = "maxthon";}
    elseif(preg_match('#Edge( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Edge ';$fontClass = "edge";}
    elseif(preg_match('#MicroMessenger/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Wechat ';$fontClass = "wechat";}
    elseif(preg_match('#QQ/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'QQ Mobile '; $fontClass = "qq";}
    elseif(preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chrome ';$fontClass = "chrome";}
    elseif(preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chrome ';$fontClass = "chrome";}
    elseif(preg_match('#Chromium/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Chromium ';$fontClass = "chrome";}
    elseif(preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Safari ';$fontClass = "safari";}
    elseif(preg_match('#opera mini#i', $ua)) {
        preg_match('#Opera/([a-zA-Z0-9.]+)#i', $ua, $matches);
        $browser = 'Opera Mini '; $fontClass = "opera";
    }
    elseif(preg_match('#Opera.([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Opera ';$fontClass = "opera";}
    elseif(preg_match('#QQBrowser ([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'QQ browser ';$fontClass = "qqbrowser";}
    elseif(preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'UCWEB ';$fontClass = "uc";}
    elseif(preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Internet Explorer ';$fontClass = "ie";}
    elseif(preg_match('#Trident/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Internet Explorer 11';$fontClass = "ie";}
    elseif(preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)) {$browser = 'Firefox ';$fontClass = "firefox";}
    else { $browser = 'unknown br'; $fontClass = 'browser'; }

    $htmlTag .="&nbsp;";
    $htmlTag .="<i class=\"iconfont icon-aria-$fontClass\"></i>";//<span class=\"br-$fontClass\">&nbsp;$browser</span>";
    return $htmlTag;
}

/**
 * 返回设置状态
 */

 function isEnabled($item) {
    return (!empty(Helper::options()->AriaConfig) && in_array($item, Helper::options()->AriaConfig)) ? true : false;
 }