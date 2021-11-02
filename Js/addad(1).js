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
var categoryColors = {ca49:"rgba(255,197,0,.2)", ca55:"rgba(161,116,213,.2)", ca28:"rgba(255,112,61,.2)", ca22:"rgba(0,201,198,.2)", ca73:"rgba(67,149,255,.2)", ca16:"rgba(234,47,52,.2)", ca1:"rgba(123,204,253,.2)", ca66:"rgba(0,229,81,.2)", ca62:"rgba(67,149,255,.2)", ca97:"rgba(243,165,0,.2)",ca40:"rgba(243,165,0,.2)"};
var categoryImages= {ca49:"Images/neqliyyat.png", ca55:"Images/dasinmaz.png", ca28:"Images/elektronika.png", ca22:"Images/ev ve bag.png", ca73:"Images/xidmetler.png", ca16:"Images/sexsi esyalar.png", ca1:"Images/usaq.png", ca66:"Images/heyvanlar.png", ca62:"Images/is ve biznes.png", ca97:"Images/magazalar.png",ca40:"Images/hobby.png"};
function SelectMobile(el){
    $(el).parent().children(".select-mobile").children(".text").children(".mx-auto").html($(el).parent().children("p.col-md-3").children("b").text().replace("*",""));
    $(el).parent().children(".select-mobile").css("right","0");
    $(el).parent().children(".select-mobile").css("transition-duration","1s");
}
function Back(el){
    $(el).parent().parent().parent().css("right","-100%");
    $(el).parent().parent().parent().css("transition-duration","1s");
}
function Li(el){
    $(el).parent().children("input").attr("value",$(el).attr("class"));
    $(el).parent().parent().parent().parent().children(".select").html($(el).html());
    $(el).parent().parent().parent().css("right","-100%");
    $(el).parent().parent().parent().css("transition-duration","1s");
    $(el).parent().parent().parent().parent().children(".select").css("color","#383737");
}
$(document).ready(function(){
    var selects = $("select");
    for(let i =0; i<selects.length;i++){
        if(selects[i].value!=""){
            selects[i].style.color = "#333";
        }
    }
    if($("input[name=selected_img2]").val()!="" && $("input[name=selected_img2]").val()!=null && $("input[name=selected_img2]").val()!=undefined){
        $(".second-category").css("display","flex");
    }
    if($(".barterTo .no-difference .checkbox").hasClass("checked")){
        $(".third-category").css("display","none");
        $(".second-category").css("display","none");
        $(".barterTo .no-difference").children("input").click();
    }
    if($(".barterFrom .no-difference input").prop("checked")){
        $(".cost").css("display","none");
        $(".barterFrom .no-difference .checkbox").addClass("checked");
    }
    $(".phone input").click(function(){
        if($(".phone input").val()==""){
            $(".phone input").val("+994");
        }
    })
    if($(window).width()>=768){
        $(".kind input[type=radio]").click(function(e){
            var checkedValue = $(this).val();
            if(!$(this).hasClass("checked")){
                e.preventDefault();
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
                // else if($(".barterFrom .desc textarea").val()=="" || $(".barterFrom .desc textarea").val().length < 20){
                // $(".error").css("display","none");
                // $(".barterFrom .desc .error").css("display","block");
                // $('html,body').animate({
                //     scrollTop: $(".barterFrom .desc").offset().top-20
                // },'slow');
                // }
                // else if(($(".barterFrom .photos .input-file")[0].files.length<=0 || $(".barterFrom .photos .input-file")[0].files.length>20) && $(".barterFrom .preview .but1 img").length<=0){
                // $(".error").css("display","none");
                // $(".barterFrom .photos .error").css("display","block");
                // $('html,body').animate({
                //     scrollTop: $(".barterFrom .photos").offset().top-20
                // },'slow');
                // }
                else{
                    if($(".category-details").length>0){
                        if($(".category-details .model select").val()==""){
                            $(".error").css("display","none");
                            $(".category-details .model .error").css("display","block");
                            $('html,body').animate({
                                scrollTop: $(".category-details .model").offset().top-20
                            },'slow');
                        }
                        else if($(".category-details .motor input").val()==""){
                            $(".error").css("display","none");
                            $(".category-details .motor .error").css("display","block");
                            $('html,body').animate({
                                scrollTop: $(".category-details .motor").offset().top-20
                            },'slow');
                        }
                        else if($(".category-details .kindOfFuel select").val()==""){
                            $(".error").css("display","none");
                            $(".category-details .kindOfFuel .error").css("display","block");
                            $('html,body').animate({
                                scrollTop: $(".category-details .kindOfFuel").offset().top-20
                            },'slow');
                        }
                        else if($(".category-details .speedBox select").val()==""){
                            $(".error").css("display","none");
                            $(".category-details .speedBox  .error").css("display","block");
                            $('html,body').animate({
                                scrollTop: $(".category-details .speedBox ").offset().top-20
                            },'slow');
                        }
                        else if($(".category-details .yearOfRelease input").val()==""){
                            $(".error").css("display","none");
                            $(".category-details .yearOfRelease .error").css("display","block");
                            $('html,body').animate({
                                scrollTop: $(".category-details .yearOfRelease").offset().top-20
                            },'slow');
                        }
                        else if($(".category-details .march input").val()==""){
                            $(".error").css("display","none");
                            $(".category-details .march .error").css("display","block");
                            $('html,body').animate({
                                scrollTop: $(".category-details .march").offset().top-20
                            },'slow');
                        }
                        else{
                            $(".error").css("display","none");
                            $(".buttons .active").removeClass("active");
                            $(".checked").removeClass("checked");
                            $(this).addClass("checked");
                            if(checkedValue=="barter"){
                                $(".barterTo").css("display","block");
                                $(".entered-infos").css("display","block");
                                $(".razi").css("display","flex!important");
                                $(".cost").css("display","flex!important");
                                $(".desc").css("display","flex!important");
                                $(".photos").css("display","flex!important");
                                $(".barterFrom").css("border-bottom-width",0);
                            }
                            else{
                                $(".barterTo").css("display","none");
                                $(".razi").css("display","none!important");
                                $(".cost").css("display","none!important");
                                $(".desc").css("display","none!important");
                                $(".photos").css("display","none!important");
                                $(".entered-infos").css("display","block");
                                $(".barterFrom").css("border-bottom-width",1);
                            }
                            $(".ad-style").addClass("d-flex");
                            $(".ad-style").removeClass("d-none");
                            $(this).attr("checked","checked");
                        }
                    }
                    else{
                        $(".error").css("display","none");
                        $(".buttons .active").removeClass("active");
                        $(".checked").removeClass("checked");
                        $(this).addClass("checked");
                        if(checkedValue=="barter"){
                            $(".barterTo").css("display","block");
                            $(".entered-infos").css("display","block");
                            $(".razi").css("display","flex!important");
                            $(".cost").css("display","flex!important");
                            $(".desc").css("display","flex!important");
                            $(".photos").css("display","flex!important");
                            $(".barterFrom").css("border-bottom-width",0);
                        }
                        else{
                            $(".barterTo").css("display","none");
                            $(".barterFrom").css("border-bottom-width",1);
                            $(".razi").css("display","none!important");
                            $(".cost").css("display","none!important");
                            $(".desc").css("display","none!important");
                            $(".photos").css("display","none!important");
                            $(".entered-infos").css("display","block");
                        }
                        $(".ad-style").addClass("d-flex");
                        $(".ad-style").removeClass("d-none");
                        $(this).attr("checked","checked");
                    }
                }
            }
        });
        // let count = 0;
        // $(".active").click(function(){
        //     if(count==0){
        //         $(this).click();
        //         count+=1;
        //     }
        // });
    }
    else{            
        $(".kind input[type=radio]").click(function(e){
            var checkedValue = $(this).val();
            if(!$(this).hasClass("checked")){
                e.preventDefault();
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
            // else if($(".barterFrom .desc textarea").val()=="" || $(".barterFrom .desc textarea").val().length < 20){
            //     $(".error").css("display","none");
            //     $(".barterFrom .desc .error").css("display","block");
            //     $('html,body').animate({
            //         scrollTop: $(".barterFrom .desc").offset().top-20
            //     },'slow');
            // }
            // else if(($(".barterFrom .photos .input-file")[0].files.length<=0 || $(".barterFrom .photos .input-file")[0].files.length>20) && $(".barterFrom .preview .but1 img").length<=0){
            //     $(".error").css("display","none");
            //     $(".barterFrom .photos .error").css("display","block");
            //     $('html,body').animate({
            //         scrollTop: $(".barterFrom .photos").offset().top-20
            //     },'slow');
            // }
            else{
                if($(".category-details").length>0){
                    if($(".category-details .model input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .model .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .model").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .motor input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .motor .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .motor").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .kindOfFuel input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .kindOfFuel .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .kindOfFuel").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .speedBox input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .speedBox  .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .speedBox ").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .yearOfRelease input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .yearOfRelease .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .yearOfRelease").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .march input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .march .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .march").offset().top-20
                        },'slow');
                    }
                    else{
                        $(".error").css("display","none");
                        $(".buttons .active").removeClass("active");
                        $(".checked").removeClass("checked");
                        $(this).addClass("checked");
                        if(checkedValue=="barter"){
                            $(".barterTo").css("display","block");
                            $(".entered-infos").css("display","block");
                            $(".razi").css("display","flex!important");
                            $(".cost").css("display","flex!important");
                            $(".desc").css("display","flex!important");
                            $(".photos").css("display","flex!important");
                            $(".barterFrom").css("border-bottom-width",0);
                        }
                        else{
                            $(".barterTo").css("display","none");
                            $(".razi").css("display","none!important");
                            $(".cost").css("display","none!important");
                            $(".desc").css("display","none!important");
                            $(".photos").css("display","none!important");
                            $(".entered-infos").css("display","block");
                            $(".barterFrom").css("border-bottom-width",1);
                        }
                        $(".ad-style").addClass("d-flex");
                        $(".ad-style").removeClass("d-none");
                        $(this).attr("checked","checked");
                    }
                }
                else{
                    $(".error").css("display","none");
                    $(".buttons .active").removeClass("active");
                    $(".checked").removeClass("checked");
                    $(this).addClass("checked");
                    if(checkedValue=="barter"){
                        $(".barterTo").css("display","block");
                        $(".entered-infos").css("display","block");
                        $(".razi").css("display","flex!important");
                        $(".cost").css("display","flex!important");
                        $(".desc").css("display","flex!important");
                        $(".photos").css("display","flex!important");
                        $(".barterFrom").css("border-bottom-width",0);
                    }
                    else{
                        $(".barterTo").css("display","none");
                        $(".razi").css("display","none!important");
                        $(".cost").css("display","none!important");
                        $(".desc").css("display","none!important");
                        $(".photos").css("display","none!important");
                        $(".entered-infos").css("display","block");
                        $(".barterFrom").css("border-bottom-width",1);
                    }
                    $(".ad-style").addClass("d-flex");
                    $(".ad-style").removeClass("d-none");
                    $(this).attr("checked","checked");
                }
            }
        }
        });
    }
    $(".barterTo .checkbox").click(function(){
        if($(this).hasClass("checked")){
            if($(".third-category .select span").length>0){
                $(".second-category").css("display","flex");
            }
            $(".third-category").css("display","flex");
        }
        else{
            $(".third-category").css("display","none");
            $(".second-category").css("display","none");
        }
        $(this).parent().children("input").click();
    });
    $(".checkbox").click(function(){
        if($(this).hasClass("checked")){
            $(this).removeClass("checked");
        }
        else{
            $(this).addClass("checked");
        }
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
                else if($(".entered-infos .name").length>0){
                    if($(".entered-infos .name input").val()==""){
                        $(".error").css("display","none");
                        $(".entered-infos .name .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".entered-infos .name").offset().top-20
                        },'slow');
                        isValid = false;
                    }
                    else if($(".entered-infos .email input").val()==""){
                        $(".error").css("display","none");
                        $(".entered-infos .email .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".entered-infos .email").offset().top-20
                        },'slow');
                        isValid = false;
                    }
                    else if($(".entered-infos .phone input").val()==""){
                        $(".error").css("display","none");
                        $(".entered-infos .phone .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".entered-infos .phone").offset().top-20
                        },'slow');
                        isValid = false;
                    }
                    else if($(".entered-infos .password input").val()==""){
                        $(".error").css("display","none");
                        $(".entered-infos .password .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".entered-infos .password").offset().top-20
                        },'slow');
                        isValid = false;
                    }
                    else if($(".entered-infos .re-password input").val()==""){
                        $(".error").css("display","none");
                        $(".entered-infos .re-password .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".entered-infos .re-password").offset().top-20
                        },'slow');
                        isValid = false;
                    }
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
    if($(window).width()<768){
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
                    $(".category .select").css("display","flex");
                    $(".category .select").html("<p class='img'><img src="+categoryImage+"></p><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b></span>");
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
            $(".category .select").css("display","flex");
            $(".category .select").html("<p class='img'><img src="+categoryImage+"></p><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
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
            $(".third-category .select").html("<p class='img'><img src="+categoryImage+"></p><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
            $(".third-category input[name=selected_img2]").val(categoryImage);
            $(".third-category input[name=selected_cat2]").val(category);
            $(".third-category input[name=selected_sub2]").val(subcategory);
            $(".third-category input[name=selected_subcat2]").val(model);
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
            $(".second-category .select").html("<p class='img'><img src="+categoryImage+"></p><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
            $(".second-category input[name=selected_img3]").val(categoryImage);
            $(".second-category input[name=selected_cat3]").val(category);
            $(".second-category input[name=selected_sub3]").val(subcategory);
            $(".second-category input[name=selected_subcat3]").val(model);
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
    $(mod).next().click();
    $(".category>.modal .subcategories").addClass("column-active");
    $(".category>.modal .models").removeClass("column-active");
    $(".category>.modal .models").css("display","none");
    $(".category>.modal>.modal-categories").css("display","block");
    $(".category>.modal .secondModal").css("display","none");
    $(".category>.modal").css("display","none");
    model=$(mod).html();
    $(".category .select").html("<p class='img'><img src="+categoryImage+"></p><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
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
    $(".category .select").html("<p class='img'><img src="+categoryImage+"></p><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b></span>");
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
    $(sm).next().click();
    secondModelText = $(sm).html();
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
    $(".second-category .select").html("<p class='img'><img src="+secondCategoryImage+"></p><span><b>"+secondCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondSubcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondModelText+"</b></span>");
    $(".second-category input[name=selected_img3]").val(secondCategoryImage);
    $(".second-category input[name=selected_cat3]").val(secondCategory);
    $(".second-category input[name=selected_sub3]").val(secondSubcategory);
    $(".second-category input[name=selected_subcat3]").val(secondModelText);
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
    $(".second-category .select").html("<p class='img'><img src="+secondCategoryImage+"></p><span><b>"+secondCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondSubcategory+"</b></span>");
    $(".second-category input[name=selected_img3]").val(secondCategoryImage);
    $(".second-category input[name=selected_cat3]").val(secondCategory);
    $(".second-category input[name=selected_sub3]").val(secondSubcategory);
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
    $(tm).next().click();
    thirdModelText = $(tm).html();
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
    $(".third-category .select").html("<p class='img'><img src="+thirdCategoryImage+"></p><span><b>"+thirdCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdSubcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdModelText+"</b></span>");
    $(".third-category input[name=selected_img2]").val(thirdCategoryImage);
    $(".third-category input[name=selected_cat2]").val(thirdCategory);
    $(".third-category input[name=selected_sub2]").val(thirdSubcategory);
    $(".third-category input[name=selected_subcat2]").val(thirdModelText);
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
function Select(el){
    $(el).css("color","#333333");
}
function ChangeThirdNotSub(tns,sc){
    $(".third-category>.third-modal input."+sc).click();
    $(".category>.third-modal .models").css("display","none");
    $(".third-category>.third-modal>.third-modal-categories").css("display","block");
    $(".third-category>.third-modal .secondModal").css("display","none");
    $(".third-category>.third-modal").css("display","none");
    thirdSubcategory=tns;
    $(".third-category .select").html("<p class='img'><img src="+thirdCategoryImage+"></p><span><b>"+thirdCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdSubcategory+"</b></span>");
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
        $(".category .select").html("<p class='img'><img src="+categoryImage+"></p><span><b>"+category+"</b><img src='Images/arrow-right.svg' alt=''><b>"+subcategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+model+"</b></span>");
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
        $(".second-category .select").html("<p class='img'><img src="+secondCategoryImage+"></p><span><b>"+secondCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+secondSubcategory+"</b></span>");
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
        $(".third-category .select").html("<p class='img'><img src="+thirdCategoryImage+"></p><span><b>"+thirdCategory+"</b><img src='Images/arrow-right.svg' alt=''><b>"+thirdSubcategory+"</b></span>");
        $(".third-category .select .img img").attr("src",thirdCategoryImage);
        $(".third-category .select").css("background-color",thirdCategoryColor);
        $(".third-category .select").removeClass("no");
        $(".third-category .select").removeClass("yes");
        $(".second-category").css("display","flex");
        $(".third-category .selected").removeClass("selected");
    });
    // $(".charity").click(function(){
    //     if($(".category .select img").length<=0){
    //         $(".error").css("display","none");
    //         $(".barterFrom .category .error").css("display","block");
    //         $('html,body').animate({
    //             scrollTop: $(".barterFrom .category").offset().top-20
    //         },'slow');
    //     }
    //     else if($(".barterFrom .title input").val()=="" || $(".barterFrom .title input").val().length<3 || $(".barterFrom .title input").val().length>55){
    //         $(".error").css("display","none");
    //         $(".barterFrom .title .error").css("display","block");
    //         $('html,body').animate({
    //             scrollTop: $(".barterFrom .title").offset().top-20
    //         },'slow');
    //     }
    //     else if($(".barterFrom .phone input").val()==""){
    //         $(".error").css("display","none");
    //         $(".barterFrom .phone .error").css("display","block");
    //         $('html,body').animate({
    //             scrollTop: $(".barterFrom .phone").offset().top-20
    //         },'slow');
    //     }
    //     else if($(".barterFrom .status select").val()==""){
    //         $(".error").css("display","none");
    //         $(".barterFrom .status .error").css("display","block");
    //         $('html,body').animate({
    //             scrollTop: $(".barterFrom .status").offset().top-20
    //         },'slow');
    //     }
    //     else if($(".barterFrom .city select").val()==""){
    //         $(".error").css("display","none");
    //         $(".barterFrom .city .error").css("display","block");
    //         $('html,body').animate({
    //             scrollTop: $(".barterFrom .city").offset().top-20
    //         },'slow');
    //     }
    //     else if($(".barterFrom .desc textarea").val()=="" || $(".barterFrom .desc textarea").val().length < 20){
    //         $(".error").css("display","none");
    //         $(".barterFrom .desc .error").css("display","block");
    //         $('html,body').animate({
    //             scrollTop: $(".barterFrom .desc").offset().top-20
    //         },'slow');
    //     }
    //     else if(($(".barterFrom .photos .input-file")[0].files.length<=0 || $(".barterFrom .photos .input-file")[0].files.length>6) && $(".barterFrom .preview .but1 img").length<=0){
    //         $(".error").css("display","none");
    //         $(".barterFrom .photos .error").css("display","block");
    //         $('html,body').animate({
    //             scrollTop: $(".barterFrom .photos").offset().top-20
    //         },'slow');
    //     }
    //     else{
    //         $(".error").css("display","none");
    //         $(".buttons .active").removeClass("active");
    //         $(this).addClass("active");
    //         $(".barterTo").css("display","none");
    //         $(".entered-infos").css("display","block");
    //         $(".ad-style").removeClass("d-flex");
    //         $(".ad-style").addClass("d-none");
    //     }
    // });
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
                if($(".category-details").length>0){
                    if($(".category-details .model select").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .model .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .model").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .motor input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .motor .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .motor").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .kindOfFuel select").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .kindOfFuel .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .kindOfFuel").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .speedBox select").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .speedBox  .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .speedBox ").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .yearOfRelease input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .yearOfRelease .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .yearOfRelease").offset().top-20
                        },'slow');
                    }
                    else if($(".category-details .march input").val()==""){
                        $(".error").css("display","none");
                        $(".category-details .march .error").css("display","block");
                        $('html,body').animate({
                            scrollTop: $(".category-details .march").offset().top-20
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
    }
    });
}