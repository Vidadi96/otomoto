$(document).ready(function(){
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
        // $(function(){
        //     $(".scrollBox2").scrollBar({
        //         position:"x,y",
        //     });
        // });
    let height = 0;
    setInterval(function(){
        $('#load_barti_chat').load("chatfetch.php").fadeIn("slow");
        if(height!=$(".scrollBox2 .contentBox").height()){
            // $(".scrollBox2").scrollTop(document.querySelector(".scrollBox2").scrollHeight);
            height = $(".scrollBox2 .contentBox").height();
            // $('.scrollBox2').animate({ scrollTop: $('.scrollBox2').prop('scrollHeight')}, 1000);
            $(".scrollBox2 .zl-scrollContentDiv").css("top",-$(".scrollBox2 .contentBox").height()+300);
            $(".scrollBox2 .zl-verticalBar").css("top",300-$(".scrollBox2 .zl-verticalBar").height());
        }
    }, 1000);
    if($(window).width()<768){
        $(".back").click(function(){
            $(".left-side").css("display","block");
            $(".right-side").css("display","none");
        });
    }
})