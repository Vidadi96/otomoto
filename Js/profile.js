$(document).ready(function(){
    $(".photo img").click(function(){
        $(".add-photo").click();
    });
    $("select").change(function(){
        $(this).css("color","#333333");
    });
    if($(window).width()<768){
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
})