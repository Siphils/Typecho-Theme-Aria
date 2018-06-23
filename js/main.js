window.Aria = {
    init: function() {
        Aria.action();
        Aria.fancyBox();
        Aria.headroom();
        Aria.pjax();
    },
    pjax: function() {
        var pjax = new Pjax({
            elements: "a",
            selectors: ["title","#main", ".pjax-container"],
            debug: false,
            cacheBust: false
        });
        document.addEventListener('pjax:send', function() {NProgress.start()});
        document.addEventListener('pjax:complete', function(){
            NProgress.done();
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
        $("a.fancyBox_group").fancybox({  
            'transitionIn'  :   'elastic',  
            'transitionOut' :   'elastic',  
            'speedIn'       :   600,   
            'speedOut'      :   200,   
            'overlayShow'   :   true  
        });   
    },
    action: function() {
        /* menu */
        $("#nav-menu-btn").on("click", function() { $("#nav-vertical").slideDown(); })
        $("#nav-vertical>.close").on("click", function() { $("#nav-vertical").slideUp(); });
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