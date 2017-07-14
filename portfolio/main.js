$(document).ready(function(){

// Highlight the active nav item
$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});

$('body').scrollspy({target: '.navbar-fixed-top'})

// JQuery for scrolling page links
$(function() {$('body').on('click', 'a.scrollable', function(event) {
  var $anchor = $(this);
  $('html, body').stop().animate({scrollTop: $($anchor.attr('href')).offset().top},700,'easeInOutQuart');
  event.preventDefault();
  });
});

});
