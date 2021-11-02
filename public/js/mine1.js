

var offs =$(".main").offset().top


 $(window).scroll(function(){
       
     var scroll=$(window).scrollTop()
     if(scroll>offs)
         {
             $(".fixed-bar").css("opacity","1")
             
         }
     else
                      $(".fixed-bar").css("opacity","0")

     
})





$(".last-sec").click
(
    function()
    {
        $(".whatsappme__box").show(0,function(){
            $(".last-sec").hide()
        })
        
    }
)



$(".ay7aga").click
(
    function()
    {
        $(".whatsappme__box").hide(0,function(){
            $(".last-sec").show()
        })
        
    }
)



$(function(){

  $("select").bsMultiSelect();

});
  
    




