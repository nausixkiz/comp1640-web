// require('jquery-ui');
// require('twitter-bootstrap-wizard');
require('twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js');
require('twitter-bootstrap-wizard/prettify.js');

// Active tab pane on nav link

var triggerTabList = [].slice.call(document.querySelectorAll('.twitter-bs-wizard-nav .nav-link'));

triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)

    triggerEl.addEventListener('click', function (event) {
        event.preventDefault()
        tabTrigger.show()
    })
})
