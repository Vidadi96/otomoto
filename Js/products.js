$(document).ready(function(){
    var offsetTop = $(".ads-container").offset().top;
    $(".title").click(function(e){
        e.preventDefault();
        if($(this).parent().hasClass("active")){
            $(this).parent().removeClass("active");
            offsetTop = $(".ads-container").offset().top;
        }
        else{
            $(this).parent().addClass("active");
            offsetTop = $(".ads-container").offset().top;
        }
    });
    $(".show-more").click(function(e){
        e.preventDefault();
        $(this).css("display","none");
        $(this).parent().css("margin-top","0");
        $(this).parent().children(".drop-dropdown").css("height","auto");
        offsetTop = $(".ads-container").offset().top;
    });
    $(".checkbox a").click(function(e){
        e.preventDefault();
        if($(this).hasClass("selected")){
            $(this).removeClass("selected");
        }
        else{
            $(this).addClass("selected");
        }
        $(this).next().click();
    });
    var selected = $(".checkbox .selected");
    for(let i =0;i<selected.length;i++){
        $(selected[i]).next().click();
    }
    var bottom = $("footer").offset().top - $(".ads-container .ad").height()-50;
    var top = 0;
    if($(window).scrollTop()<=offsetTop){
        $(".ads-container").css("position","static");
        $(".ads-container").css("top","-1rem");
    }
    else if($(window).scrollTop()>=offsetTop && $(window).scrollTop()<=bottom){
        // top = $(window).scrollTop()-offsetTop;
        $(".ads-container").css("position","fixed");
        $(".ads-container").css("top","-1rem");
        // $(".ads-container").css("top",top);
    }
    // else{
    //     top = bottom-offsetTop;
    //     $(".ads-container").css("top",top);
    // }
    $(window).scroll(function(){
        if($(window).scrollTop()<=offsetTop){
            $(".ads-container").css("position","static");
            $(".ads-container").css("top","-1rem");
        }
        else if($(window).scrollTop()>=offsetTop && $(window).scrollTop()<=bottom){
            // top = $(window).scrollTop()-offsetTop;
            $(".ads-container").css("position","fixed");
            $(".ads-container").css("top","-1rem");
            // $(".ads-container").css("top",top);
        }
        // else{
        //     $(".ads-container").css("top",top);
        // }
    })
    if($(window).width()<768){
        $(".filter-container").click(function(){
            $(".side-filter").css("display","block");
        });
        $(".filters-text i").click(function(){
            $(".side-filter").css("display","none");
        });
        $(".sorting-container").click(function(){
            $(".sorting-modal").css("display","block");
            $(".sorting-modal-container").css("margin-top",$(window).height()/2-97);
        });
        $(".sorting-title i").click(function(){
            $(".sorting-modal").css("display","none");
        });
        $(".sorting-modal-container li span").click(function(){
            if(!$(this).hasClass("input-mobile")){
                $(".sorting-modal-container .active").removeClass("active");
                $(this).parent().addClass("active");
                $(this).next().children("input").click();
            }
        })
    }
})