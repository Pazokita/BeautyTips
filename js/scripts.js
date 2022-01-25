jQuery(document).ready(function($){
    
    // make menu responsive
    $('#menu-main-menu').slicknav({
        //repositionner le site-header
        //appendTo : '.site-header'
    });
    
    // Run the bxSlider library on testimonials
    $('.testimonials-list').bxSlider({
        controls: false, 
        mode: 'fade'
    });
    window.onscroll = () => {
        const scroll = window.scrollY;
        
        fixedMenu(scroll);
    }
    
    // When the page is ready add the fixed menu if position is greater than 300px
     const headerScroll = document.querySelector('.navigation-bar');
     const rect = headerScroll.getBoundingClientRect();
     const topDistance = Math.abs(rect.top);
     fixedMenu(topDistance);
 

    // Adds a fixed menu on top
    function fixedMenu(scroll) {
        const headerScroll = document.querySelector('.navigation-bar');
    
        // In the case that the scroll is greater than 300 add some classes
        if(scroll > 300) {
            headerScroll.classList.add('fixed-top');
        } else {
            headerScroll.classList.remove('fixed-top');
        }
    }
    
});
