window.Aria = {
    init: function() {
        Aria.action();
        Aria.fancyBox();
    },
    fancyBox:function() {
        $(document).ready(function() {         
            $("a.fancyBox_group").fancybox({  
                'transitionIn'  :   'elastic',  
                'transitionOut' :   'elastic',  
                'speedIn'       :   600,   
                'speedOut'      :   200,   
                'overlayShow'   :   true  
            });  
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