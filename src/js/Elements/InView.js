import inView from 'in-view'

/**
 * InView
 */
class InView {

  constructor() {
    this.init();
  }

  init() {
    // console.log('InView!!!');

    let x =
    new inView('.main-banner.banner-animate')
      .on('enter', el => {
        el.classList.add("animate")
      })
      .on('exit', el => {
         el.classList.remove("animate")
      });

     new inView('.single-image-left.banner-animate')
      .on('enter', el => {
        el.classList.add("animate")
      })
      .on('exit', el => {
         el.classList.remove("animate")
      });

      new inView('.single-image-right.banner-animate')
       .on('enter', el => {
         el.classList.add("animate")
       })
       .on('exit', el => {
          el.classList.remove("animate")
       });

      new inView('.fade-in-up')
      .on('enter', el => {
        el.classList.add("animated")
      })
  }
}

export default InView;
