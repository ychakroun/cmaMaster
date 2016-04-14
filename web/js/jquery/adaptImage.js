$(document).ready(function() {

    //Bandeau alert
    $('#barre').animate({
        marginTop: "0",
    }, 500);

    $("#fermer").mousedown(function(){

      $('#barre').animate({
              marginTop: "-30px",
      }, 500);

     });

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

   //Datepicker
   $('.datepicker').datepicker();

   //flexslider
   $('.flexslider').flexslider({
     animation: "slide",
     animationLoop: true,
     controlNav: false,
     directionNav: false,
    });

   //alert
  //    $(".js-alert-popup").on('click',function(e){
  //      e.preventDefault();
  // 	    alert("Notre système de paiement est en cours d'installation. Afin de poursuivre la création de votre commande, contactez l'équipe CMA à l'adresse : contact@custommyart.com");
  //  });

});
