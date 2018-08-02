import slick from 'slick-carousel'

/**
 * Slick
 */
class Slick {

  constructor() {
    this.init();
  }

  init() {
    // console.log('Slick!!!');

    $('.news-carousel').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 6000,
      dots: true,
      prevArrow: '<button type="button" class="slick-prev"><i class="fal fa-arrow-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fal fa-arrow-right"></i></button>'
    })
  }
}

export default Slick;
