<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

define('ARIA_VERSION', '1.9.0');
define('__TYPECHO_GRAVATAR_PREFIX__', Helper::options()->gravatarPrefix ? Helper::options()->gravatarPrefix : 'https://cn.gravatar.com/avatar/');

require_once 'lib/Shortcode.php';
require_once 'lib/Utils.php';
require_once 'lib/Contents.php';
require_once 'lib/Comments.php';

function themeConfig($form)
{
    echo '<script>var ARIA_VERSION = "' . ARIA_VERSION . '";</script>';
    ?>
    <style>form{position:relative;max-width:100%}form input:not([type]),form input[type="date"],form input[type="datetime-local"],form input[type="email"],form input[type="number"],form input[type="password"],form input[type="search"],form input[type="tel"],form input[type="time"],form input[type="text"],form input[type="file"],form input[type="url"]{font-family:'Lato','Helvetica Neue',Arial,Helvetica,sans-serif;margin:0em;outline:none;-webkit-appearance:none;tap-highlight-color:rgba(255,255,255,0);line-height:1.21428571em;padding:0.67857143em 1em;font-size:1em;background:#FFFFFF;border:1px solid rgba(34,36,38,0.15);color:rgba(0,0,0,0.87);border-radius:0.28571429rem;-webkit-box-shadow:0em 0em 0em 0em transparent inset;box-shadow:0em 0em 0em 0em transparent inset;-webkit-transition:color 0.5s ease,border-color 0.5s ease;transition:color 0.5s ease,border-color 0.5s ease}form textarea{margin:0em;-webkit-appearance:none;tap-highlight-color:rgba(255,255,255,0);padding:0.78571429em 1em;background:#FFFFFF;border:1px solid rgba(34,36,38,0.15);outline:none;color:rgba(0,0,0,0.87);border-radius:0.28571429rem;-webkit-box-shadow:0em 0em 0em 0em transparent inset;box-shadow:0em 0em 0em 0em transparent inset;-webkit-transition:color 0.1s ease,border-color 0.5s ease;transition:color 0.1s ease,border-color 0.5s ease;font-size:1em;line-height:1.2857;resize:vertical}form textarea:not([rows]){height:12em;min-height:8em;max-height:24em}form textarea,form input[type="checkbox"]{vertical-align:top}form textarea:focus,form input:focus{color:rgba(0,0,0,0.95);border-color:#85B7D9;border-radius:0.28571429rem;background:#FFFFFF;-webkit-box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset;box-shadow:0px 0em 0em 0em rgba(34,36,38,0.35) inset;-webkit-appearance:none}.tip{max-width:100%;position:relative;min-height:1em;margin:0 10px;background:#F8F8F9;padding:1em 1.5em;line-height:1.4285em;color:rgba(0,0,0,0.87);-webkit-transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,-webkit-box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,box-shadow 0.1s ease;transition:opacity 0.1s ease,color 0.1s ease,background 0.1s ease,box-shadow 0.1s ease,-webkit-box-shadow 0.1s ease;border-radius:0.28571429rem;-webkit-box-shadow:0 0 0 1px rgba(34,36,38,.22) inset,0 2px 4px 0 rgba(34,36,38,.12),0 2px 10px 0 rgba(34,36,38,.15);box-shadow:0 0 0 1px rgba(34,36,38,.22) inset,0 2px 4px 0 rgba(34,36,38,.12),0 2px 10px 0 rgba(34,36,38,.15)}.tip-header{text-align:center;margin:10px auto 20px auto;color:#444;text-shadow:0 0 2px #c2c2c2}.current-ver{position:relative;border-color:#b21e1e!important;background-color:#DB2828!important;color:#FFF!important;left:-37px;padding-left:1rem;border-bottom-right-radius:5px;padding-right:1.2em}.current-ver:after{position:absolute;content:'';top:100%;left:0;background-color:transparent!important;border-style:solid;border-width:0 1.2em 1.2em 0;border-color:transparent;border-right-color:inherit;width:0;height:0}.btn.primary{cursor:pointer;display:inline-block;background:#E0E1E2 none;color:rgba(0,0,0,0.6);padding:0 1.5em;border-radius:0.28571429rem;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;outline:none;-webkit-transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,background 0.5s ease,-webkit-box-shadow 0.5s ease;transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,background 0.5s ease,-webkit-box-shadow 0.5s ease;transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,box-shadow 0.5s ease,background 0.5s ease;transition:opacity 0.5s ease,background-color 0.5s ease,color 0.5s ease,box-shadow 0.5s ease,background 0.5s ease,-webkit-box-shadow 0.5s ease;-webkit-tap-highlight-color:transparent}.btn.primary:hover{background-color:#CACBCD;color:rgba(0,0,0,0.8)}.btn.primary[type="submit"]{position:fixed;right:100px;bottom:100px}.btn.confirm{background-color:#95f798!important}.btn.alert{background-color:#fa9492 !important}i.confirm{position:absolute;left:.5em}i.confirm:after,i.confirm:before{content:"";background:green;display:block;position:absolute;width:3px;border-radius:3px}i.confirm:after{height:6px;transform:rotate(-45deg);top:9px;left:6px}i.confirm:before{height:11px;transform:rotate(45deg);top:5px;left:10px}i.alert{position:absolute;left:.5em}i.alert:after,i.alert:before{content:"";background:red;display:block;position:absolute;width:3px;border-radius:3px;left:9px}i.alert:after{height:3px;top:14px}i.alert:before{height:8px;top:4px}.multiline{position:relative;display:inline-block;-webkit-backface-visibility:hidden;backface-visibility:hidden;outline:none;vertical-align:baseline;font-style:normal;min-height:17px;font-size:1rem;line-height:17px;min-width:17px}.multiline input[type="checkbox"],.multiline input[type="radio"]{cursor:pointer;position:absolute;top:0px;left:0px;opacity:0 !important;outline:none;z-index:3;width:17px;height:17px}.multiline{min-height:1.5rem}.multiline input{width:3.5rem;height:1.5rem}.multiline .box,.multiline label{min-height:1.5rem;padding-left:4.5rem;color:rgba(0,0,0,0.87)}.multiline label{padding-top:0.15em}.multiline .box:before,.multiline label:before{cursor:pointer;display:block;position:absolute;content:'';z-index:1;-webkit-transform:none;transform:none;border:none;top:0rem;background:rgba(0,0,0,0.05);-webkit-box-shadow:none;box-shadow:none;width:3.5rem;height:1rem;border-radius:500rem}.multiline .box:after,.multiline label:after{cursor:pointer;background:#FFFFFF -webkit-gradient(linear,left top,left bottom,from(transparent),to(rgba(0,0,0,0.05)));background:#FFFFFF -webkit-linear-gradient(transparent,rgba(0,0,0,0.05));background:#FFFFFF linear-gradient(transparent,rgba(0,0,0,0.05));position:absolute;content:'' !important;opacity:1;z-index:2;border:none;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;width:1.2rem;height:1.2rem;top:-.1rem;left:0em;border-radius:500rem;-webkit-transition:background 0.3s ease,left 0.3s ease;transition:background 0.3s ease,left 0.3s ease}.multiline input ~ .box:after,.multiline input ~ label:after{left:-0.05rem;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset}.multiline input:focus ~ .box:before,.multiline input:focus ~ label:before{background-color:rgba(0,0,0,0.15);border:none}.multiline .box:hover::before,.multiline label:hover::before{background-color:rgba(0,0,0,0.15);border:none}.multiline input:checked ~ .box,.multiline input:checked ~ label{color:rgba(0,0,0,0.95) !important}.multiline input:checked ~ .box:before,.multiline input:checked ~ label:before{background-color:#2185D0 !important}.multiline input:checked ~ .box:after,.multiline input:checked ~ label:after{left:2.3rem;-webkit-box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset;box-shadow:0px 1px 2px 0 rgba(34,36,38,0.15),0px 0px 0px 1px rgba(34,36,38,0.15) inset}.multiline input:focus:checked ~ .box,.multiline input:focus:checked ~ label{color:rgba(0,0,0,0.95) !important}.multiline input:focus:checked ~ .box:before,.multiline input:focus:checked ~ label:before{background-color:#0d71bb !important}
    #typecho-option-item-MathJaxConfig-15{display:none}
    </style>
    <script>var r=new XMLHttpRequest();var updating=function(dom){var i=document.createElement("i");i.className="loading";dom.prepend(i)};var checkUpdate=function(dom){updating(dom);try{r.open("GET","https://raw.githubusercontent.com/Siphils/Typecho-Theme-Aria/master/version.json?raw=true",true);r.send();r.onreadystatechange=function(){if(r.readyState===4){if(r.status==200){try{var d=JSON.parse(r.responseText)}catch(e){}if(d.version==ARIA_VERSION.trim()){dom.className+=" confirm";dom.style.paddingLeft="2em";dom.textContent="已经为最新版";var i=document.createElement("i");i.className="confirm";dom.prepend(i)}else{dom.className+=" alert";dom.style.paddingLeft="2em";dom.textContent="检查到新版本";var i=document.createElement("i");i.className="alert";dom.prepend(i);if(typeof document.getElementById('update-info')==='undefined'||document.getElementById('update-info')===null){var log=document.createElement('div');log.id='update-info';log.classList.add('tip');var html='<ul><li>新版本：'+d.version+'</li><li>更新日志：<a href="'+d.changeLog+'" target="_blank">changeLog</a></li><li>使用帮助：<a href="'+d.wiki+'" target="_blank">Wiki</a></li>';if(d.warning){html+='<li><strong>更新须知:'+d.warning+'</strong></li>'}html+='</ul>';log.innerHTML=html;Array.prototype.slice.call(document.getElementsByClassName('tip')).pop().after(log)}}}else{dom.textContent="请求失败！错误码："+r.status}}}}catch(e){dom.textContent="请求失败，请稍后重试！"+e}document.getElementsByTagName("button")[1].onclick=function(e){updating(e.target)}};window.onload=function(){checkUpdate(document.getElementById('check-update'))}</script>
    <script>window.onload=function(){document.getElementById('AriaConfig-enableMathJax').onchange=show;show();function show(){var text=document.getElementById('typecho-option-item-MathJaxConfig-15'),checkbox=document.getElementById('AriaConfig-enableMathJax');text.style.display=checkbox.checked?'block':'none'}}</script>
<?php
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

    $customHeader = new Typecho_Widget_Helper_Form_Element_Textarea('customHeader', null, null, _t('顶部自定义内容'), _t('会加载在<strong>head</strong>结束标签之前'));
    $form->addInput($customHeader);

    $customFooter = new Typecho_Widget_Helper_Form_Element_Textarea('customFooter', null, null, _t('底部自定义内容'), _t('会加载在<strong>copyright</strong>之前'));
    $form->addInput($customFooter);

    $customScript = new Typecho_Widget_Helper_Form_Element_Textarea('customScript', null, null, _t('自定义JS'), _t('会加载在main.min.js文件加载之前'));
    $form->addInput($customScript);

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

    $MathJaxConfig = new Typecho_Widget_Helper_Form_Element_Textarea('MathJaxConfig', null, "MathJax.Hub.Config({
        tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
      });", _t('MathJax配置信息'), _t('在此输入MathJax配置信息，不需要script标签，只输入JS代码'));
    $form->addInput($MathJaxConfig);

    $AriaConfig = new Typecho_Widget_Helper_Form_Element_Checkbox('AriaConfig',
        array(
            'enablePjax' => '开启PJAX',
            'enableAjaxComment' => '开启AJAX评论',
            'enableFancybox' => '文章/评论图片使用<a href="http://fancyapps.com" target="_blank">fancybox</a>',
            'enableLazyload' => '开启图片懒加载<a href="https://appelsiini.net/projects/lazyload" target="_blank">lazyload</a>',
            'enableCommentToMail' => '是否接收评论邮件回复按钮，需要配合<a href="https://9sb.org/58">CommentToMail</a>（文章中最后一个插件)使用',
            'enableMathJax' => '启用MathJax',
            'showQRCode' => '文章底部显示本文链接二维码',
            'showCommentUA' => '评论显示UserAgent（显示操作系统和浏览器信息）',
            'showHitokoto' => '页面底部显示一言',
        ),
        null,
        '开关设置'
    ); //array('showHitokoto', 'enablePjax', 'enableAjaxComment', 'enableFancybox', 'enableLazyload', 'showQRCode', 'enableCommentToMail', 'showCommentUA')
    $form->addInput($AriaConfig->multiMode());

}

