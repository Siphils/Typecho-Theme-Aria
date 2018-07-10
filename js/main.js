window.Aria = {
    init: function() {
        this.action();
        this.headroom();
        if(THEME_CONFIG.USE_PJAX)
            this.pjax();
        if(THEME_CONFIG.USE_FANCYBOX)
            this.fancyBox();
        if(THEME_CONFIG.SHOW_HITOKOTO)
            this.hitokoto();
        this.hljs();
        console.log("%cVer 1.4%cTypecho-Theme-Aria%cBy Siphils http://siphils.com/ \n", 
            "color: #fadfa3; background: #988986; padding:8px 4px;", 
            "color: #ffffff; background: #435561; padding:8px 4px;",
            "color: #ffffff; background: #6fa8dc; padding:8px 4px;");
    },
    pjax: function() {
        var pjax = new Pjax({
            elements: 'a:not([rel~="nofollow"]):not([no-pjax])',
            selectors: ["title","#main", ".pjax-container"],
            debug: true,
            cacheBust: false
        });
        document.addEventListener('pjax:send', function() {NProgress.start()});
        document.addEventListener('pjax:complete', function(){
            NProgress.done();
            Aria.action();
            Aria.headroom();
            /*if(THEME_CONFIG.USE_PJAX)
                Aria.pjax();*/
            if(THEME_CONFIG.USE_FANCYBOX)
                Aria.fancyBox();
            if(THEME_CONFIG.SHOW_HITOKOTO)
                Aria.hitokoto();
            Aria.hljs();
        });
    },
    headroom: function() {
        var myElement = document.querySelector("#nav-menu");
        // construct an instance of Headroom, passing the element
        var headroom  = new Headroom(myElement);
        // initialise
        headroom.init();
    },
    fancyBox:function() {       
        $("a.fancyBox").fancybox({
            'animationEffect': "zoom-in-out",
            'animationDuration': 500,
            'transitionEffect': "tube",
            'transitionDuration': 500,
        });   
    },
    hitokoto: function() {
        $.ajax({
            type: 'GET',
            url: 'https://v1.hitokoto.cn/?c=a&encode=text',
            success: function(r) {
                $("#hitokoto").html(r);
            }
        })
    },
    hljs:function() {
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
        
        if($("ol.line-number")!==undefined) {
            $('pre>code').each(function () {
            var current = $(this),
                lineStart = parseInt(current.data('line-start')),
                lineFocus = parseInt(current.data('line-focus')),
                items = current.html().split("\n"),
                total = items.length,
                result = '<ol class="line-number" ' + (!isNaN(lineStart) ? 'start="' + lineStart + '"' : '') + '>';

            for (var i = 0; i < total; i++) {
                if (i === (lineFocus - lineStart)) {
                    result += '<li class="hightlight">';
                }
                else {
                    result += '<li>';
                }

                result += items[i] + '</li>';
            }
                result += '</ol>';
                var items = current.empty().append(result);
            });
        } 
    },
    action: function() {
        if($("#nav-vertical").css("display") !== 'none')
        {
            $("#nav-vertical").css("display","none");
        }
        /* menu */
        $("#nav-menu-btn").on("click", function() { $("#nav-vertical").fadeIn(); })
        $("#nav-vertical>.close").on("click", function() { $("#nav-vertical").fadeOut(); });
        $("#search-box>.close").on("click", function() { $("#search-box").fadeOut(); });
        $("#nav-search-btn").on("click", function() { $("#search-box").fadeIn(); });

        /* go-top */
        $(window).scroll(function () {
            if ($(window).scrollTop() > 100) {
                $("#go-top").fadeIn(500);
            } else {
                $("#go-top").fadeOut(500, function () {
                    $("#go-top").css("display", "none");
                });
            }
        });
        $("#go-top").click(function () {
            $('body,html').animate({scrollTop: 0},1000,function() {
                $("#go-top").animate({opacity:"100"});
            });
            return false;
        });
        window.addEventListener("scroll", function() {
            let scrollTop = document.documentElement.scrollTop || document.body.scrollTop,
                scrollHeight = document.documentElement.scrollHeight,
                clientHeight = document.documentElement.clientHeight;
            let percentage = parseInt((scrollTop / (scrollHeight - clientHeight)) * 100) + "%";
            let scrollPercentage = document.getElementById("scroll-percentage");
            scrollPercentage.innerHTML = percentage; 
        })
    }
}