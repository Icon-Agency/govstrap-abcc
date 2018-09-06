//All Imports
// import Homepage from './Layout/Homepage';
import Mmenu from './Elements/Mmenu';
import InView from './Elements/InView';
import ShowPopup from './Elements/Search';
import Slick from './Elements/Slick';
import Magnific from './Elements/Magnific';
import Wizard from './Elements/Wizard';

// new Homepage();
new Mmenu();
new InView();
new ShowPopup();
new Slick();

(function ($, Drupal) {
  'use strict';
  Drupal.behaviors.govstrap = {
    attach: function (context, settings) {

      // Smooth scropping to top
      $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
          $("#to-top").fadeIn();
        } else {
          $("#to-top").fadeOut();
        }
      });
      $("#to-top").click(function () {
        $("body,html").animate({scrollTop: 0}, 500);
      });

      $(document).ready(function () {

        // Fix glossary menu on scroll
        var toggleAffix = function (affixElement, wrapper, scrollElement) {
          var height = affixElement.outerHeight(),
            top = wrapper.offset().top,
            footer = $('.footer').offset().top,
            footerHeight = $('.footer').outerHeight(),
            screenNoFooter = $(document).height() - footerHeight,
            visibleFooter = scrollElement.scrollTop() >= screenNoFooter;

          if (scrollElement.scrollTop() >= top) {
            wrapper.height(height);
            affixElement.addClass("affix");

            if (scrollElement.scrollTop() >= footer - height) {
              // if(scrollElement.scrollTop() >= screenNoFooter){

              // }

              // affixElement.removeClass("affix");
              // wrapper.height('auto');
            }
          }
          else {
            affixElement.removeClass("affix");
            wrapper.height('auto');
          }

          // console.log('position',scrollElement.scrollTop());
          // console.log('footer',footer);
          // console.log('height', height)
          // console.log('visibleFooter', visibleFooter)
        };

        $('[data-toggle="affix"] .inner').each(function () {
          var ele = $(this),
            wrapper = $('<div></div>');

          ele.before(wrapper);
          $(window).on('scroll resize', function () {
            toggleAffix(ele, wrapper, $(this));
          });

          // init
          toggleAffix(ele, wrapper, $(window));
        });

        // Smooth scroll anchor links
        $('.anchorLink').bind('click', function (event) {
          var offset = $('[data-toggle="affix"] .inner').outerHeight();
          var $anchor = $(this);

          $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - offset
          }, 1500, 'easeInOutExpo');
          event.preventDefault();
        });


        // mega menu
        $(window).resize(function () {
          if ($(window).width() >= 980) {

            // when you hover a toggle show its dropdown menu
            $(".navbar .dropdown-toggle").hover(function () {
              $(this).parent().toggleClass("show");
              $(this).parent().find(".dropdown-menu").toggleClass("show");
            });

            // hide the menu when the mouse leaves the dropdown
            $(".navbar .dropdown-menu").mouseleave(function () {
              $(this).removeClass("show");
            });

            // do something here
          }
        });
      })

      if ($('body').hasClass('has-banner')) {
        //Only avalaible on home page
      }


      if ($('body').hasClass('has-eligibility-wizard')) {
        new Magnific()

        var wizard = new Wizard
        wizard.init('/' + Drupal.settings.pathToTheme + '/data/proofOfEligibility.json')
      }

      if ($('body').hasClass('has-sub-contractor-wizard')) {
        new Magnific()

        var wizard = new Wizard
        wizard.init('/' + Drupal.settings.pathToTheme + '/data/subContractor.json')
      }

      if ($('body').hasClass('has-anonymous-report-wizard')) {
        new Magnific()

        var wizard = new Wizard
        wizard.init('/' + Drupal.settings.pathToTheme + '/data/anonymousReport.json')
      }


    }
  };
})(jQuery, Drupal);