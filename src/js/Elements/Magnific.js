import magnificPopup from 'magnific-popup'

/**
 * Magnific
 */
class Magnific {

  constructor() {
    this.init()
  }

  init() {
    //Magnific popup
    $('.open-popup').magnificPopup({
      type: 'inline',
      preloader: false,
      focus: '#name',

      // When elemened is focused, some mobile browsers in some cases zoom in
      // It looks not nice, so we disable it:
      callbacks: {
        beforeOpen: function() {
          if($(window).width() < 700) {
            this.st.focus = false
          } else {
            this.st.focus = '#name'
          }

          //Which size popup to open based on class name on a tag
          var popupClass = $(this.st.el).attr("class")
          //var popupClass = $(this.st.el).data("popup-size")
          //console.log('Callback called: ' + popupClass)
          if (popupClass.toLowerCase().indexOf("md-popup") >= 0){
            this.st.mainClass += "md-popup"
          }
          else if (popupClass.toLowerCase().indexOf("sm-popup") >= 0){
            this.st.mainClass += "sm-popup"
          }
          else if (popupClass.toLowerCase().indexOf("xl-popup") >= 0){
            this.st.mainClass += "xl-popup"
          }
          else{
            this.st.mainClass += "lg-popup"
          }
        }
      }
    })

    $('.mfp-close').click(function() {
        $.magnificPopup.close()
    })
  }
}

export default Magnific
