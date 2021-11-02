if($(window).width()>=768){
    $(".left .user-details-container .user-details .user-detail .user-rating img").hover(function(){
        if(!$(this).hasClass("notHover")){
            var id = parseInt($(this).attr("id").replace("img",""));
            for(let i=1;i<=id;i++){
                $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).get(0).src="/Images/filled-star.svg";
            }
            for(let i = id+1;i<6;i++){
                $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).get(0).src="/Images/empty-star.svg";
            }
        }
    },
    function(){
        if(!$(this).parent().hasClass("clicked") && !$(this).hasClass("notHover")){
            for(let i=1;i<=5;i++){
                $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).get(0).src="/Images/empty-star.svg";
            }
        }
    });
}
$(".left .user-details-container .user-details .user-detail .user-rating img").click(function(){
    var id = parseInt($(this).attr("id").replace("img",""));
    $(this).parent().addClass("clicked");
    for(let i=1;i<6;i++){
        if(i<=id){
            var src = $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).attr("src");
            $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).attr("src","/Images/filled-star.svg");
            // src = $(".right-side .user-details .user-detail .user-rating #img" + i+".img").attr("src");
            $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).get(0).classList.add("notHover");
        }
        else{
            $(this).addClass("clicked");
            $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).attr("src","/Images/empty-star.svg");
            $(".left .user-details-container .user-details .user-detail .user-rating #img" + i).get(0).classList.add("notHover");
        }
    }
});
