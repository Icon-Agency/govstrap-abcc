/**
 * Example Homepage module
 */
class Homepage {

    constructor() {

        // For executing page specifc code
        if ($('body').hasClass('home')) {
            this.init()

        }
    }

    init() {
        console.log("Home page loaded");
    }
}

export default Homepage;
