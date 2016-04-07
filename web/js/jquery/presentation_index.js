$(document).ready(function() {
  $('.js-presentation-index li').each(function(){
    $('.js-presentation-index li:first').addClass('green');
    $(this).on('click', function(){
      var classLink = $(this).data('link'),
          selectLink = $('.'+classLink),
          selectAll= $('.js-all');
      selectAll.addClass('hide');
      selectLink.toggleClass('hide');
      $(this).siblings().removeClass('green');
      $(this).addClass('green');
    });
  })

})
