import smoothscroll from 'smoothscroll-polyfill';

/**
 * Wizard2
 */
function Wizard () {
  let globalData = null, introData = '', pathway = [], currentParent = null, previousOption = null
  /**
   * initilise the wizard
   *
   */
  this.init = (source) => {
    this.thePurge()
    this.clearDisplayedQuestions()
    this.clearIntroText()

    $.get(source, (node) => {
      globalData = node.nodes.content
      introData = node.nodes.intro
      this.setIntroText()
    })
  }

  /**
   * purge all data / questions
   *
   */
  this.thePurge = () => {
    globalData = null
    introData = ''
    pathway = []
    currentParent = null
    previousOption = null
  }

  /**
   * get intro text
   *
   */
  this.setIntroText = () => {
    let intro = document.querySelector('.wizard-intro')
    intro.querySelector('h2').innerHTML = introData[0].title
    intro.querySelector('.intro-text').innerHTML = introData[0].content
    this.setup()
  }

  /**
   * clear intro text
   *
   */
  this.clearIntroText = () => {
    let intro = document.querySelector('.wizard-intro')
    intro.querySelector('h2').innerHTML = ''
    intro.querySelector('.intro-text').innerHTML = ''
  }

  /**
   * start the wizard
   *
   */
  this.setup = () => {
    let startQuestion = globalData[0]
    this.showQuestion(startQuestion)
  }

  /**
   * set the question to the page
   *
   */
  this.showQuestion = (question) => {
    let tpl = this.getQuestionTpl()
    let optionTpl = this.getOptionsTpl()

    if(question.value) {
      tpl.querySelector('h5').style.display = "block"
      tpl.querySelector('h5').innerHTML = question.value
    }
    tpl.classList.add(question.type)

    if(question.infoText) {
      tpl.querySelector('.info').style.display = "block"
      tpl.querySelector('.info').innerHTML = question.infoText
    }
    if(question.preOptionText) {
      tpl.querySelector('.pre-text').style.display = "block"
      tpl.querySelector('.pre-text').innerHTML = question.preOptionText
    }

    for(let index in question.options) {
      let option = optionTpl.cloneNode(true)
      let data = question.options[index]

      // form data
      option.querySelector('span').innerHTML = data.label

      // data items
      option.setAttribute('data-id', data.id)
      option.setAttribute('data-parent', question.id)
      option.setAttribute('data-goto', data.goTo)

      tpl.querySelector('.question-options').appendChild(option)

      if(data.checked) {
        option.querySelector('.icon').classList.add('active')
      }

      this.setEventListener(option)
    }

    document.querySelector('.question-wrap').appendChild(tpl)

  }

  /**
   * add an event listener to a question option
   *
   */
  this.setEventListener = function (option) {
    option.addEventListener('click', (event) => {
      // remove active classes on all options in this question set
      let states = Array.from(option.parentElement.querySelectorAll('.icon'))

      for(let i in states) {
        states[i].classList.remove('active')
      }

      this.nextQuestion(option)

      option.querySelector('.icon').classList.add('active')
    })
  }

  /**
   * the template markup for an option
   *
   */
  this.getOptionsTpl = () => {
    let tpl = document.querySelector('.option-tpl').cloneNode(true)

    tpl.classList.remove('option-tpl')

    return tpl
  }

  /**
   * get the template markup for a question
   *
   */
  this.getQuestionTpl = () => {
    let tpl = document.querySelector('.item-tpl').cloneNode(true)

    tpl.classList.remove('item-tpl')

    return tpl
  }

  /**
   * show the next question
   *
   */
  this.nextQuestion = (option) => {
    let thisQuestion = globalData.filter(question => question.id === parseInt(option.getAttribute('data-parent')))[0]
    let nextQuestion = globalData.filter(question => question.id === parseInt(option.getAttribute('data-goto')))[0]

    // set the selected option as active
    thisQuestion = this.resetActiveStates(thisQuestion, option)

    // if the question we are now interacting with a is a previously
    // answered one then we need to reduce the pathway and re-display only
    // those questions up to the point where the user has now answered
    if(this.isPreviousQuestion(thisQuestion)) {
      return this.showPathway(thisQuestion, nextQuestion)
    }

    // if the question has already been asked then re-show the path way
    // and present the next question below it
    if(this.pathwayExists(thisQuestion) && this.hasPreviousSteps() && nextQuestion.type === 'question') {
      return this.showPathway(thisQuestion, nextQuestion)
    }

    // is the user just swapping their chosen option in the
    // same question set
    if(this.isSameOptionGroup(option)) {
      return this.changeSelectedOption(nextQuestion)
    }

    previousOption = option

    // add the question to the pathway list the user has
    // taken to get to where they are now
    this.addPath(thisQuestion)

    // present the question on screen
    this.showQuestion(nextQuestion)

    this.focusLastQuestion()
  }

  /**
   * deactivate all current active states on all question options
   * and set the one the user just interacted with as active
   *
   */
  this.focusLastQuestion = () => {
    var elmnt = document.querySelector('.question:last-child');
    elmnt.scrollIntoView({
      block: "start",
      behavior: "smooth"
    });
  }

  /**
   * deactivate all current active states on all question options
   * and set the one the user just interacted with as active
   *
   */
  this.resetActiveStates = (question, option) => {
    for(let i in question.options) {
      question.options[i].checked = false

      if(question.options[i].id == option.getAttribute('data-id')) {
        question.options[i].checked = true
      }
    }

    return question
  }

  /**
   * clear any previously set option active states
   *
   */
  this.clearActiveStates = (question) => {
    for(let i in question.options) {
      question.options[i].checked = false
    }

    return question
  }

  /**
   * is the question one that has been asked previously
   *
   */
  this.isPreviousQuestion = (question) => {
    return pathway.findIndex(item => item.id === question.id) > -1
  }

  /**
   * is the currently selected option from the same option
   * group as that which selected previously
   *
   */
  this.isSameOptionGroup = (option) => {
    return previousOption && option.getAttribute('data-parent') === previousOption.getAttribute('data-parent')
  }

  /**
   * add a select path to the list
   *
   */
  this.addPath = (el) => {
    currentParent = el
    pathway.push(el)
  }

  /**
   * check to see if a selected question has already been
   * previously chosen
   *
   */
  this.pathwayExists = (el) => {
    return pathway.filter(path => path.id === el.id).length > 0
  }

  /**
   * the user has gone back up the question tree. We now need
   * to work out where they are and present only those questions
   * up to the one they most recently clicked on.
   *
   */
  this.showPathway = (question, nextQuestion) => {
    let index = pathway.indexOf(question)
    let newPathway = []

    // work out where to chop the pathway up
    // by keeping all questions that have an
    // on page index of less than or equal to
    // the currently selected question
    for(let i in pathway) {
      if(i <= index) {
        newPathway.push(pathway[i])
      }
    }

    this.clearDisplayedQuestions()
    this.clearPathway()

    // display the new question pathway
    for(let i in newPathway) {
      this.showQuestion(newPathway[i])
    }

    this.showQuestion(this.clearActiveStates(nextQuestion))

    pathway = newPathway
  }

  /**
   * are there previous questions to present
   *
   */
  this.hasPreviousSteps = () => {
    return pathway.length > 1
  }

  /**
   * completely clear out the previously chosen pathway
   *
   */
  this.clearPathway = () => {
    pathway = []
  }

  /**
   * clear out all previously presented questions
   *
   */
  this.clearDisplayedQuestions = () => {
    let questions = Array.from(document.querySelectorAll('.question-wrap .question'))

    for(let i in questions) {
      document.querySelector('.question-wrap').removeChild(questions[i])
    }
  }

  /**
   * the user changed an option in the same group
   *
   */
  this.changeSelectedOption = (next) => {
    let els = document.querySelectorAll('.question-wrap .question')

    // work out which item to remove
    let el = els[els.length -1]

    // remove it
    el.remove()

    // ...and show the new question content
    this.showQuestion(next)
  }
}

module.exports = Wizard
