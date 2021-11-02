$(document).ready(function(){
    if($(".to-everything").length>0){
        for(var i =0;i<3;i++){
            $(".to-left").append($(".to-left").html());
            $(".to-right").append($(".to-right").html());
        }
    }
    $(".to-left").slick({
                slidesToShow: 6,
                slidesToScroll: 3,
                infinite:true,
                autoplaySpeed: 2000,
    });
    $(".to-right").slick({
                slidesToShow: 6,
                slidesToScroll: 3,
                infinite:true,
                autoplaySpeed: 2000,
    });
    if($(".latest-ads-container").offset().top+20==$(window).scrollTop()){
        $(".latest-ads-container .super-eds-adv-container").css("position","fixed");
        $(".latest-ads-container .super-eds-adv-container").css("top","-2rem");
        $(".latest-ads-container .super-eds-adv-container").css("right",($(window).width()-$(".latest-ads-container .container").width())/2);
    }
    else{
        $(".latest-ads-container .super-eds-adv-container").css("position","static");
    }
    $(window).scroll(function(){
        if($(window).scrollTop()-20>=$(".latest-ads-container").offset().top){
            $(".latest-ads-container .super-eds-adv-container").css("position","fixed");
            $(".latest-ads-container .super-eds-adv-container").css("top","-2rem");
            $(".latest-ads-container .super-eds-adv-container").css("right",($(window).width()-$(".latest-ads-container .container").width())/2);
        }
        else{
            $(".latest-ads-container .super-eds-adv-container").css("position","static");
        }
    });

    var adOffsetTop = $(".sec").offset().top;
    var adBottom = $(".to-everything").offset().top - 725;
    if($(window).width()>=768){
        if($(window).scrollTop()>=adOffsetTop && $(window).scrollTop()<=adBottom){
            $(".sec .super-eds-adv-container").css("position","fixed");
            $(".sec .super-eds-adv-container").css("top","-2rem");
            $(".sec .super-eds-adv-container").css("right",($(window).width()-$(".sec .container").width())/2);
        }
        else if($(window).scrollTop()<adOffsetTop){
            $(".sec .super-eds-adv-container").css("position","static");
            $(".sec .super-eds-adv-container").css("top","-2rem");
        }
        else if($(window).scrollTop()>adBottom){
            $(".sec .super-eds-adv-container").css("position","fixed");
            $(".sec .super-eds-adv-container").css("top",(adBottom-$(window).scrollTop()-5)+"px");
            $(".sec .super-eds-adv-container").css("right",($(window).width()-$(".sec .container").width())/2);
        }
        $(window).scroll(function(){
            if($(window).scrollTop()>=adOffsetTop && $(window).scrollTop()<=adBottom){
                $(".sec .super-eds-adv-container").css("position","fixed");
                $(".sec .super-eds-adv-container").css("top","-2rem");
                $(".sec .super-eds-adv-container").css("right",($(window).width()-$(".sec .container").width())/2);
            }
            else if($(window).scrollTop()<adOffsetTop){
                $(".sec .super-eds-adv-container").css("position","static");
                $(".sec .super-eds-adv-container").css("top","-2rem");
            }
            else if($(window).scrollTop()>adBottom){
                $(".sec .super-eds-adv-container").css("position","fixed");
                $(".sec .super-eds-adv-container").css("top",(adBottom-$(window).scrollTop()-5)+"px");
                $(".sec .super-eds-adv-container").css("right",($(window).width()-$(".sec .container").width())/2);
            }
        });
    }
    if($(".super-eds-container").length>0 || $(".latest-ads-container").length>0 || $(".similar-ads-container").length>0 || $(".contents").length>0){
        if($(window).width()>=768){
            $(".like").hover(function(){
                if($(this).children("img").attr("src")=="Images/heart-red.svg")
                    $(this).children("img").attr("src","Images/heart-red-full.svg");
            },
            function(){
                if($(this).children("img").attr("src")=="Images/heart-red-full.svg")
                    $(this).children("img").attr("src","Images/heart-red.svg");
            });
        }
        $(".compare").click(function(){
            if($(this).hasClass("compare-active"))
                $(this).removeClass("compare-active");
            else
                $(this).addClass("compare-active");
        });
    }
})
