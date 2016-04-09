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
   $(".js-description-more").on('click',function(){
     $(".js-description-hide").removeClass('hide');
   })

});
