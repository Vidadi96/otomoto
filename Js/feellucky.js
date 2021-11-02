$(document).ready(function(){
let height =0;
$("#emojis").disMojiPicker();
twemoji.parse(document.body);
$(".smile").click(function(e){
    e.preventDefault();
    if($("#emojis").css("display")=="block"){
        $("#emojis").css("display","none");
    }
    else{
        $("#emojis").css("display","block");
    }
});
$("#emojis").picker(
    emoji => {
        var str =$(".message .message-container .input input[type=text]").val() + emoji;
        $(".message .message-container .input input[type=text]").val(str);
        $("#emojis").css("display","none");
    }
);
    $('.owl-carousel').owlCarousel({
        loop:false,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            }
        }
    });
    $(".login").hover(function(){
        if(!$(this).children(".login-container").children("a").hasClass("a")){
            $(this).children(".login-container").children("i").removeClass("fa-angle-down");
            $(this).children(".login-container").children("i").addClass("fa-angle-up");
            $(".login-modal").css("display","block");
            $(".login-dropdown").css("display","block");
            $(".login-container").css("z-index","1051");
        }
        else{
            $(".login-register").css("display","block");
        }
    },
    function(){
         if($(this).children(".login-container").children("a").hasClass("a")){
            $(".login-register").css("display","none");
         }
         else{
            $(this).children(".login-container").children("i").addClass("fa-angle-down");
            $(this).children(".login-container").children("i").removeClass("fa-angle-up");
            $(".login-modal").css("display","none");
            $(".login-dropdown").css("display","none");
         }
    });
    $(".login-register a").click(function(e){
        e.preventDefault();
        $(".login-register").css("display","none");
        $(".login-modal").css("display","block");
        $(".register-dropdown").css("display","block");
        $(".register-dropdown").css("left",$(window).width()/2-236);
        $(".register-dropdown").css("top",($(window).height()-566)/2);
        if(!$(this).hasClass("login-text")){
            $("#register-tab").click();
        }
    });
    $(".login-container i").click(function(e){
        if(!$(this).children("a").hasClass(".a")){
            if($(this).hasClass("fa-angle-down")){
                $(this).removeClass("fa-angle-down");
                $(this).addClass("fa-angle-up");
                $(".login-modal").css("display","block");
                $(".login-dropdown").css("display","block");
                $(".login-container").css("z-index","1051");
            }
            else{
                $(this).addClass("fa-angle-down");
                $(this).removeClass("fa-angle-up");
                $(".login-modal").css("display","none");
                $(".login-dropdown").css("display","none");
            }
        }
    });
    $(".login-container>.a").click(function(e){
        e.preventDefault();
        $(".login-modal").css("display","block");
        $(".register-dropdown").css("display","block");
        $(".register-dropdown").css("left",$(window).width()/2-236);
        $(".register-dropdown").css("top",($(window).height()-566)/2);
    });
    $(".login-modal").click(function(){
        $(".login-container i").addClass("fa-angle-down");
        $(".login-container i").removeClass("fa-angle-up");
        $(".login-modal").css("display","none");
        $(".register-dropdown").css("display","none");
        $(".login-dropdown").css("display","none");
    });
    $(".register-dropdown .name label").click(function(){
        $(this).css("padding-left",0);
        $(this).css("padding-top","0");
        $(this).css("padding-bottom","0");
        $(this).css("border-width","0");
        $(this).next().css("margin-top","1rem");
        $(this).next().css("z-index","1");
        $(this).next().css("opacity","1");
        setTimeout(() => {
            $(this).next().focus();
        }, 1000);
    });
    $(".register-dropdown .password label").click(function(){
        $(this).css("padding-left",0);
        $(this).next().css("margin-top","1rem");
        $(this).next().css("z-index","1");
        $(this).next().css("opacity","1");
        $(this).css("padding-top","0");
        $(this).css("padding-bottom","0");
        $(this).css("border-width","0");
        setTimeout(() => {
            $(this).next().focus();
            $(this).parent().children(".eye").css("display","block");
        }, 1000);
    });
    $(".register-dropdown .phone-email label").click(function(){
        $(this).css("padding-left",0);
        $(this).next().css("margin-top","1rem");
        $(this).next().css("z-index","1");
        $(this).next().css("opacity","1");
        $(this).css("padding-top","0");
        $(this).css("padding-bottom","0");
        $(this).css("border-width","0");
        setTimeout(() => {
            $(this).next().focus();
        }, 1000);
    });
    $(".register-dropdown .re-password label").click(function(){
        $(this).css("transition-duration","1s");
        $(this).css("padding-left",0);
        $(this).next().css("transition-duration","1s");
        $(this).next().css("margin-top","1rem");
        $(this).next().css("z-index","1");
        $(this).next().css("opacity","1");
        $(this).css("padding-top","0");
        $(this).css("padding-bottom","0");
        $(this).css("border-width","0");
        setTimeout(() => {
            $(this).next().focus();
            $(this).parent().children(".eye").css("display","block");
        }, 1000);
    });
    $(".eye").click(function(){
        if($(this).parent().children("input").attr("type")=="password"){
            $(this).parent().children("input").attr("type","text");
        }
        else{
            $(this).parent().children("input").attr("type","password");
        }
    })
    $(".success-modal .error button").click(function(){
        $(".success-modal").html("");
    })
    let categoryId =0;
    if($(".category-eds").length>0){
        $(".categories-container .category").hover(function(){
            var id = $(this).attr("id");
            var idnum = parseInt(id.replace("ca",""));
            var px = (parseInt($(".owl-item").css("width").replace("px",""))+10)* (idnum+5);
            $(".owl-stage").css("transform","translate3d(-" + px +"px, 0px, 0px)");
            if($(".subcategories-container .sub-active").length==0){
                $(".category-container .active").removeClass("active");
                $("#"+id).addClass("active");
            }
        }, function(){});
        var id = $(".category-container .active").attr("id");
        var idnum = parseInt(id.replace("ca",""));
        var width = $(".owl-item").css("width");
        var px = (parseInt(width.replace("px",""))+10)* (idnum+5);
        $(".owl-stage").css("transform","translate3d(-" + px +"px, 0px, 0px)");
        const slider = document.querySelector('.category-container');
        let isDown = false;
        let startX;
        let scrollLeft;
        slider.addEventListener('mousedown', (e) => {
          isDown = true;
          slider.classList.add('dragged');
          startX = e.pageX - slider.offsetLeft;
          scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
          isDown = false;
          slider.classList.remove('dragged');
        });
        slider.addEventListener('mouseup', () => {
          isDown = false;
          slider.classList.remove('dragged');
        });
        slider.addEventListener('mousemove', (e) => {
          if(!isDown) return;
          e.preventDefault();
          const x = e.pageX - slider.offsetLeft;
          const walk = (x - startX) * 3; //scroll-fast
          slider.scrollLeft = scrollLeft - walk;
        });
    }
    else{
        $(".category").hover(function(){
            // var id = $(this).attr("id");
            // if($(".subcategories-container .sub-active").length==0){
            //     $(".category-container .active").removeClass("active");
            //     $("#"+id).addClass("active");
            // }
            // else if($(".subcategories-container .sub-active").length>0){
            //     if($(".subcategories-container ."+categoryId).hasClass("sub-active")){
            //         $(".subcategories-container ."+categoryId).removeClass("sub-active");
            //     }
            //     else{
            //         if($(".subcategories-container .sub-active").length>0){
            //             $(".subcategories-container .sub-active").removeClass("sub-active");
            //         }
            //         $(".subcategories-container ."+categoryId).addClass("sub-active");
            //     }
            // }
            var id = $(this).attr("id");
            if($(".subcategories-container .sub-active").length==0){
                $(".category-container .active").removeClass("active");
                $("#"+id).addClass("active");
            }
        }, function(){});
    }
    $(".barter-login-container .addAd p").click(function(){
        $(".barter-login-container .selected").removeClass("selected");
        $(this).parent().children(".upload-img2").click();
        // $(".barter-login-container .addAd input.upload-img2").click();
        $(this).parent().parent().parent().children(".modal-header").css("display","flex");
    });
    // if($(window).width()>=768){
    $(".category").click(function(){
        categoryId = $(this).attr("id");
        $(".category.active").removeClass("active");
        $(this).addClass("active");
        if($(".subcategories-container ."+categoryId).hasClass("sub-active")){
            $(".subcategories-container ."+categoryId).removeClass("sub-active");
        }
        else{
            if($(".subcategories-container .sub-active").length>0){
                $(".subcategories-container .sub-active").removeClass("sub-active");
            }
            $(".subcategories-container ."+categoryId).addClass("sub-active");
        }
    });
    // }
    var spans = $(".drop-down .select-list span");
    for(var i = 0; i <spans.length; i++){
        if(spans[i].style.backgroundImage==$(".drop-down .button span").css("background-image")){
            spans[i].style.display = "none";
        }
    }
    $(window).scroll(function(){
        if($(window).scrollTop()>=$("main").offset().top){
            $(".to-top p").addClass("visible");
        }
        else{
            $(".to-top p").removeClass("visible");
        }
    });
    $(".to-top").click(function(){
        $(window).scrollTop(0); 
    });
    if($(".mobile-bottom").length>0){
        $(".mobile-bottom .category-container .category").click(function(){
            categoryId = $(this).attr("id");
            $(".mobile-bottom .category-container .category.active").removeClass("active");
            $(this).addClass("active");
        });
    }
    if($(".minichat").length>0){
        $(function(){
            $(".scrollBox-mini").scrollBar({
                position:"x,y",
            });
            $(".scrollBox1").scrollBar({
                position:"x,y",
            });
        });
        $(".minichat .title-container").click(function(){
            if($(".minichat .profiles-container").css("display")=="none"){
                $(".minichat .profiles-container").css("display","block");
            }
            else{
                $(".minichat .profiles-container").css("display","none");
                if($(".minichat .left").css("display")=="block"){
                    $(".minichat .left").css("display","none");
                }
            }
        });
        $(".minichat .bc-profile").click(function(){
            if($(this).hasClass("new")){
                $(this).children(".profile-texts").children(".message-date").children(".new-count").css("display","none");
                $(this).removeClass("new");
            }
            var id = $(this).attr("id");
            $(".minichat .active").removeClass("active");
            $(this).addClass("active");
            $(".minichat .left").css("display","block");
            $(".minichat .messages").css("display","none");
            $(".minichat .left ."+id).css("display","block");
            $(".minichat .profile-image img").attr("src",$(this).children(".profile-photo").children("img").attr("src"));
            $(".minichat .left .profile-texts .name-surname b").text($(this).children(".profile-texts").children(".name-surname").children(".name").children("b").text());
            $(".scrollBox-mini .zl-horizontalBar").parent().css("display","none");
            setTimeout(() => {
                $(".minichat ."+id +" .scrollBox-mini .zl-scrollContentDiv").css("top",-$(".minichat ."+id +" .scrollBox-mini .contentBox").height()+290);
                $(".minichat ."+id +" .scrollBox-mini .zl-verticalBar").css("top",290-$(".minichat ."+id +" .scrollBox-mini .zl-verticalBar").height());
            }, 1000);
        });
        $(".minichat .close").click(function(){
            $(".minichat .left").css("display","none");
        });
    }
    $(".nr").click(function(e){
        e.preventDefault();
        if($(window).width()>768){
            $(".login-container>.a").click();
        }
        else{
            $(".menu-mobile .register-dropdown").css("display","block");
        }
    });
    if($(window).width()<768){
        $(".mobile-bottom .category>a>.image").click(function(e){
            e.preventDefault();
            $(".mobile-bottom .category>.category-modal").css("display","block");
        });
        $(".mobile-logreg").click(function(){
            $(".menu-mobile .register-dropdown").css("display","block");
        });
        $(".mobile-logreg a").click(function(e){
            e.preventDefault();
        });
        $(".category-modal-text img").click(function(){
            $(".mobile-bottom .category>.category-modal").css("display","none");
        });
        $(".register-dropdown").click(function(e){
            if(e.target.className=="register-dropdown"){
                $(".register-dropdown").css("display","none");
            }
        });
        $(".category-modal .category").click(function(){
            var id = $(this).attr("id");
            $(".mobile-bottom .category>.category-modal").css("display","none");
            $(".mobile-bottom .category>.subcategory-modal").css("display","block");
            $(".mobile-bottom .category>.subcategory-modal ."+id+" nav ul li").css("display","block");
            setTimeout(() => {
                $(".mobile-bottom .category>.subcategory-modal .active").removeClass("active");
                $(".mobile-bottom .category>.subcategory-modal .category#"+id).addClass("active");
            }, 10);
        });
        $(".subcategory-modal .category").click(function(){
            var id = $(this).attr("id");
            $(".mobile-bottom .category>.subcategory-modal nav ul li").css("display","none");
            $(".mobile-bottom .category>.subcategory-modal ."+id+" nav ul li").css("display","block");
            setTimeout(() => {
                $(".mobile-bottom .category>.subcategory-modal .active").removeClass("active");
                $(".mobile-bottom .category>.subcategory-modal .category#"+id).addClass("active");
            }, 10);
        });
        $(".subcategory-modal-text img").click(function(){
            $(".mobile-bottom .category>.subcategory-modal").css("display","none");
        });
    }
    $(".col-5 p").click(function(){
        var id = $(this).attr("id");
        $(this).parent().parent().parent().children("."+id).css("display","block");
    });
    $(".modal-header").click(function(){
        $(".barter").css("display","none");
        $(".barter").css("opacity","0");
    })
    $(".like").click(function(){
        if($(this).children("img").attr("src")=="Images/heart-red.svg"){
            $(this).children("img").attr("src","Images/heart-red-full.svg");
        }
        else{
            $(this).children("img").attr("src","Images/heart-red.svg");
        }
    });
})
jQuery().ready(function () {
    jQuery('.drop-down').append('<div class="button"></div>');
    jQuery('.drop-down').append('<ul class="select-list"></ul>');
    jQuery('.drop-down select option').each(function () {
        var bg = jQuery(this).css('background-image');
        jQuery('.select-list').append('<li class="clsAnchor"><span value="' + jQuery(this).val() + '" class="' + jQuery(this).attr('class') + '" style=background-image:' + bg + '>' + jQuery(this).text() + '</span></li>');
    });
    jQuery('.drop-down .button').html('<span style=background-image:' + jQuery('.drop-down select').find(':selected').css('background-image') + '>' + jQuery('.drop-down select').find(':selected').text() + '</span>' + '<p><a href="javascript:void(0);" class="select-list-link"><i class="fas fa-sort-down"></i></a></p>');
    jQuery('.drop-down ul li').each(function () {
        if (jQuery(this).find('span').text() == jQuery('.drop-down select').find(':selected').text()) {
            jQuery(this).addClass('active');
        }
    });
    jQuery('.drop-down .select-list span').on('click', function () {
        var dd_text = jQuery(this).text();
        var dd_img = jQuery(this).css('background-image');
        var dd_val = jQuery(this).attr('value');
        jQuery('.drop-down .button').html('<span style=background-image:' + dd_img + '>' + dd_text + '</span>' + '<p><a href="javascript:void(0);" class="select-list-link"><i class="fas fa-sort-down"></i></a></p>');
        jQuery('.drop-down .select-list span').parent().removeClass('active');
        jQuery(this).parent().addClass('active');
        $('.drop-down select[name=options]').val(dd_val);
        $('.drop-down .select-list li').slideUp();
        var spans = $(".drop-down .select-list span");
        for(var i = 0; i <spans.length; i++){
            if(spans[i].style.backgroundImage==$(".drop-down .button span").css("background-image")){
                spans[i].style.display = "none";
            }
            else{
                spans[i].style.display = "block";
            }
        }
    });
    jQuery('.drop-down .button').on('click', 'a.select-list-link', function () {
        jQuery('.drop-down ul li').slideToggle();
    });
});
function bcProfile(){
    if($(window).width()<768){
        $(".left-side").css("display","none");
        $(".right-side").css("display","block");
        // $('.scrollBox2').animate({ scrollTop: $('.scrollBox2').prop('scrollHeight')}, 1000);
        $(".right-side>.messages-container .contentBox").mCustomScrollbar({
            scrollbarPosition: 'outside'
        });    
        // setTimeout(() => {
            // if(height!=$(".minichat ."+id +" .scrollBox-mini .contentBox").height()){
                $(".right-side>.messages-container .contentBox .mCSB_container").css("top",-$(".right-side>.messages-container .contentBox .mCSB_container").height()+300);
            // }
        // }, 1000);
        // $(".right-side>.messages-container .contentBox .mCSB_1_container").css("top",-$(".right-side>.messages-container .contentBox .mCSB_1_container").css("top")-260);
    }
    else{
        $(function(){
            $(".scrollBox2").scrollBar({
                position:"x,y",
            });
        });
    }
}
function openChat(id){
    var zis = $(".minichat .bc-profile#"+id);
    if($(zis).hasClass("new")){
        $(zis).children(".profile-texts").children(".message-date").children(".new-count").css("display","none");
        $(zis).removeClass("new");
    }
    var id = $(zis).attr("id");
    $(".minichat .active").removeClass("active");
    $(zis).addClass("active");
    $(".minichat .left").css("display","block");
    $(".minichat .messages").css("display","none");
    $(".minichat .left ."+id).css("display","block");
    $(".minichat .profile-image img").attr("src",$(zis).children(".profile-photo").children("img").attr("src"));
    $(".minichat .left .profile-texts .name-surname b").text($(zis).children(".profile-texts").children(".name-surname").children(".name").children("b").text());
    $(".scrollBox-mini .zl-horizontalBar").parent().css("display","none");
    // $('#load_barti_chat'+id.replace("bc","")).load("chatfetch.php").fadeIn("slow");
    // let height = 0;
    // setTimeout(() => {
    //     if(height!=$(".minichat ."+id +" .scrollBox-mini .contentBox").height()){
    //         height = $(".minichat ."+id +" .scrollBox-mini .contentBox").height()
    //         $(".minichat ."+id +" .scrollBox-mini .zl-scrollContentDiv").css("top",-$(".minichat ."+id +" .scrollBox-mini .contentBox").height()+290);
    //         $(".minichat ."+id +" .scrollBox-mini .zl-verticalBar").css("top",290-$(".minichat ."+id +" .scrollBox-mini .zl-verticalBar").height());
    //     }
    // }, 1000);
}
$(".picture").click(function(e){
    e.preventDefault();
})
$(".picture img").click(function(){
    $(".picture input").click();
})
function Close(){
    $(".success-modal").html("");
}