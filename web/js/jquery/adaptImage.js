$(document).ready(function() {

    //Adapt image
    $(".imgLiquidFill").imgLiquid();

    //Slide
    $("#Glide").glide({
      type: 'slider',
      centered: true,
      startAt: 1
   });

   //Open description
   $(".js-description-more").each(function(){
     var parent = $(this),
     button = $(this),
     chaine = $(this).text(),
     LgtChaine = $.trim(chaine).length,
     shortText = $.trim(chaine).substring(0, 300).split(" ").slice(0, -1).join(" ") + "...";

     if (LgtChaine > 200){
      parent.empty().html('<p>'+shortText+'</p>')

       button.on('click', function(){
         if(parent.hasClass('short')){
           parent.removeClass('short');
           parent.empty().html('<p>'+chaine+'</p>');
         }else{
           parent.addClass('short');
           parent.empty().html('<p>'+shortText+'</p>');
         }
       })
     }

   });

});
