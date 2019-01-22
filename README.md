# Typecho-Theme-Aria  
> 书写自己的篇章  

![screenshot](https://github.com/Siphils/Typecho-Theme-Aria/blob/master/screenshot.png?raw=true)
## 使用方法  
[Wiki](https://eriri.ink/archives/Aria-manual.html)
## 更新  
### 2019-1-22 1.8.4  
* 代码块样式稍做优化  
* 代码块右上角增加了拷贝代码的按钮  
* 部分样式稍作修改  
* 去除了搜索框的背景图  
* 去除部分冗余代码  
* 修复了博客信息中Gravatar头像丢失的问题  
* 修复其他一些小BUG  
* 增加了文章目录(支持h2-h4三层解析)的功能，文章/页面编辑页面可以选择开启或关闭  
### 2018-12-3 1.8.3  
* 现在点击文章左下角的"Read More"的按钮会在新页面打开文章  
* 现在首页文章日期格式会按照`后台->设置->阅读->文章日期格式`的设置输出  
* 现在子菜单会根据内容自动撑开而不是适配父级菜单宽度（感谢P3TERX)  
* 修改评论输出函数，适配`后台->设置->评论`的多项配置选项(同时修复了包括但不限于开启评论审核导致输出错误的bug)  
* 手机端子菜单间距微调（防止误触等）  
### 2018-11-10 1.8.2  
* 增加了自定义gravatar头像源的配置，现在你可以选择自己想用的源了  
* 增加了对Meting和MathJax的PJAX结束后的重载  
* 增加了文章内部分图片不使用fancybox的方法  
* 导航栏解析新增`slug`参数  
* 修复了一个归档页面的输出bug  
* 修复了一个ajax评论的bug  
* 修复了子菜单超出边框的bug  
* 现在设置项`头像URL`为空时默认根据用户的邮箱调用gravatar头像  
* 自定义pjax重载函数从`userAction`更换为`Aria.reloadAction`  
* 微调部分样式  
* **修改了导航栏图标的解析，现在使用主题自带的图标需要加上`iconfont`，即完整的一个class**  
### 2018-10-11 1.8.1  
* 增加了自定义「一言」接口地址的设置项，现在你可以使用自己的接口了  
* 增加了PJAX重载函数的接口  
* 现在评论回复日期是根据你自己的设定进行输出了  
* 修复了一个短代码注册函数的bug  
* 修复了第一篇文章上下篇的显示bug(若只有一篇文章则不会显示上一篇/下一篇)  
* 对部分样式的细节进行优化处理  
* 处理部分css动画  
* 优化部分js代码  
* 对文章的代码块进行美化（css风格来自[Mashiro](https://2heng.xin)）  
### 2018-10-2 1.8.0  
* 增加了对导航二级菜单的支持  
* 增加了代码高亮块的语言类型提示  
* 修复了一个底部链接组件的bug  
* 重写显示上下篇的代码  
* 微调部分样式  
### 2018-9-27 1.7.1  
* 增加了`底部链接组件`的设置项  
* 增加了评论的 `useragent` 和对应的设置开关  
* 增加了主题最新版本检测的后台按钮  
* 重写归档页面的样式  
* 修复了一个后台开关设置的bug  
### 2018-9-12 1.7.0  
* 修改大部分样式  
* 评论区重写  
* 友情链接页面的样式整合到全局css（可以在任意文章/页面使用`[link-box]` `[link-item]`）  
* 文章短代码优化  
* 删除部分函数  
* 修复部分BUG  
### 2018-8-12 1.6.1  
* 优化了ajax评论代码  
* 后台主题设置使用semantic-ui进行美化  
* 部分细节微调  
* 增加了notyf对于评论成功或者失败的提示（可以配合SmartSpam插件使用）  
* 增加了图片懒加载的开关  
* 增加了对统计代码的重载(目前支持谷歌分析和百度统计)  
### 2018-8-7 1.6.0
* `友情链接`页面部分样式微调  
* css和js文件改为本地调用  
* 增加了pjax页面切换特效  
* 增加了ajax评论选择开关   
* 移除了底部的页面加载时间  
### 2018-7-30 1.5
* 增加了文章底部打赏功能和文章二维码功能
* 增加了评论部分**不接收邮件回复**的按钮（需要配合插件[CommentToMail](https://9sb.org/58 "CommentToMail")使用）  
* 修复了一个无法输出缩略图和预览内容的bug  
* `iconfont`的使用方式从`Unicode`修改为`Font Class`的方式  
* 修改部分样式  
* 重写部分代码  
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
## 使用的开源项目:  
* [highlight.js](https://highlightjs.org/ "highlight.js")  
* [Bento Grid System](https://github.com/fenbox/bento "Bento Grid System")  
* [Fancybox3](https://fancyapps.com/fancybox/3/ "fancybox3")  
* [jQuery](https://jquery.com/ "jQuery")  
* [DIYgod/OwO](https://github.com/DIYgod/OwO "OwO")  
* [headroom.js](https://www.bootcss.com/p/headroom.js/ "headroom.js")  
* [jquery-pjax](https://github.com/defunkt/jquery-pjax "jquery-pjax")  
* [NProgress](https://github.com/rstacruz/nprogress "NProgress")  
* [animate.css](https://daneden.github.io/animate.css/ "animate.css")     
* [jquery-lazyload](https://appelsiini.net/projects/lazyload/ "jquery-lazyload")  
* [smooth-scroll](https://github.com/cferdinandi/smooth-scroll "smooth-scroll")  
* [highlightjs-line-numbers](https://wcoder.github.io/highlightjs-line-numbers.js/ "hljs-line-numbers")  
* [clipboard.js](https://zenorocha.github.io/clipboard.js "clipboard")  
## 部分插件推荐（非必需）
* [CommentToMail](https://9sb.org/58 "CommentToMail")  
* [SmartSpam](http://www.yovisun.com/archive/typecho-plugin-smartspam.html "SmartSpam")  
* [Sticky](https://github.com/hitop/typechoSticky "Sticky")