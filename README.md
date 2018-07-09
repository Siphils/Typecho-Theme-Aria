# typecho-theme-Aria  
断断续续写了一个月，目前还是在测试阶段。  
直观上虽然感觉和原来的差不多。。。但是基本上全部重写了。。  
这段时间对Typecho一些功能的实现也摸索了很多  
BUG和使用问题请提issue  
:)  
***  
## 使用方法
### 安装
1.下载  
2.文件夹命名为`Aria`并上传到`/usr/themes/`目录  
3.后台启用  
### 导航栏配置  
需要按照如下方式填写配置信息  
```json  
"archives": {
    "text": "归档", 
    "link": "http://localhost/typecho/archives.html"
}, 
"about": {
    "text": "关于", 
    "link": "http://localhost/typecho/about.html"
}, 
"guestbook": {
    "text": "留言", 
    "link": "http://localhost/typecho/guestbook.html"
}, 
"friends": {
    "text": "朋友", 
    "link": "http://localhost/typecho/friends.html"
}
```  
因为添加了`iconfont`的图标支持，所以目前仅支持`archives`,`about`,`guestbook`,`friends`四个页面配置信息（可以留空），**最后一项不需要逗号**  
类似`archives`的即为页面的`slug`,`text`是链接的名称，`link`为链接地址，输出的`html`代码为  
```html
<li class="nav-right-item"><a href="{link}"><i class="iconfont">{对应的iconfont}</i>{text}</a></li>
```  
### 友情链接页面  
新建一个页面，选择页面模板`友情链接`, **`slug`设置为`friends`** 
新建一个友情链接盒子`[link-box][/link-box]`  
新建一个友情链接`[link-item href=链接地址 title=鼠标悬停时显示文字 img=友情链接图像地址 name=友情链接名称]`。注意属性都需要按顺序填写，`[link-item]`之间不要有空格（会被解析为`<br>`）。
每一个`[link-item]`都要被包括在`[link-box][/link-box]`之间，并会被解析为如下`html`格式  
```html
<a href="链接地址" title="鼠标悬停时显示文字" target="_blank">
    <div class="link-item">
        <img class="link-avatar" src="友情链接图像地址">
        <span class="link-name">友情链接名称</span>
    </div>
</a>
```  
***  
填写示例  
```sh  
[link-box][link-item href=https://x.x/ title=悬停时显示我！ img=https://x.x/x.jpg name=我是名字！][link-item href=https://x.x/ title=悬停时显示我！ img=https://x.x/x.jpg name=我是名字！][/link-box]
```  
输出示例  
```html  
<div class="link-box">
    <a href="https://x.x/" title="悬停时显示我！" target="_blank">
        <div class="link-item">
            <img class="link-avatar" src="https://x.x/x.jpg">
            <span class="link-name">我是名字！</span>
        </div>
    </a>
    <a href="https://x.x/" title="悬停时显示我！" target="_blank">
        <div class="link-item">
            <img class="link-avatar" src="https://x.x/x.jpg">
            <span class="link-name">我是名字！</span>
        </div>
    </a>
</div>
```  
### 归档页面  
创建一个独立页面并选择使用模板`归档页面 时间轴`,**`slug`设置为`archives`**  
不需要填写任何内容，写了也不会有输出（逃  
### PJAX  
后台可以选择开启或者关闭  
如果开启需要在后台关闭`设置->评论->开启反垃圾保护`  
***  
## 更新  
### 2018-7-9 1.4  
* 增加了一些设置的开关  
* 增加了处理主题配置信息相关功能  
* 增加了导航栏的配置功能  
* 修改大部分样式  
* 重写一部分函数  
* `Prism.js`更换为`highlight.js`  
* ......
### 2018-6-24 1.3  
* 修改部分字体样式  
* 修改首页卡片样式  
* 修改部分文章样式  
* 修改底部样式  
* 底部添加了一言  
* 去除了思源黑体
### 2018-6-20 1.2  
* 更新了友情链接页面短代码匹配以及部分样式  
* 增加了pjax无刷新加载  
* 增加页面进度条  
* 去除了首页文章预览内容的显示  
### 2018-6-15 1.1 Beta  
* 评论头像换用cn.gravatar.org的源  
* 增加了用户评论的UA显示  
* 更新了文章底部上一篇/下一篇的样式  
* 更新了默认随机缩略图的显示  
* 更新了部分样式  
* 修复了归档页面输出时光轴的BUG  
***  
## 下个版本部分更新计划  
* 添加点赞和打赏功能  
* 添加社交媒体配置  
* 修复目前测试版中已知的BUG  
* ……
*** 
## 使用的开源项目:  
* [highlight.js](https://highlightjs.org/ "highlight.js")  
* [Bootstrap grid.css](http://www.bootcss.com/ "Bootstrap grid.css")  
* [Fancybox](https://fancyapps.com/fancybox/3/ "fancybox")  
* [jQuery](https://jquery.com/ "jQuery")  
* [DIYgod/OwO](https://github.com/DIYgod/OwO "OwO")  
* [headroom.js](http://www.bootcss.com/p/headroom.js/ "headroom.js")  
* [MoOx/pjax](https://github.com/MoOx/pjax "MoOx/pjax")  
* [NProgress](https://github.com/rstacruz/nprogress "NProgress")  
*** 
## 部分插件
* [CommentToMail](https://9sb.org/58 "CommentToMail")
* [CompressHTML](https://github.com/qlwz/CompressHTML-For-Typecho "CompressHTML")  