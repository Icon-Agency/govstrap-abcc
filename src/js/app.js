//All Imports
// import Homepage from './Layout/Homepage';
import Mmenu from './Elements/Mmenu';
import InView from './Elements/InView';
import ShowPopup from './Elements/Search';
import Slick from './Elements/Slick';

// new Homepage();
new Mmenu();
new InView();
new ShowPopup();
new Slick();


$(document).ready(function() {
 // executes when HTML-Document is loaded and DOM is ready

  $(".anchorLink").click(function(e){
    e.preventDefault();

    var id     = $(this).attr("href");
    var offset = $(id).offset();

    $("html, body").animate({
      scrollTop: offset.top
    }, 100);
  });

  $(".translate").click(function(e){
    $(".translate-container").toggle();
    $(".translate-indicator").toggle();
  });

  // breakpoint and up
  $(window).resize(function(){
    if ($(window).width() >= 980){

        // when you hover a toggle show its dropdown menu
        $(".navbar .dropdown-toggle").hover(function () {
           $(this).parent().toggleClass("show");
           $(this).parent().find(".dropdown-menu").toggleClass("show");
         });

          // hide the menu when the mouse leaves the dropdown
        $( ".navbar .dropdown-menu" ).mouseleave(function() {
          $(this).removeClass("show");
        });

      // do something here
    }
  });
// document ready
});

if ($('body').hasClass('has-banner')) {
    //Only avalaible on home page
}



