// This scripts only run after the document is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.getElementById('nav');
    var body = document.getElementById('body');
    var btnDropdown = document.getElementById('btnDropdown');
    var navDropdown = document.getElementById('navDropdown');
    var navHome = document.getElementById('navHome');
    var navAbout = document.getElementById('navAbout');
    var navRatings = document.getElementById('navRatings');
    var navServices = document.getElementById('navServices');
    var navContact = document.getElementById('navContact');
    var mainContainer = document.getElementById('main-container');
    var prodContainer = document.getElementById('products-container');
    var leftBar = document.getElementById('left-bar');
    var catList = document.getElementById('c-list');
    var priceList = document.getElementById('p-list');

    var footer = document.getElementById('footer');
    var coursel = document.getElementById('coursel');
    var cards = document.getElementsByClassName('card');
    var btnFeedbackPrev = document.getElementById('feedback-prev');
    var btnFeedbackNext = document.getElementById('feedback-next');
   
    var btnDropdownClicked = false;
    var navDropdownOpened = false;

    function hideLeftBar(){
        if(window.innerWidth <= 400)
        {
            leftBar.style.display = 'none';
            prodContainer.style.marginLeft = "-100px";
        }
    }
    function showLeftBar(){
        if(window.innerWidth <= 400)
        {
            leftBar.style.display = 'grid';
            prodContainer.style.marginLeft = "-8%";
        }
    }
    // Event listener to listen every click
    document.addEventListener('click', function(event) {
        var clickedElement = event.target;
        
        // If the clicked button is not the dropdown button
        if(clickedElement != btnDropdown)
        {
            if(navDropdown.classList.contains('show') == true)
            {
                showLeftBar();
                navDropdown.classList.replace('show', 'hide');
                navDropdownOpened = false;
            }
        }
        else
        {          
            btnDropdownClicked = true;

            // If dropdown bar is not shown mode or hide mode, dropdown bar will be shown
            if(navDropdown.classList.contains('show') == false && navDropdown.classList.contains('hide') == false)
            {
                hideLeftBar();
                navDropdown.classList.add('show');
                navDropdownOpened = true;
            }
            // If dropdown bar is shown mode, replace it with hide mode
            else if(navDropdown.classList.contains('show') == true)
            {
                showLeftBar();
                navDropdown.classList.replace('show', 'hide');
                navDropdownOpened = false;
            }
            //if dropdown bar is hide mode, replace it with show mode
            else if(navDropdown.classList.contains('hide') == true)
            {
                hideLeftBar();
                navDropdown.classList.replace('hide', 'show');
                navDropdownOpened = true;
            }
        }
    });

    // When resizing the window
    window.addEventListener('resize', function(){
        // If window width is greater than 950 or less than 660, dropdown bar will be hidden
        if(window.innerWidth >= 1080 || window.innerWidth < 660)
        {
            // If dropdown-menu was opened, it will be hidden temporarily
            if(navDropdownOpened == true)
            {
                navDropdown.classList.replace('show', 'hide');
            }
        }
        else
        {
            // If dropdown-menu was opened, it will be shown again
            if(navDropdownOpened == true)
            {
                navDropdown.classList.replace('hide', 'show');
            }
        }

        // Get the current viewport of item1 and item2
        var rect1 = document.getElementById('item1').getBoundingClientRect();
        var rect2 = document.getElementById('item2').getBoundingClientRect();
        var distance = rect1.right - rect2.left;
        var plusDistance = distance - 40;
        var alltext = document.getElementsByClassName('text');

        // If the distance between right of item1 and left of item2 is greater than 70 and less than 90, the padding-right of item-text will be increased
        if(rect1.right - rect2.left > 40 && rect1.right - rect2.left < 90)
        {
            for(var all = 0; all < alltext.length; all++)
            {
                alltext[all].style.paddingRight = plusDistance + "px";
            }
        }
        else
        {
            for(var all = 0; all < alltext.length; all++)
            {
                alltext[all].style.paddingRight = "10px";
            }
        }
    });

    // When scrolling the window, the left bar will be fixed
    window.addEventListener('scroll', function(){
        if (footer.getBoundingClientRect().top <= window.innerHeight)
        {
            leftBar.style.position = 'absolute';
            leftBar.style.alignSelf = 'flex-end'; 
        }
        else
        {
            leftBar.style.alignSelf = 'revert';
            leftBar.style.position = 'fixed';
        }
    });
    
    function slider()
    {
        // Set the scroller to the beginning
        coursel.scrollLeft = 0;

        // Slider effect for feddback section
        var courselWidth = coursel.getBoundingClientRect().width;
        var scrollAmount = parseFloat(courselWidth);
        btnFeedbackNext.onclick = function(){
            console.log("clicked next");
            coursel.scrollLeft += scrollAmount; 
        }
        btnFeedbackPrev.onclick = function(){
            coursel.scrollLeft -= scrollAmount;        
        }

    }
    slider();
    window.addEventListener('resize', slider);
    window.addEventListener('load', slider);

    
});