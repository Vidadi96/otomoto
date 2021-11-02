$(document).ready(function(){
    $(".endDate .text span").click(function(){
        $(this).parent().parent().css("display","none");
    });
    $(".myad").hover(function(){
        $(this).children(".endDate").css("display","block");
    },function(){
        $(this).children(".endDate").css("display","none");
    });
})