//All Imports
// import Homepage from './Layout/Homepage';
import Mmenu from './Elements/Mmenu';
import InView from './Elements/InView';
import ShowPopup from './Elements/Search';
import Slick from './Elements/Slick';
import Magnific from './Elements/Magnific';
import Wizard from './Elements/Wizard';

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
        var animationDuration = 220;

        var hash = window.location.hash.substr(1);
        if (hash == 'wizard-form') {
          $("#wizard-form-launch").click();
        }

        // Initilise tooltips
        $('[data-toggle="tooltip"]').tooltip({html: true})

        // Toggle Google translate widget
        $(".translate").click(function(e){
          $(".translate-container").toggle(500);
          $(".translate-indicator").toggle(500);
        });

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

          // Explore the site (footer) behaviour
          $("#footer-explore-menu-toggle").click(function (e) {
              e.preventDefault();
              $("#block-menu-block-3").slideToggle(animationDuration);
              $(this).toggleClass("explore-open");
          });

      })

      if ($('body').hasClass('has-banner')) {
        //Only avalaible on home page
      }


// Wizards
//
      if ($('body').hasClass('has-wizard-button')) {
        new Magnific()
        var wizard = new Wizard

        $('.eligibility-wizard-launch').on('click', function(){
          wizard.init('/' + Drupal.settings.pathToTheme + '/data/proofOfEligibility.json');
        })

        $('.sub-contractor-wizard-launch').on('click', function(){
          wizard.init('/' + Drupal.settings.pathToTheme + '/data/subContractor.json');
        })

      }

      if ($('body').hasClass('has-form-wizard')) {
        new Magnific()
      }

      // Agreement clauses for contractors
      $('.view-abcc-agreement-clauses .abcc-views-exposed-form .text-right.search-options #edit-items-per-page').on('change', function(){
        $('.view-abcc-agreement-clauses .abcc-views-exposed-form input#edit-submit-abcc-agreement-clauses').trigger('click');
      });
    }
  };
})(jQuery, Drupal);