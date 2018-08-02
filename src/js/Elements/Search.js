/**
 * SearchPopup
 */
class SearchPopup {

  constructor() {
    this.init();
  }

  init() {
    // console.log('SearchPopup!!!');
    //


    const searchBtn = $('#search-btn');
    const searchCloseBtn = $('#close-btn');
    const searchPopup = $('#mob-search-popup');

    $(searchBtn).on('click', function(){
      $(searchPopup).fadeIn();
      $('body').css('overflow', 'hidden');
    });

     $(searchCloseBtn).on('click', function(){
      $(searchPopup).fadeOut();
      $('body').css('overflow', 'auto');
    });

  }
}

export default SearchPopup;
