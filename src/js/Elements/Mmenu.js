import mmenu from 'jquery.mmenu'

/**
 * Mmenu
 */
class Mmenu {

  constructor() {
    this.init();
  }

  init() {
    // console.log('Mmenu!!!');

    $("#menu").mmenu({
      "extensions": [
        "pagedim-black",
        "position-right"
      ]
    });
  }
}

export default Mmenu;
