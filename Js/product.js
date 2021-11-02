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
if($(window).width()<768){
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
$(document).ready(function(){
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
    var adtop = 0;
    var adOffsetTop = $(".side-ed-container").offset().top;
    var adBottom = $("footer").offset().top - 670;
    if($(window).width()>=768){
        if($(window).scrollTop()>=adOffsetTop && $(window).scrollTop()<=adBottom){
            // adtop=$(window).scrollTop() - adOffsetTop;
            // $(".side-ed-container .long").css("margin-top",adtop);
            $(".side-ed-container").css("position","fixed");
            $(".side-ed-container").css("top","-1rem");
        }
        else if($(window).scrollTop()<adOffsetTop){
            // $(".side-ed-container .long").css("margin-top",0);
            $(".side-ed-container").css("position","static");
            $(".side-ed-container").css("top","-1rem");
        }
        else if($(window).scrollTop()>adBottom){
            // adtop=adBottom - adOffsetTop;
            // $(".side-ed-container .long").css("margin-top",adtop);
            $(".side-ed-container").css("position","fixed");
            $(".side-ed-container").css("top",(adBottom-$(window).scrollTop()-5)+"px");
        }
        $(window).scroll(function(){
            if($(window).scrollTop()>=adOffsetTop && $(window).scrollTop()<=adBottom){
                // adtop=$(window).scrollTop() - adOffsetTop;
                // $(".side-ed-container .long").css("margin-top",adtop);
                $(".side-ed-container").css("position","fixed");
                $(".side-ed-container").css("top","-1rem");
            }
            else if($(window).scrollTop()<adOffsetTop){
                // $(".side-ed-container .long").css("margin-top",0);
                $(".side-ed-container").css("position","static");
                $(".side-ed-container").css("top","-1rem");
            }
            else if($(window).scrollTop()>adBottom){
                $(".side-ed-container").css("position","fixed");
                $(".side-ed-container").css("top",(adBottom-$(window).scrollTop()-5)+"px");
            }
        });
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
        $(".modal-backdrop").remove();
        $(".barter-login").removeClass("show");
        $(".barter-login").removeAttr("style");
        $(".barter-login").css("display","none");
        $(".barter-login").removeAttr("aria-modal");
        $(".barter-login").attr("aria-hidden","true");
        $(".modal-open").removeAttr("style");
        $(".modal-open").removeClass("modal-open");
    });
    $(".mfp-close").click(function(){
        $("product-container .left .modal").css("opacity","1");
        $("product-container .left .modal").css("z-index","1051");
        $("product-container .left .modal").css("display","none");
    });
    $(".product-images .image-container").click(function(){
        $("product-container .left .modal").css("display","block");
        $("product-container .left .modal").css("opacity","0");
        $("product-container .left .modal").css("z-index","-1");
        $(".login-container").css("z-index","1040");
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
    });
    $(".vip").click(function(){
        $(".myModal1").css("display","block");
    });
    $(".premium").click(function(){
        $(".myModal2").css("display","block");
    });
    $(".vip-premium a").click(function(e){
        e.preventDefault();
    })
    $("#myModal .btn-secondary").click(function(){
        $("#myModal").css("display","none");
    })
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