function themeFields($layout)
{
    $thumbnail = new Typecho_Widget_Helper_Form_Element_Text('thumbnail', null, null, _t('文章/页面缩略图Url'), _t('需要带上http(s)://'));
    $previewContent = new Typecho_Widget_Helper_Form_Element_Text('previewContent', null, null, _t('文章预览内容'), _t('设置文章的预览内容，留空自动截取文章前50个字。'));
    $showTOC = new Typecho_Widget_Helper_Form_Element_Radio('showTOC', array(true => _t('开启'), false => _t('关闭')), false, _t('文章目录'), _t('仅会解析h2和h3标题，最多解析两层'));

    $layout->addItem($thumbnail);
    $layout->addItem($previewContent);
    $layout->addItem($showTOC);
}

Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Contents', 'parse');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Contents', 'parse');
Typecho_Plugin::factory('Widget_Abstract_Comments')->contentEx = array('Comments', 'parse');

function themeInit($archive)
{
    Helper::options()->commentsMaxNestingLevels = 999;
    Helper::options()->commentsOrder = 'DESC';
    /* if (Utils::isEnabled('enablePjax', 'AriaConfig')) {
        Helper::options()->commentsAntiSpam = false;
    } */

    //ajax获取评论头像
    if (isset($_GET['action']) == 'ajax_avatar_get' && 'GET' == $_SERVER['REQUEST_METHOD']) {
        $host = __TYPECHO_GRAVATAR_PREFIX__;
        $email = strtolower($_GET['email']);
        $hash = md5($email);
        $avatar = $host . $hash . '?s=64&r=G';
        echo $avatar;
        die();
    } else {return;}
}