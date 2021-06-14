const ready = (callback) => {
    if (document.readyState != "loading") {
        callback();
    } else {
        document.addEventListener("DOMContentLoaded", callback);
    }
}

// DOM Loaded
ready(() => { 

    /* DOM elements ------------------------------------------------------------ */
    const headerElement = document.querySelector('#header');
    const responsiveMenuElement = document.querySelector('#responsive-menu');
    const navigationTriggerElement = document.querySelector('#navigation-trigger');
    const menuOverlayElement = document.querySelector('.menu__overlay');
    const navigationCloseElements = document.querySelectorAll('.menu__overlay, #close-navigation');
    
    /* Events Functions --------------------------------------------------------- */
    const windowScrollEvent = function(e) {
        let distance =  window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        if(distance >= 200 && headerElement) {
            headerElement.classList.add('sticky');
        } else {
            headerElement.classList.remove('sticky');
        }

        if(distance >= 10 && headerElement) {
            headerElement.classList.add('admin-sticky');
        } else {
            headerElement.classList.remove('admin-sticky');
        }
    }
    
    const triggerMenuEvent = function(e) {
        e.preventDefault();
        document.body.classList.toggle('menu-displayed');
    }

    const closeMenuEvent = function(e) {
        document.body.classList.remove('menu-displayed');
    }
    
    if(navigationCloseElements) {
        navigationCloseElements.forEach(nodeElement => {
            console.log(nodeElement);
            nodeElement.addEventListener('click', closeMenuEvent);
        });
    }

    /* Events Listeners --------------------------------------------------------- */
    // Header class
    window.addEventListener('scroll', windowScrollEvent);
    windowScrollEvent();

    // Menu Responsive
    if(navigationTriggerElement && responsiveMenuElement) { 
        navigationTriggerElement.addEventListener('click', triggerMenuEvent);
    }

    
});