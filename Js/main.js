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
                    $(".right-side>.messages-container").mCustomScrollbar({
	                    scrollbarPosition: 'outside'
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
            $('#load_barti_chat'+id.replace("bc","")).load("chatfetch.php").fadeIn("slow");
            let height = 0;
            setTimeout(() => {
                if(height!=$(".minichat ."+id +" .scrollBox-mini .contentBox").height()){
                    height = $(".minichat ."+id +" .scrollBox-mini .contentBox").height()
                    $(".minichat ."+id +" .scrollBox-mini .zl-scrollContentDiv").css("top",-$(".minichat ."+id +" .scrollBox-mini .contentBox").height()+290);
                    $(".minichat ."+id +" .scrollBox-mini .zl-verticalBar").css("top",290-$(".minichat ."+id +" .scrollBox-mini .zl-verticalBar").height());
                }
            }, 1000);
        }
let category = "";
let subcategory ="";
let model="";
let categoryColor = "";
let categoryImage = "";
let secondCategory = "";
let secondSubcategory ="";
let secondModels;
let secondModelText = "";
let secondCategoryColor = "";
let secondCategoryImage = "";
let thirdCategory = "";
let thirdSubcategory ="";
let thirdModels = [];
let thirdModelText = "";
let thirdCategoryColor = "";
let thirdCategoryImage = "";
var categoryColors = {ca49:"rgba(255,197,0,.2)", ca55:"rgba(161,116,213,.2)", ca28:"rgba(255,112,61,.2)", ca22:"rgba(0,201,198,.2)", ca73:"rgba(67,149,255,.2)", ca16:"rgba(234,47,52,.2)", ca1:"rgba(123,204,253,.2)", ca66:"rgba(0,229,81,.2)", ca62:"rgba(67,149,255,.2)", ca97:"rgba(243,165,0,.2)"};
var categoryImages= {ca49:"Images/neqliyyat.png", ca55:"Images/dasinmaz.png", ca28:"Images/elektronika.png", ca22:"Images/ev ve bag.png", ca73:"Images/xidmetler.png", ca16:"Images/sexsi esyalar.png", ca1:"Images/usaq.png", ca66:"Images/heyvanlar.png", ca62:"Images/is ve biznes.png", ca97:"Images/magazalar.png"};
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop: true,
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
        $(this).css("transition-duration","1s");
        $(this).css("padding-left",0);
        $(this).css("padding-top","0");
        $(this).css("padding-bottom","0");
        $(this).css("border-width","0");
        $(this).next().css("transition-duration","1s");
        $(this).next().css("margin-top","1rem");
        $(this).next().css("z-index","1");
        $(this).next().css("opacity","1");
        setTimeout(() => {
            $(this).next().focus();
        }, 1000);
    });
    $(".register-dropdown .password label").click(function(){
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
    $(".register-dropdown .phone-email label").click(function(){
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

    $(".ads-container .x").click(function(){
        $(".upload-img2").val("");
        $("#blah1").attr("src","");
        $("#blah2").attr("src","");
        $("#blah3").attr("src","");
        $("#blah4").attr("src","");
        $("#blah5").attr("src","");
        $("#blah6").attr("src","");
        $(this).parent().css("display","none");
    });
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
    if($(".to-everything").length>0){
        for(var i =0;i<3;i++){
            $(".to-left").append($(".to-left").html());
            $(".to-right").append($(".to-right").html());
        }
    }
    if($(".super-eds-container").length>0 || $(".latest-ads-container").length>0 || $(".similar-ads-container").length>0 || $(".contents").length>0){
        if($(window).width()>=768){
            $(".like").hover(function(){
                if($(this).children("img").attr("src")=="Images/heart-red.svg"){
                    $(this).children("img").attr("src","Images/heart-red-full.svg");
                }
            },
            function(){
                if($(this).children("img").attr("src")=="Images/heart-red-full.svg"){
                    $(this).children("img").attr("src","Images/heart-red.svg");
                }
            });
        }
        $(".compare").click(function(){
            if($(this).hasClass("compare-active")){
                $(this).removeClass("compare-active");
            }
            else{
                $(this).addClass("compare-active");
            }
        });
    }
    if($(".products-container").length>0){
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
        // var bottom = $(".contents .button").offset().top - $(".ads-container").height()-52;
        // var top = 0;
        // if($(window).scrollTop()<=offsetTop){
        //     $(".ads-container").css("margin-top","1rem");
        // }
        // else if($(window).scrollTop()>=offsetTop && $(window).scrollTop()<=bottom){
        //     top = $(window).scrollTop()-offsetTop;
        //     $(".ads-container").css("margin-top",top);
        // }
        // else{
        //     top = bottom-offsetTop;
        //     $(".ads-container").css("margin-top",top);
        // }
        // $(window).scroll(function(){
        //     if($(window).scrollTop()<=offsetTop){
        //         $(".ads-container").css("margin-top","1rem");
        //     }
        //     else if($(window).scrollTop()>=offsetTop && $(window).scrollTop()<=bottom){
        //         top = $(window).scrollTop()-offsetTop;
        //         $(".ads-container").css("margin-top",top);
        //     }
        //     else{
        //         $(".ads-container").css("margin-top",top);
        //     }
        // })
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
    if($(".product-container").length>0){
        if($(".changing .main-text").height()>$(".changing .product-changing-text").height()){
            $(".changing .product-changing-text").height($(".changing .main-text").height());
        }
        else{
            $(".changing .main-text").height($(".changing .product-changing-text").height());
        }
        if($(".changing .about").height()>$(".changing .product-changing-about").height()){
            $(".changing .product-changing-about").height($(".changing .about").height()-4);
        }
        else{
            $(".changing .about").height($(".changing .product-changing-about").height()+4);
        }
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
                }
            }
        });
        $(".modal .close").click(function(){
            $(".modal").css("display","none");
        });
        $(".mfp-close").click(function(){
            $(".product-container .left .modal").css("opacity","1");
            $(".product-container .left .modal").css("z-index","1051");
            $(".product-container .left .modal").css("display","none");
        });
        $(".product-images .image-container").click(function(){
            $(".product-container .left .modal").css("display","block");
            $(".product-container .left .modal").css("opacity","0");
            $(".product-container .left .modal").css("z-index","-1");
            $(".login-container").css("z-index","1040");
            console.log("."+$(this).attr("id"));
            $("."+$(this).attr("id")).click();
        });
        // $(".submit-container .submit").click(function(){
        //     $(".barter-login").css("top",($(window).height()-417)/2);
        // });
        // $(".barter-login").click(function(e){
        //     if(e.target.class!="barter-login-container"){
        //         $(".barter-login").css("display","none");
        //     }
        // });
        // $(function(){
        //     $(".barter-login-container .ads").scrollBar({
        //         position:"x,y",
        //     });
        // });
        $(".barter-login-container .ads .ad img").click(function(){
            if($(".barter-login-container .addAd input.upload-img2").prop("files").length<=0){
                $(".barter-login-container .selected").removeClass("selected");
                $(this).parent().addClass("selected");
                $(this).parent().children("input").click();
            }
        })
        // $(".vip-premium p").hover(function(){
        //     $(this).css("background-color","#EA2F34");
        //     if($(this).children("a").children("span").children("img").attr("src")=="Images/vip.svg"){
        //         $(this).children("a").children("span").children("img").attr("src","Images/vip-white.svg");
        //     }
        //     else{
        //         $(this).children("a").children("span").children("img").attr("src","Images/crown-white.svg");
        //     }
        //     $(this).children("a").children("span").children("b").css("color","white");
        // },
        // function(){
        //     $(this).css("background-color","white");
        //     if($(this).children("a").children("span").children("img").attr("src")=="Images/vip-white.svg"){
        //         $(this).children("a").children("span").children("img").attr("src","Images/vip.svg");
        //     }
        //     else{
        //         $(this).children("a").children("span").children("img").attr("src","Images/crown.svg");
        //     }
        //     $(this).children("a").children("span").children("b").css("color","#333333");
        // });
        $(".vip-premium p").click(function(){
            $("#myModal").css("display","block");
        });
        $(".vip-premium a").click(function(e){
            e.preventDefault();
        })
        $("#myModal .btn-secondary").click(function(){
            $("#myModal").css("display","none");
        })
        if($(window).width()>=768){
            $(".right-side .user-details .user-detail .user-rating img").hover(function(){
                if(!$(this).hasClass("notHover")){
                    var id = parseInt($(this).attr("id").replace("img",""));
                    for(let i=1;i<=id;i++){
                        $(".right-side .user-details .user-detail .user-rating #img" + i).get(0).src="/Images/filled-star.svg";
                    }
                    for(let i = id+1;i<6;i++){
                        $(".right-side .user-details .user-detail .user-rating #img" + i).get(0).src="/Images/empty-star.svg";
                    }
                }
            },
            function(){
                if(!$(this).parent().hasClass("clicked") && !$(this).hasClass("notHover")){
                    for(let i=1;i<=5;i++){
                        $(".right-side .user-details .user-detail .user-rating #img" + i).get(0).src="/Images/empty-star.svg";
                    }
                }
            });
        }
        $(".right-side .user-details .user-detail .user-rating img").click(function(){
            var id = parseInt($(this).attr("id").replace("img",""));
            $(this).parent().addClass("clicked");
            for(let i=1;i<6;i++){
                if(i<=id){
                    var src = $(".right-side .user-details .user-detail .user-rating #img" + i).attr("src");
                    $(".right-side .user-details .user-detail .user-rating #img" + i).attr("src","/Images/filled-star.svg");
                    // src = $(".right-side .user-details .user-detail .user-rating #img" + i+".img").attr("src");
                    $(".right-side .user-details .user-detail .user-rating #img" + i).get(0).classList.add("notHover");
                }
                else{
                    $(this).addClass("clicked");
                    $(".right-side .user-details .user-detail .user-rating #img" + i).attr("src","/Images/empty-star.svg");
                    $(".right-side .user-details .user-detail .user-rating #img" + i).get(0).classList.add("notHover");
                }
            }
        });
    }
    if($(".addad-container").length>0){
        if($(".no-difference .checkbox").hasClass("checked")){
            $(".third-category").css("display","none");
            $(".second-category").css("display","none");
            $(".no-difference").children("input").click();
        }
        if($(window).width()>=768){
        $(".now-change").click(function(){
    if($(".category .select img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .category .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .category").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .title input").val()=="" || $(".barterFrom .title input").val().length<3 || $(".barterFrom .title input").val().length>55){
        $(".error").css("display","none");
        $(".barterFrom .title .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .title").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .status select").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .status .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .status").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .city select").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .city .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .city").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .cost input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .cost .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .cost").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .desc textarea").val()=="" || $(".barterFrom .desc textarea").val().length < 20){
        $(".error").css("display","none");
        $(".barterFrom .desc .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .desc").offset().top-20
        },'slow');
    }
    else if(($(".barterFrom .photos .input-file")[0].files.length<=0 || $(".barterFrom .photos .input-file")[0].files.length>6) && $(".barterFrom .preview .but1 img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .photos .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .photos").offset().top-20
        },'slow');
    }
    else{
            $(".error").css("display","none");
            $(".buttons .active").removeClass("active");
            $(this).addClass("active");
            $(".barterTo").css("display","block");
            $(".entered-infos").css("display","block");
            $(".ad-style").addClass("d-flex");
            $(".ad-style").removeClass("d-none");
    }
        });
        }
        else{

        $(".now-change").click(function(){
    if($(".category .select img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .category .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .category").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .title input").val()=="" || $(".barterFrom .title input").val().length<3 || $(".barterFrom .title input").val().length>55){
        $(".error").css("display","none");
        $(".barterFrom .title .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .title").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .status input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .status .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .status").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .city input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .city .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .city").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .cost input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .cost .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .cost").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .desc textarea").val()=="" || $(".barterFrom .desc textarea").val().length < 20){
        $(".error").css("display","none");
        $(".barterFrom .desc .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .desc").offset().top-20
        },'slow');
    }
    else if(($(".barterFrom .photos .input-file")[0].files.length<=0 || $(".barterFrom .photos .input-file")[0].files.length>6) && $(".barterFrom .preview .but1 img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .photos .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .photos").offset().top-20
        },'slow');
    }
    else{
            $(".error").css("display","none");
            $(".buttons .active").removeClass("active");
            $(this).addClass("active");
            $(".barterTo").css("display","block");
            $(".entered-infos").css("display","block");
            $(".ad-style").addClass("d-flex");
            $(".ad-style").removeClass("d-none");
    }
        });
        }
        }
        $(".checkbox").click(function(){
            if($(this).hasClass("checked")){
                $(this).removeClass("checked");
                if($(".third-category .select span").length>0){
                    $(".second-category").css("display","flex");
                }
                $(".third-category").css("display","flex");
            }
            else{
                $(this).addClass("checked");
                $(".third-category").css("display","none");
                $(".second-category").css("display","none");
            }
            $(this).parent().children("input").click();
        });
        $(".ad-style span").click(function(){
            if(!$(this).parent().hasClass("checked")){
                $(".ad-style .checked").removeClass("checked");
                $(".ad-style .checked").children("input").click();
                $(this).parent().addClass("checked");
                $(this).parent().children("input").click();
            }
        })
        $(".photo").click(function(){
            $(".input-file").click();
        });
        $(".photo p").click(function(){
            $(".input-file").click();
        });
        $(".addAd-container .btn-submit").click(function(e){
    e.preventDefault();
    var errors = $(".error");
    for(let i = 0; i<errors.length;i++){
        var error = errors[i];
        error.style.display="none";
    }
        var isValid = true;
        if($(".now-change").hasClass("active")){
            if($("input[name='ferq']:checked").length<=0){
                if($(".third-category .select img").length<=0){
                    $(".error").css("display","none");
                    $(".barterTo .third-category .error").css("display","block");
                    $('html,body').animate({
                        scrollTop: $(".barterTo .third-category").offset().top-20
                    },'slow');
                    isValid = false;
                }
                else if($(".third-category .select img").length<=0){
                    $(".error").css("display","none");
                    $(".barterTo .third-category .error").css("display","block");
                    $('html,body').animate({
                        scrollTop: $(".barterTo .third-category").offset().top-20
                    },'slow');
                    isValid = false;
                }
            }
        }
        if(isValid){
            $(".barterForm").submit();
        }
    })
    $("select").change(function(){
        $(this).css("color","#333333");
    })
        // $('#v-pills-tab a').on('click', function (e) {
        //     e.preventDefault();
        //     $(this).tab('show');
        // });
        // $('#v-pills2-tab a').on('click', function (e) {
        //     e.preventDefault();
        //     $(this).tab('show');
        // });
        // $('#v-pills3-tab a').on('click', function (e) {
        //     e.preventDefault();
        //     $(this).tab('show');
        // });
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
    $(".picture").click(function(e){
        e.preventDefault();
    })
    $(".picture img").click(function(){
        $(".picture input").click();
    })
    if($(".bartychat-container").length>0){
        $(".bc-profile").click(function(){
            if($(this).hasClass("new")){
                $(this).children(".profile-texts").children(".message-date").children(".new-count").css("display","none");
                $(this).removeClass("new");
            }
            $(".active").removeClass("active");
            $(this).addClass("active");
        });
        $(function(){
            $(".scrollBox1").scrollBar({
                position:"x,y",
            });
        });
        if($(window).width>=768){
            $(".scrollBox2").scrollBar({
                position:"x,y",
            });
        }
        let height = 0;
        //babash
 setInterval(function(){
  $('#load_barti_chat').load("chatfetch.php").fadeIn("slow");
  //bura mirhebibindi
  if(height!=$(".scrollBox2 .contentBox").height()){
      height = $(".scrollBox2 .contentBox").height();
    $(".scrollBox2 .zl-scrollContentDiv").css("top",-$(".scrollBox2 .contentBox").height()+300);
    $(".scrollBox2 .zl-verticalBar").css("top",300-$(".scrollBox2 .zl-verticalBar").height());
  }
    //end
 }, 1000);
 //babash
    }
    if($(".profile-container").length>0){
        $(".photo img").click(function(){
            $(".add-photo").click();
        });
        $("select").change(function(){
            $(this).css("color","#333333");
        })
    }
    if($(".myads-container").length>0){
        $(".endDate .text span").click(function(){
            $(this).parent().parent().css("display","none");
        });
        $(".myad").hover(function(){
            $(this).children(".endDate").css("display","block");
        },function(){
            $(this).children(".endDate").css("display","none");
        });
    }
    if($(".register-dropdown").length>0){
        $('#myTab a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    }
    if($(".choosenads-container").length>0){
        // $(".endDate").click(function(){
        //     $(this).parent().css("display","none");
        // })
        $(".like-balance .like img").attr("src","Images/heart-red-full.svg")
    }
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
        if($(".products-container").length>0){
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
        if($(".product-container").length>0){
            $(".mobile-carousel").append($(".product-images .part1 a"));
            $(".mobile-carousel").append($(".product-images .part2").children());
            $(".mobile-carousel").addClass("owl-carousel");
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });
            $(".right-side .similar-ads-container").append($(".left-side .similar-ads-container").children());
            if($(window).scrollTop()>=$(".right-side .similar-ads-container").offset().top-$(window).height()){
                $(".barter-bottom").css("display","none");
                $(".mobile-bottom").css("display","block");
            }
            else{
                $(".barter-bottom").css("display","flex");
                $(".mobile-bottom").css("display","none");
            }
            $(window).scroll(function(){
                if($(window).scrollTop()>=$(".right-side .similar-ads-container").offset().top-$(window).height()){
                    $(".barter-bottom").css("display","none");
                    $(".mobile-bottom").css("display","block");
                }
                else{
                    $(".barter-bottom").css("display","flex");
                    $(".mobile-bottom").css("display","none");
                }
            });
        }
        if($(".addad-container").length>0){
            var category = "";
            var subcategory ="";
            var model="";
            var categoryColor = "";
            var categoryImage = "";
            var modelText = "";
            var models = {};
            $(".category .select").click(function(e){
                e.preventDefault();
                category = "";
                subcategory ="";
                model = "";
                $(".mobile .category-modal").css("display","block");
            });
            $(".mobile .category").click(function(){
                category = $(this).children(".name").children("b").text();
                var id = $(this).attr("id");
                $(".mobile .category-modal").css("display","none");
                $(".mobile .subcategory-modal").css("display","block");
                categoryColor = categoryColors[id];
                categoryImage = categoryImages[id];
                $(".mobile .subcategory-modal .category.selected").removeClass("selected");
                $(".mobile .subcategory-modal #"+id).addClass("selected");
                $(".mobile .subcategory-modal .subcategories").css("display","none");
                $(".mobile .subcategory-modal .subcategories."+id).css("display","block");
                $(this).next().click();
            });
            $(".mobile .subcategory-modal nav>ul>li a").click(function(e){
                e.preventDefault();
                $(".mobile .subcategory-modal nav>ul>li a").css("font-weight","bolder");
                $(".mobile .subcategory-modal nav>ul>li a").css("font-family","'RobotoBold',sans-serif");
                $(this).parent().children("nav").css("display","block");
                subcategory = $(this).text();
                $(this).next().click();
                if($(this).parent().children("nav").children("ul").children("li").length==1){
                    if($(this).parent().children("nav").children("ul").children("li").children("b").html()=="" || $(this).parent().children("nav").children("ul").children("li").children("b").html()==null || $(this).parent().children("nav").children("ul").children("li").children("b").html()==undefined){
                        $(".category .select").css("display","block");
                        $(".category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b></span>");
                        $(".category input[name=selected_img]").val(categoryImage);
                        $(".category input[name=selected_cat]").val(category);
                        $(".category input[name=selected_sub]").val(subcategory);
                        $(".category .select .img img").attr("src",categoryImage);
                        $(".category .select").css("background-color",categoryColor);
                        $(".category .select").removeClass("no");
                        $(".category .select").removeClass("yes");
                        $(".mobile .subcategory-modal").css("display","none");
                    }
                }
            })
            $(".mobile .subcategory-modal nav>ul>li nav b").click(function(){
                model = $(this).text();
                $(".category .select").css("display","block");
                $(".category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
                $(".category input[name=selected_img]").val(categoryImage);
                $(".category input[name=selected_cat]").val(category);
                $(".category input[name=selected_sub]").val(subcategory);
                $(".category input[name=selected_subcat]").val(model);
                $(".category .select .img img").attr("src",categoryImage);
                $(".category .select").css("background-color",categoryColor);
                $(".category .select").removeClass("no");
                $(".category .select").removeClass("yes");
                $(".mobile .subcategory-modal").css("display","none");
                $(this).next().click();
            });
            $(".mobile .category-modal-text").click(function(){
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".category>.mobile .category-modal").css("display","none");
                $(".category>.mobile .subcategory-modal").css("display","none");
            });
            $(".mobile .subcategory-modal-text").click(function(){
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".category>.mobile .category-modal").css("display","none");
                $(".category>.mobile .subcategory-modal").css("display","none");
            });
            $(".third-category .select").click(function(e){
                e.preventDefault();
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".third-category>.third-mobile .category-modal").css("display","block");
            });
            $(".third-mobile .category").click(function(){
                category = $(this).children(".name").children("b").text();
                var id = $(this).attr("id");
                $(".third-mobile .category-modal").css("display","none");
                $(".third-mobile .subcategory-modal").css("display","block");
                categoryColor = categoryColors[id];
                categoryImage = categoryImages[id];
                $(".third-mobile .subcategory-modal .category.selected").removeClass("selected");
                $(".third-mobile .subcategory-modal #"+id).addClass("selected");
                $(".third-mobile .subcategory-modal .subcategories").css("display","none");
                $(".third-mobile .subcategory-modal .subcategories."+id).css("display","block");
                $(this).next().click();
            });
            $(".third-mobile .subcategory-modal nav>ul>li a").click(function(e){
                e.preventDefault();
                $(".third-mobile .category-modal").css("display","none");
                $(".third-mobile .subcategory-modal").css("display","block");
                $(".third-mobile .subcategory-modal nav>ul>li nav").css("display","none");
                $(this).parent().children("nav").css("display","block");
                $(".third-mobile .subcategory-modal nav>ul>li a").css("font-weight","bolder");
                $(".third-mobile .subcategory-modal nav>ul>li a").css("font-family","'RobotoBold',sans-serif");
                subcategory = $(this).text();
                $(this).next().click();
            });
            $(".third-mobile .subcategory-modal nav>ul>li nav b").click(function(){
                // if(models.length==3){
                //     alert("Siz maksimum seçim edə bilərsiniz");
                // }
                // else{
                //     if(models.length>3){
                //         alert("Siz maksimum seçim edə bilərsiniz");
                //     }
                //     else{
                //         models.push($(this).text());
                //         if($(this).parent().hasClass("selected")){
                //             $(this).parent().removeClass("selected");
                //         }
                //         else{
                //             $(this).parent().addClass("selected");
                //         }
                //     }
                // }
                model = $(this).text();
                $(".third-mobile .category-modal").css("display","none");
                $(".third-category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
                $(".third-category input[name=selected_img]").val(categoryImage);
                $(".third-category input[name=selected_cat]").val(category);
                $(".third-category input[name=selected_sub]").val(subcategory);
                $(".third-category input[name=selected_subcat]").val(model);
                $(".third-category .select .img img").attr("src",categoryImage);
                $(".third-category .select").css("background-color",categoryColor);
                $(".third-category .select").removeClass("no");
                $(".third-category .select").removeClass("yes");
                $(".third-mobile .subcategory-modal").css("display","none");
                $(".second-category").css("display","block");
                $(".third-mobile .subcategory-modal").css("display","none");
                $(this).next().click();
            });
            // $(".third-mobile .subcategory-modal .next").click(function(){
            //     $(".third-category .select").css("display","block");
            //     for(var i = 0;i<models.length;i++){
            //         modelText += models[i] + ",";
            //     }
            //     modelText = modelText.substring(0,modelText.length-1);
            //     $(".third-category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+modelText+"</b></span>");
            //     $(".category input[name=selected_img]").val(categoryImage);
            //     $(".category input[name=selected_cat]").val(category);
            //     $(".category input[name=selected_sub]").val(subcategory);
            //     $(".category input[name=selected_subcat]").val(model);
            //     $(".third-category .select .img img").attr("src",categoryImage);
            //     $(".third-category .select").css("background-color",categoryColor);
            //     $(".third-category .select").removeClass("no");
            //     $(".third-category .select").removeClass("yes");
            //     $(".third-mobile .subcategory-modal").css("display","none");
            //     $(".second-category").css("display","block");
            // });
            $(".third-mobile .category-modal-text").click(function(){
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".third-category>.third-mobile .category-modal").css("display","none");
                $(".third-category>.third-mobile .subcategory-modal").css("display","none");
            });
            $(".third-mobile .subcategory-modal-text").click(function(){
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".third-category>.third-mobile .category-modal").css("display","none");
                $(".third-category>.third-mobile .subcategory-modal").css("display","none");
            });
            $(".second-category .select").click(function(e){
                e.preventDefault();
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".second-category>.second-mobile .category-modal").css("display","block");
            });
            $(".second-mobile .category").click(function(){
                category = $(this).children(".name").children("b").text();
                var id = $(this).attr("id");
                $(".second-mobile .category-modal").css("display","none");
                $(".second-mobile .subcategory-modal").css("display","block");
                categoryColor = categoryColors[id];
                categoryImage = categoryImages[id];
                $(".second-mobile .subcategory-modal .category.selected").removeClass("selected");
                $(".second-mobile .subcategory-modal #"+id).addClass("selected");
                $(".second-mobile .subcategory-modal .subcategories").css("display","none");
                $(".second-mobile .subcategory-modal .subcategories."+id).css("display","block");
                $(this).next().click();
            });
            $(".second-mobile .subcategory-modal nav>ul>li a").click(function(e){
                e.preventDefault();
                $(".second-mobile .category-modal").css("display","none");
                $(".second-mobile .subcategory-modal").css("display","block");
                $(".second-mobile .subcategory-modal nav>ul>li nav").css("display","none");
                $(this).parent().children("nav").css("display","block");
                $(".second-mobile .subcategory-modal nav>ul>li a").css("font-weight","bolder");
                $(".second-mobile .subcategory-modal nav>ul>li a").css("font-family","'RobotoBold',sans-serif");
                subcategory = $(this).text();
                $(this).next().click();
            })
            $(".second-mobile .subcategory-modal nav>ul>li nav b").click(function(){
                // if(models.length==3){
                //     alert("Siz maksimum seçim edə bilərsiniz");
                // }
                // else{
                //     models.push($(this).text());
                //     if($(this).parent().hasClass("selected")){
                //         $(this).parent().removeClass("selected");
                //     }
                //     else{
                //         $(this).parent().addClass("selected");
                //     }
                // }
                model = $(this).text();
                $(".second-mobile .category-modal").css("display","none");
                $(".second-category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
                $(".second-category input[name=selected_img]").val(categoryImage);
                $(".second-category input[name=selected_cat]").val(category);
                $(".second-category input[name=selected_sub]").val(subcategory);
                $(".second-category input[name=selected_subcat]").val(model);
                $(".second-category .select .img img").attr("src",categoryImage);
                $(".second-category .select").css("background-color",categoryColor);
                $(".second-category .select").removeClass("no");
                $(".second-category .select").removeClass("yes");
                $(".second-mobile .subcategory-modal").css("display","none");
                $(this).next().click();
            });
            // $(".second-mobile .subcategory-modal .next").click(function(){
            //     $(".second-category .select").css("display","block");
            //     for(var i = 0;i<models.length;i++){
            //         modelText += models[i] + ",";
            //     }
            //     modelText = modelText.substring(0,modelText.length-1);
            //     $(".second-category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+modelText+"</b></span>");
            //     $(".second-category .select .img img").attr("src",categoryImage);
            //     $(".second-category .select").css("background-color",categoryColor);
            //     $(".second-category .select").removeClass("no");
            //     $(".second-category .select").removeClass("yes");
            //     $(".second-mobile .subcategory-modal").css("display","none");
            // });
            $(".second-mobile .category-modal-text").click(function(){
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".second-category>.second-mobile .category-modal").css("display","none");
                $(".second-category>.second-mobile .subcategory-modal").css("display","none");
            });
            $(".second-mobile .subcategory-modal-text").click(function(){
                category = "";
                subcategory ="";
                models = [];
                modelText = "";
                $(".second-category>.second-mobile .category-modal").css("display","none");
                $(".second-category>.second-mobile .subcategory-modal").css("display","none");
            });
            $(".category-details>div .select").click(function(){
                $(this).parent().children(".select-mobile").children(".text").children(".mx-auto").html($(this).parent().children("p.col-md-3").children("b").text().replace("*",""));
                $(this).parent().children(".select-mobile").css("right","0");
                $(this).parent().children(".select-mobile").css("transition-duration","1s");
            });
            $(".category-details>div .text img").click(function(){
                $(this).parent().parent().parent().css("right","-100%");
                $(this).parent().parent().parent().css("transition-duration","1s");
            });
            $(".category-details>div .select-mobile li").click(function(){
                $(this).parent().children("input").attr("value",$(this).attr("class"));
                $(this).parent().parent().parent().parent().children(".select").html($(this).html());
                $(this).parent().parent().parent().css("right","-100%");
                $(this).parent().parent().parent().css("transition-duration","1s");
                $(this).parent().parent().parent().parent().children(".select").css("color","#383737");
            });
            $(".barterFrom>div .select").click(function(){
                if($(this).parent().children(".select-mobile").length>0){
                    $(this).parent().children(".select-mobile").children(".text").children(".mx-auto").html($(this).parent().children("p.col-md-3").children("b").text().replace("*",""));
                    $(this).parent().children(".select-mobile").css("right","0");
                    $(this).parent().children(".select-mobile").css("transition-duration","1s");
                }
            });
            $(".barterFrom>div .text img").click(function(){
                $(this).parent().parent().parent().css("right","-100%");
                $(this).parent().parent().parent().css("transition-duration","1s");
            });
            $(".barterFrom>div .select-mobile li").click(function(){
                $(this).parent().children("input").attr("value",$(this).attr("class"));
                $(this).parent().parent().parent().parent().children(".select").html($(this).html());
                $(this).parent().parent().parent().css("right","-100%");
                $(this).parent().parent().parent().css("transition-duration","1s");
                $(this).parent().parent().parent().parent().children(".select").css("color","#383737");
            });
            // $(".charity").click(function(){
            //     $(".buttons .active").removeClass("active");
            //     $(this).addClass("active");
            //     $(".barterTo").css("display","none");
            //     $(".entered-infos").css("display","block");
            //     $(".ad-style").removeClass("d-flex");
            //     $(".ad-style").addClass("d-none");
            // });
        }
        if($(".profile-container").length>0){
            $(".container").css("padding","0");
            $(".social-text").click(function(){
                if($(".social-container").css("display")=="block"){
                    $(".social-text img").css("transform","rotate(0deg)");
                    $(".social-text img").css("transition-duration","1s");
                    $(".social-container").css("display","none");
                }
                else{
                    $(".social-text img").css("transform","rotate(90deg)");
                    $(".social-text img").css("transition-duration","1s");
                    $(".social-container").css("display","block");
                }
            });
            $(".password-text").click(function(){
                if($(".password-container").css("display")=="block"){
                    $(".password-text img").css("transform","rotate(0deg)");
                    $(".password-text img").css("transition-duration","1s");
                    $(".password-container").css("display","none");
                }
                else{
                    $(".password-text img").css("transform","rotate(90deg)");
                    $(".password-text img").css("transition-duration","1s");
                    $(".password-container").css("display","block");
                }
            });
            $(".profile .name input").val($(".profile .name p").text());
            $(".profile .surname input").val($(".profile .surname p").text());
            $(".contact .email input").val($(".contact .email p").text());
            $(".profile .name p").click(function(){
                $(".profile .surname p").css("display","block");
                $(".profile .surname input").css("display","none");
                $(".profile .surname p").html($(".profile .surname input").val());
                $(".contact .email p").css("display","block");
                $(".contact .email input").css("display","none");
                $(".contact .email p").html($(".contact .email input").val());
                $(".contact .phone p").css("display","block");
                $(".phone-container").css("display","none");
                var html = $(".phone-container select option:selected").text();
                var number = $(".phone-container input").val();
                $(".contact .phone p").html(html+number);
                $(".contact .phone p").css("display","block");
                $(this).css("display","none");
                $(".profile .name input").css("display","block");
                $(".profile .name input").val($(this).text());
                $(".profile .name input").focus();
            });
            $(".profile .surname p").click(function(){
                $(".profile .name p").css("display","block");
                $(".profile .name input").css("display","none");
                $(".profile .name p").html($(".profile .name input").val());
                $(".contact .email p").css("display","block");
                $(".contact .email input").css("display","none");
                $(".contact .email p").html($(".contact .email input").val());
                $(".phone-container").css("display","none");
                var html = $(".phone-container select option:selected").text();
                var number = $(".phone-container input").val();
                $(".contact .phone p").html(html+number);
                $(".contact .phone p").css("display","block");
                $(this).css("display","none");
                $(".profile .surname input").css("display","block");
                $(".profile .surname input").val($(this).text());
                $(".profile .surname input").focus();
            });
            $(".profile .city select").click(function(){
                $(".profile .name p").css("display","block");
                $(".profile .name input").css("display","none");
                $(".profile .name p").html($(".profile .name input").val());
                $(".contact .email p").css("display","block");
                $(".contact .email input").css("display","none");
                $(".contact .email p").html($(".contact .email input").val());
                $(".profile .surname p").css("display","block");
                $(".profile .surname input").css("display","none");
                $(".profile .surname p").html($(".profile .surname input").val());
                $(".phone-container").css("display","none");
                var html = $(".phone-container select option:selected").text();
                var number = $(".phone-container input").val();
                $(".contact .phone p").html(html+number);
                $(".contact .phone p").css("display","block");
            })
            $(".contact .phone p").click(function(){
                $(".profile .name p").css("display","block");
                $(".profile .name input").css("display","none");
                $(".profile .name p").html($(".profile .name input").val());
                $(".contact .email p").css("display","block");
                $(".contact .email input").css("display","none");
                $(".contact .email p").html($(".contact .email input").val());
                $(".profile .surname p").css("display","block");
                $(".profile .surname input").css("display","none");
                $(".profile .surname p").html($(".profile .surname input").val());
                $(this).css("display","none");
                $(".phone-container").css("display","flex");
                var options = $(".phone-container select option");
                var text = "";
                for(var i =0;i<options.length;i++){
                    if($(this).text().indexOf(options[i].innerHTML) != -1){
                        text = $(this).text().replace(options[i].innerHTML,"");
                        break;
                    }
                }
                $(".phone-container input").val(text);
                $("..phone-container input").focus();
            });
            $(".contact .email p").click(function(){
                $(".profile .name p").css("display","block");
                $(".profile .name input").css("display","none");
                $(".profile .name p").html($(".profile .name input").val());
                $(".profile .surname p").css("display","block");
                $(".profile .surname input").css("display","none");
                $(".profile .surname p").html($(".profile .surname input").val());
                $(".phone-container").css("display","none");
                var html = $(".phone-container select option:selected").text();
                var number = $(".phone-container input").val();
                $(".contact .phone p").html(html+number);
                $(".contact .phone p").css("display","block");
                $(this).css("display","none");
                $(".contact .email input").css("display","block");
                $(".contact .email input").val($(this).text());
                $(".contact .email input").focus();
            });
        }
        if($(".bartychat-container").length>0){
            $(".back").click(function(){
                $(".left-side").css("display","block");
                $(".right-side").css("display","none");
            })
        }
        if($(".feel-lucky-container").length>0){
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
        }
    }
})
function Change(sub,sc){
    $(".category>.modal .subcategories.column-active").removeClass("column-active");
    $(".category>.modal .subcategories .selected").removeClass("selected");
    $(this).addClass("selected");
    $(".category>.modal .models").addClass("column-active");
    $(".category>.modal .models").css("display","block");
    subcategory=sub;
    $(".category>.modal input."+sc).click();
    $(".category .secondModal-text input").focus();
}
function ChangeModel(mod){
    $(".category>.modal .subcategories").addClass("column-active");
    $(".category>.modal .models").removeClass("column-active");
    $(".category>.modal .models").css("display","none");
    $(".category>.modal>.modal-categories").css("display","block");
    $(".category>.modal .secondModal").css("display","none");
    $(".category>.modal").css("display","none");
    model=mod;
    $(".category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
    $(".category input[name=selected_img]").val(categoryImage);
    $(".category input[name=selected_cat]").val(category);
    $(".category input[name=selected_sub]").val(subcategory);
    $(".category input[name=selected_subcat]").val(model);
    $(".category .select .img img").attr("src",categoryImage);
    $(".category .select").css("background-color",categoryColor);
    $(".category .select").removeClass("no");
    $(".category .select").removeClass("yes");
    $(".category-details").css("display","block");
    $(".category .secondModal-text input").focus();
}
function ChangeNotSub(sub,sc){
    $(".category>.modal .models").css("display","none");
    $(".category>.modal>.modal-categories").css("display","block");
    $(".category>.modal .secondModal").css("display","none");
    $(".category>.modal").css("display","none");
    subcategory=sub;
    $(".category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b></span>");
    $(".category input[name=selected_img]").val(categoryImage);
    $(".category input[name=selected_cat]").val(category);
    $(".category input[name=selected_sub]").val(subcategory);
    $(".category .select .img img").attr("src",categoryImage);
    $(".category .select").css("background-color",categoryColor);
    $(".category .select").removeClass("no");
    $(".category .select").removeClass("yes");
    $(".category-details").css("display","block");
    $(".category>.modal input."+sc).click();
}
function ChangeSecond(ss,sc){
    $(".second-category>.second-modal input."+sc).click();
    $(".second-category>.second-modal .subcategories").removeClass("column-active");
    $(this).addClass("selected");
    $(".second-category>.second-modal .models").addClass("column-active");
    $(".second-category>.second-modal .models").css("display","block");
    secondSubcategory=ss;
    $(".second-category .secondModal-text input").focus();
}
 function ChangeSecondModel(sm){
//     if(secondModels.length==3){
//         alert("Maksimum 3 model seçə bilərsiz");
//     }
//     else{
//         secondModels.push($(this).text());
//         $(this).addClass("checked");
//     }
    secondModelText = sm;
        $(".second-category>.second-modal .subcategories").addClass("column-active");
        $(".second-category>.second-modal .models").removeClass("column-active");
        $(".second-category>.second-modal .models").css("display","none");
        $(".second-modal-categories").css("display","block");
        $(".second-category>.second-modal .secondModal").css("display","none");
        $(".second-category>.second-modal").css("display","none");
        // for(var i = 0; i<secondModels.length;i++){
        //     if(i>0){
        //         secondModelText+=",";
        //     }
        //     secondModelText+=secondModels[i];
        // }
        $(".second-category .select").html("<span class='img'><img src="+secondCategoryImage+"></span><span><b>"+secondCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondSubcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondModelText+"</b></span>");
        $(".second-category input[name=selected_img2]").val(secondCategoryImage);
        $(".second-category input[name=selected_cat2]").val(secondCategory);
        $(".second-category input[name=selected_sub2]").val(secondSubcategory);
        $(".second-category input[name=selected_subcat2]").val(secondModelText);
        $(".second-second-category .select .img img").attr("src",secondCategoryImage);
        $(".second-category .select").css("background-color",secondCategoryColor);
        $(".second-category .select").removeClass("no");
        $(".second-category .select").removeClass("yes");
        $(".second-category .selected").removeClass("selected");
        $(".second-category .secondModal-text input").focus();
}
function ChangeSecondNotSub(sns,sc){
    $(".second-category>.second-modal input."+sc).click();
    $(".category>.second-modal .models").css("display","none");
    $(".second-category>.second-modal>.second-modal-categories").css("display","block");
    $(".second-category>.second-modal .secondModal").css("display","none");
    $(".second-category>.second-modal").css("display","none");
    secondSubcategory=sns;
    $(".second-category .select").html("<span class='img'><img src="+secondCategoryImage+"></span><span><b>"+secondCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondSubcategory+"</b></span>");
    $(".second-category input[name=selected_img2]").val(secondCategoryImage);
    $(".second-category input[name=selected_cat2]").val(secondCategory);
    $(".second-category input[name=selected_sub2]").val(secondSubcategory);
    $(".second-category .select .img img").attr("src",secondCategoryImage);
    $(".second-category .select").css("background-color",secondCategoryColor);
    $(".second-category .select").removeClass("no");
    $(".second-category .select").removeClass("yes");
}
function ChangeThird(ts,sc){
    $(".third-category>.third-modal .subcategories").removeClass("column-active");
    $(this).addClass("selected");
    $(".third-category>.third-modal .models").addClass("column-active");
    $(".third-category>.third-modal .models").css("display","block");
    thirdSubcategory=ts;
    $(".third-category>.third-modal input."+sc).click();
    $(".third-category .secondModal-text input").focus();
}
function ChangeThirdModel(tm){
    // if(thirdModels.length==3){
    //     alert("Maksimum 3 model seçə bilərsiz");
    // }
    // else{
    //     thirdModels.push(tm);
    //     $(this).addClass("checked");
    // }
    thirdModelText = tm;
        $(".third-category>.third-modal .subcategories").addClass("column-active");
        $(".third-category>.third-modal .models").removeClass("column-active");
        $(".third-category>.third-modal .models").css("display","none");
        $(".third-modal-categories").css("display","block");
        $(".third-category>.third-modal .secondModal").css("display","none");
        $(".third-category>.third-modal").css("display","none");
        // for(var i = 0; i<thirdModels.length;i++){
        //     if(i>0){
        //         thirdModelText+=",";
        //     }
        //     thirdModelText+=thirdModels[i];
        // }
        $(".third-category .select").html("<span class='img'><img src="+thirdCategoryImage+"></span><span><b>"+thirdCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdSubcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdModelText+"</b></span>");
        $(".third-category input[name=selected_img1]").val(thirdCategoryImage);
        $(".third-category input[name=selected_cat1]").val(thirdCategory);
        $(".third-category input[name=selected_sub1]").val(thirdSubcategory);
        $(".third-category input[name=selected_subcat1]").val(thirdModelText);
        $(".third-category .select .img img").attr("src",thirdCategoryImage);
        $(".third-category .select").css("background-color",thirdCategoryColor);
        $(".second-modal").css("display","block");
        $(".second-modal-categories").css("margin-top",($(window).height()-$(".second-modal-categories").height()-66)/2);
        secondCategory = "";
        secondSubcategory ="";
        secondModel = "";
        $(".second-modal").css("display","none");
        $(".second-category").css("display","flex");
        $(".third-category .select").removeClass("no");
        $(".third-category .select").removeClass("yes");
        $(".third-category .selected").removeClass("selected");
        $(".third-category .secondModal-text input").focus();
}
function ChangeThirdNotSub(tns,sc){
    $(".third-category>.third-modal input."+sc).click();
    $(".category>.third-modal .models").css("display","none");
    $(".third-category>.third-modal>.third-modal-categories").css("display","block");
    $(".third-category>.third-modal .secondModal").css("display","none");
    $(".third-category>.third-modal").css("display","none");
    thirdSubcategory=tns;
    $(".third-category .select").html("<span class='img'><img src="+thirdCategoryImage+"></span><span><b>"+thirdCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdSubcategory+"</b></span>");
    $(".third-category input[name=selected_img2]").val(thirdCategoryImage);
    $(".third-category input[name=selected_cat2]").val(thirdCategory);
    $(".third-category input[name=selected_sub2]").val(thirdSubcategory);
    $(".third-category .select .img img").attr("src",thirdCategoryImage);
    $(".third-category .select").css("background-color",thirdCategoryColor);
    $(".third-category .select").removeClass("no");
    $(".third-category .select").removeClass("yes");
    $(".second-category").css("display","flex");
}
if($(window).width()>=768){
    //First Modal
    $(".category>.modal").css("display","block");
    $(".category>.modal>.modal-categories").css("margin-top",($(window).height()-$(".category>.modal>.modal-categories").height()-66)/2);
    $(".category>.modal").css("display","none");
    $(".category>.modal .ca").click(function(){
        var id = $(this).attr("id");
        $(".modal .categories-container .active").removeClass("active");
        $(".modal ."+id).addClass("active");
        $(this).parent().children("input."+id).click();
        $(".modal .modal-categories").css("display","none");
        $(".modal .secondModal").css("display","block");
        $(".category>.modal .secondModal .subcategories.active").removeClass("active");
        $(".category>.modal .secondModal .subcategories.active").removeClass("show");
        $(".modal .secondModal #v-pills-"+id).addClass("active");
        $(".modal .secondModal #v-pills-"+id).addClass("show");
        $(".modal .secondModal").css("margin-top",($(window).height()-$(".modal .secondModal").height()-66)/2);
        category=$(this).children("p").text();
        categoryColor = categoryColors[id];
        categoryImage = categoryImages[id];
        $(".category .secondModal-text input").focus();
    });
    $(function(){
        $(".scrollBox1").scrollBar({
            position:"x,y",
            wheelDis:3
        });
        $(".scrollBox2").scrollBar({
            position:"x,y",
            wheelDis:3
        });
        $(".scrollBox3").scrollBar({
            position:"x,y",
            wheelDis:3
        });
    });
    $(".category>.modal .categories-container>a").click(function(e){
        e.preventDefault();
        if(!$(this).hasClass("active")){
            var id = $(this).attr("class").replace(" nav-link","");
            $(this).next().click();
            $("#modalpreview").html("");
            $(".category>.modal .subcategories.active").removeClass("active");
            $(this).tab('show');
            $(".category>.modal .nav-link.active").removeClass("active");
            $(this).addClass("active");
            category=$(this).children("#text").text();
            categoryColor = categoryColors[id];
            categoryImage = categoryImages[id];
            $(".category .secondModal-text input").focus();
        }
    });
    // $(".category>.modal .subcategory").click(function(){
    //     $(".category>.modal .subcategories.column-active").removeClass("column-active");
    //     $(".category>.modal .subcategories .selected").removeClass("selected");
    //     $(this).addClass("selected");
    //     $(".category>.modal .models").addClass("column-active");
    //     $(".category>.modal .models").css("display","block");
    //     subcategory=$(this).children(".text").text();
    // });
    $(".category>.modal .secondModal .model").click(function(){
        $(".category>.modal .subcategories").addClass("column-active");
        $(".category>.modal .models").removeClass("column-active");
        $(".category>.modal .models").css("display","none");
        $(".category>.modal>.modal-categories").css("display","block");
        $(".category>.modal .secondModal").css("display","none");
        $(".category>.modal").css("display","none");
        model=$(this).text();
        $(".category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
        $(".category .select .img img").attr("src",categoryImage);
        $(".category .select").css("background-color",categoryColor);
        $(".category .select").removeClass("no");
        $(".category .select").removeClass("yes");
        $(".category .selected").removeClass("selected");
        $(".category-details").css("display","block");
        $(".category .secondModal-text input").focus();
    });
    $(".category .select").click(function(e){
        e.preventDefault();
        category = "";
        subcategory ="";
        models = [];
        modelText = "";
        $(".category>.modal").css("display","block");
    });
    $(".category>.modal .close").click(function(){
        category = "";
        subcategory ="";
        models = [];
        modelText = "";
        categoryColor = "";
        categoryImage = "";
        $(".subcategories").addClass("column-active");
        $(".models").removeClass("column-active");
        $(".models").css("display","none");
        $(".modal-categories").css("display","block");
        $(".secondModal").css("display","none");
        $(".category>.modal").css("display","none");
        $(".category .selected").removeClass("selected");
    });
    // $(".category>.modal .notsub").click(function(){
    //     $(".category>.modal .models").css("display","none");
    //     $(".category>.modal>.modal-categories").css("display","block");
    //     $(".category>.modal .secondModal").css("display","none");
    //     $(".category>.modal").css("display","none");
    //     subcategory=$(this).children(".text").text();
    //     $(".category .select").html("<span class='img'><img src="+categoryImage+"></span><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b></span>");
    //     $(".category .select .img img").attr("src",categoryImage);
    //     $(".category .select").css("background-color",categoryColor);
    //     $(".category .select").removeClass("no");
    //     $(".category .select").removeClass("yes");
    //     $(".category-details").css("display","block");
    //     $(".category .selected").removeClass("selected");
    // })
    //Second Modal
    $(".second-category>.second-modal").css("display","block");
    $(".second-modal-categories").css("margin-top",($(window).height()-$(".second-modal-categories").height()-66)/2);
    $(".second-category>.second-modal").css("display","none");
    $(".second-category>.second-modal .ca").click(function(){
        var id = $(this).attr("id");
        $(".second-category>.second-modal .categories-container .active").removeClass("active");
        $(".second-category>.second-modal ."+id).addClass("active");
        $(this).parent().children("input."+id.replace("ca","")).click();
        $(".second-modal-categories").css("display","none");
        $(".second-category>.second-modal .secondModal").css("display","block");
        $(".second-category>.second-modal .secondModal .subcategories.active").removeClass("active");
        $(".second-category>.second-modal .secondModal .subcategories.active").removeClass("show");
        $(".second-category>.second-modal .secondModal #v-pills3-"+id).addClass("active");
        $(".second-category>.second-modal .secondModal #v-pills3-"+id).addClass("show");
        $(".second-category>.second-modal .secondModal").css("margin-top",($(window).height()-$(".second-category>.second-modal .secondModal").height()-66)/2);
        secondCategoryColor = categoryColors[id];
        secondCategoryImage = categoryImages[id];
        secondCategory=$(this).children("p").text();
        $(".second-category .secondModal-text input").focus();
    });
    $(".second-category>.second-modal .categories-container>a").click(function(e){
        e.preventDefault();
        if(!$(this).hasClass("active")){
            var id = $(this).attr("class").replace(" nav-link","");
            $(this).next().click();
            $("#modalpreview3").html("");
            $(".second-category>.second-modal .subcategories.active").removeClass("active");
            $(this).tab('show');
            $(".second-category>.second-modal .nav-link.active").removeClass("active");
            $(this).addClass("active");
            secondCategory=$(this).children("#text").text();
            secondCategoryColor = categoryColors[id];
            secondCategoryImage = categoryImages[id];
            $(".second-category .secondModal-text input").focus();
        }
    });
    $(".second-category>.second-modal .subcategory").click(function(){
        $(".second-category>.second-modal .subcategories").removeClass("column-active");
        $(this).addClass("selected");
        $(".second-category>.second-modal .models").addClass("column-active");
        $(".second-category>.second-modal .models").css("display","block");
        secondSubcategory=$(this).children(".text").text();
        $(".second-category .secondModal-text input").focus();
    });
    // $(".second-category>.second-modal .secondModal .next").click(function(){
    //     $(".second-category>.second-modal .subcategories").addClass("column-active");
    //     $(".second-category>.second-modal .models").removeClass("column-active");
    //     $(".second-category>.second-modal .models").css("display","none");
    //     $(".second-modal-categories").css("display","block");
    //     $(".second-category>.second-modal .secondModal").css("display","none");
    //     $(".second-category>.second-modal").css("display","none");
    //     // for(var i = 0; i<secondModels.length;i++){
    //     //     if(i>0){
    //     //         secondModelText+=",";
    //     //     }
    //     //     secondModelText+=secondModels[i];
    //     // }
    //     $(".second-category .select").html("<span class='img'><img src="+secondCategoryImage+"></span><span><b>"+secondCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondSubcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondModelText+"</b></span>");
    //     $(".second-category .select .img img").attr("src",secondCategoryImage);
    //     $(".second-category .select").css("background-color",secondCategoryColor);
    //     $(".second-category .select").removeClass("no");
    //     $(".second-category .select").removeClass("yes");
    //     $(".second-category .selected").removeClass("selected");
    // });
    $(".second-category>.second-modal .secondModal .model").click(function(){
        if(secondModels.length==3){
            alert("Maksimum 3 model seçə bilərsiz");
        }
        else{
            secondModels.push($(this).text());
            $(this).addClass("checked");
        }
        $(".second-category .secondModal-text input").focus();
    });
    $(".second-category .select").click(function(e){
        e.preventDefault();
        secondCategory = "";
        secondSubcategory ="";
        secondModels=[];
        secondModelText = "";
        secondCategoryColor = "";
        secondCategoryImage = "";
        $(".second-category>.second-modal").css("display","block");
        $(".second-modal-categories").css("margin-top",($(window).height()-$(".second-modal-categories").height()-66)/2);
        $(".second-category>.second-modal").css("display","none");
        $(".second-category").css("display","flex");
        $(".second-category>.second-modal").css("display","block");
    });
    $(".second-category>.second-modal .close").click(function(){
        secondCategory = "";
        secondSubcategory ="";
        secondModels=[];
        secondModelText = "";
        secondCategoryColor = "";
        secondCategoryImage = "";
        $(".second-category>.second-modal .subcategories").addClass("column-active");
        $(".second-category>.second-modal .models").removeClass("column-active");
        $(".second-category>.second-modal .models").css("display","none");
        $(".second-category .second-modal-categories").css("display","block");
        $(".second-category>.second-modal .secondModal").css("display","none");
        $(".second-category>.second-modal").css("display","none");
        $(".second-category .selected").removeClass("selected");
    });
    $(".second-category>.second-modal .notsub").click(function(){
        $(".category>.second-modal .models").css("display","none");
        $(".second-category>.second-modal>.second-modal-categories").css("display","block");
        $(".second-category>.second-modal .secondModal").css("display","none");
        $(".second-category>.second-modal").css("display","none");
        secondSubcategory=$(this).children(".text").text();
        $(".second-category .select").html("<span class='img'><img src="+secondCategoryImage+"></span><span><b>"+secondCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondSubcategory+"</b></span>");
        $(".second-category .select .img img").attr("src",secondCategoryImage);
        $(".second-category .select").css("background-color",secondCategoryColor);
        $(".second-category .select").removeClass("no");
        $(".second-category .select").removeClass("yes");
        $(".second-category .selected").removeClass("selected");
    });
    //Third Modal
    $(".third-category>.third-modal").css("display","block");
    $(".third-modal-categories").css("margin-top",($(window).height()-$(".third-modal-categories").height()-66)/2);
    $(".third-category>.third-modal").css("display","none");
    $(".third-category>.third-modal .ca").click(function(){
        var id = $(this).attr("id");
        $(".third-category>.third-modal .categories-container .active").removeClass("active");
        $(".third-category>.third-modal ."+id).addClass("active");
        $(this).parent().children("input."+id.replace("ca","")).click();
        $(".third-modal-categories").css("display","none");
        $(".third-category>.third-modal .secondModal").css("display","block");
        $(".third-category>.third-modal .secondModal .subcategories.active").removeClass("active");
        $(".third-category>.third-modal .secondModal .subcategories.active").removeClass("show");
        $(".third-category>.third-modal .secondModal #v-pills2-"+id).addClass("active");
        $(".third-category>.third-modal .secondModal #v-pills2-"+id).addClass("show");
        $(".third-category>.third-modal .secondModal").css("margin-top",($(window).height()-$(".third-category>.third-modal .secondModal").height()-66)/2);
        thirdCategoryColor = categoryColors[id];
        thirdCategoryImage = categoryImages[id];
        thirdCategory=$(this).children("p").text();
        $(".third-category .secondModal-text input").focus();
    });
    $(".third-category>.third-modal .categories-container>a").click(function(e){
        e.preventDefault();
        if(!$(this).hasClass("active")){
            var id = $(this).attr("class").replace(" nav-link","");
            $(this).next().click();
            $("#modalpreview2").html("");
            $(".second-category>.second-modal .subcategories.active").removeClass("active");
            $(this).tab('show');
            $(".second-category>.second-modal .nav-link.active").removeClass("active");
            $(this).addClass("active");
            thirdCategory=$(this).children("#text").text();
            thirdCategoryColor = categoryColors[id];
            thirdCategoryImage = categoryImages[id];
            $(".third-category .secondModal-text input").focus();
        }
    });
    $(".third-category>.third-modal .subcategory").click(function(){
        $(".third-category>.third-modal .subcategories").removeClass("column-active");
        $(this).addClass("selected");
        $(".third-category>.third-modal .models").addClass("column-active");
        $(".third-category>.third-modal .models").css("display","block");
        thirdSubcategory=$(this).children(".text").text();
        $(".third-category .secondModal-text input").focus();
    });
    // $(".third-category>.third-modal .secondModal .next").click(function(){
    //     $(".third-category>.third-modal .subcategories").addClass("column-active");
    //     $(".third-category>.third-modal .models").removeClass("column-active");
    //     $(".third-category>.third-modal .models").css("display","none");
    //     $(".third-modal-categories").css("display","block");
    //     $(".third-category>.third-modal .secondModal").css("display","none");
    //     $(".third-category>.third-modal").css("display","none");
    //     // for(var i = 0; i<thirdModels.length;i++){
    //     //     if(i>0){
    //     //         thirdModelText+=",";
    //     //     }
    //     //     thirdModelText+=thirdModels[i];
    //     // }
    //     $(".third-category .select").html("<span class='img'><img src="+thirdCategoryImage+"></span><span><b>"+thirdCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdSubcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdModelText+"</b></span>");
    //     $(".third-category .select .img img").attr("src",thirdCategoryImage);
    //     $(".third-category .select").css("background-color",thirdCategoryColor);
    //     $(".second-modal").css("display","block");
    //     $(".second-modal-categories").css("margin-top",($(window).height()-$(".second-modal-categories").height()-66)/2);
    //     secondCategory = "";
    //     secondSubcategory ="";
    //     secondModel = "";
    //     $(".second-modal").css("display","none");
    //     $(".second-category").css("display","flex");
    //     $(".third-category .select").removeClass("no");
    //     $(".third-category .select").removeClass("yes");
    //     $(".third-category .selected").removeClass("selected");
    // });
    // $(".third-category>.third-modal .secondModal .model").click(function(){
    //     if(thirdModels.length==3){
    //         alert("Maksimum 3 model seçə bilərsiz");
    //     }
    //     else{
    //         thirdModels.push($(this).text());
    //         $(this).addClass("checked");
    //     }
    // });
    $(".third-category .select").click(function(e){
        e.preventDefault();
        thirdCategory = "";
        thirdSubcategory ="";
        thirdModels = [];
        thirdModelText = "";
        thirdCategoryColor = "";
        thirdCategoryImage = "";
        $(".third-category>.third-modal").css("display","block");
        $(".third-modal-categories").css("margin-top",($(window).height()-$(".third-modal-categories").height()-66)/2);
        $(".third-category>.third-modal").css("display","none");
        $(".third-category").css("display","flex");
        $(".third-category>.third-modal").css("display","block");
    });
    $(".third-category>.third-modal .close").click(function(){
        thirdCategory = "";
        thirdSubcategory ="";
        thirdModels = [];
        thirdModelText = "";
        thirdCategoryColor = "";
        thirdCategoryImage = "";
        $(".third-category>.third-modal .subcategories").addClass("column-active");
        $(".third-category>.third-modal .models").removeClass("column-active");
        $(".third-category>.third-modal .models").css("display","none");
        $(".third-category>.third-modal .model .checked").removeClass(".third-category>.third-modal .model .checked");
        $(".third-modal-categories").css("display","block");
        $(".third-category>.third-modal .secondModal").css("display","none");
        $(".third-category>.third-modal").css("display","none");
        $(".third-category .selected").removeClass("selected");
    });
    $(".third-category>.third-modal .notsub").click(function(){
        $(".category>.third-modal .models").css("display","none");
        $(".third-category>.third-modal>.third-modal-categories").css("display","block");
        $(".third-category>.third-modal .secondModal").css("display","none");
        $(".third-category>.third-modal").css("display","none");
        thirdSubcategory=$(this).children(".text").text();
        $(".third-category .select").html("<span class='img'><img src="+thirdCategoryImage+"></span><span><b>"+thirdCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdSubcategory+"</b></span>");
        $(".third-category .select .img img").attr("src",thirdCategoryImage);
        $(".third-category .select").css("background-color",thirdCategoryColor);
        $(".third-category .select").removeClass("no");
        $(".third-category .select").removeClass("yes");
        $(".second-category").css("display","flex");
        $(".third-category .selected").removeClass("selected");
    });
    $(".charity").click(function(){
    if($(".category .select img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .category .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .category").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .title input").val()=="" || $(".barterFrom .title input").val().length<3 || $(".barterFrom .title input").val().length>55){
        $(".error").css("display","none");
        $(".barterFrom .title .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .title").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .phone input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .phone .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .phone").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .status select").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .status .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .status").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .city select").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .city .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .city").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .cost input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .cost .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .cost").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .desc textarea").val()=="" || $(".barterFrom .desc textarea").val().length < 20){
        $(".error").css("display","none");
        $(".barterFrom .desc .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .desc").offset().top-20
        },'slow');
    }
    else if(($(".barterFrom .photos .input-file")[0].files.length<=0 || $(".barterFrom .photos .input-file")[0].files.length>6) && $(".barterFrom .preview .but1 img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .photos .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .photos").offset().top-20
        },'slow');
    }
    else{
        $(".error").css("display","none");
        $(".buttons .active").removeClass("active");
        $(this).addClass("active");
        $(".barterTo").css("display","none");
        $(".entered-infos").css("display","block");
        $(".ad-style").removeClass("d-flex");
        $(".ad-style").addClass("d-none");
    }
    });
}
else{
    $(".charity").click(function(){
    if($(".category .select img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .category .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .category").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .title input").val()=="" || $(".barterFrom .title input").val().length<3 || $(".barterFrom .title input").val().length>55){
        $(".error").css("display","none");
        $(".barterFrom .title .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .title").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .phone input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .phone .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .phone").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .status input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .status .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .status").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .city input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .city .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .city").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .cost input").val()==""){
        $(".error").css("display","none");
        $(".barterFrom .cost .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .cost").offset().top-20
        },'slow');
    }
    else if($(".barterFrom .desc textarea").val()=="" || $(".barterFrom .desc textarea").val().length < 20){
        $(".error").css("display","none");
        $(".barterFrom .desc .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .desc").offset().top-20
        },'slow');
    }
    else if(($(".barterFrom .photos .input-file")[0].files.length<=0 || $(".barterFrom .photos .input-file")[0].files.length>6) && $(".barterFrom .preview .but1 img").length<=0){
        $(".error").css("display","none");
        $(".barterFrom .photos .error").css("display","block");
        $('html,body').animate({
            scrollTop: $(".barterFrom .photos").offset().top-20
        },'slow');
    }
    else{
        $(".error").css("display","none");
        $(".buttons .active").removeClass("active");
        $(this).addClass("active");
        $(".barterTo").css("display","none");
        $(".entered-infos").css("display","block");
        $(".ad-style").removeClass("d-flex");
        $(".ad-style").addClass("d-none");
        $(".barterForm .bf-text span b").text("Nə xeyriyyəyə verilir");
    }
    });
}

function Close(){
    $(".success-modal").html("");
}
