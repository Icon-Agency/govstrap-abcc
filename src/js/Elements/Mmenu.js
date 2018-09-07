import mmenu from 'jquery.mmenu'

/**
 * Mmenu
 */
export default class Mmenu {

  constructor() {
    this.attach();
  }

  attach() {
    // console.log('Mmenu!!!');

    $("#menu").mmenu({
      "extensions": [
        "pagedim-black",
        "position-right"
      ]
    });
  }
}
