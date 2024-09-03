// This scripts only run after the document is fully loaded
document.addEventListener("DOMContentLoaded", function () {
    var navbar = document.getElementById('nav');
    var body = document.getElementById('body');
    var btnDropdown = document.getElementById('btnDropdown');
    var navDropdown = document.getElementById('navDropdown');
    var navHome = document.getElementById('navHome');

    var navAbout = Array.from(document.getElementsByClassName('navAbout'));
    var navRatings = Array.from(document.getElementsByClassName('navRatings'));
    var navServices = Array.from(document.getElementsByClassName('navServices'));
    var navContact = Array.from(document.getElementsByClassName('navContact'));

    // var navRatings = document.getElementById('navRatings');
    // var navServices = document.getElementById('navServices');
    // var navContact = document.getElementById('navContact');

    var mainContainer = document.getElementById('main-container');
    var prodContainer = document.getElementById('products-container');
    var leftBar = document.getElementById('left-bar');
    var catList = document.getElementById('c-list');
    var priceList = document.getElementById('p-list');

    var footer = document.getElementById('footer');
    var promoVideo = document.getElementById('promo-video');
    var coursel = document.getElementById('coursel');
    var cards = document.getElementsByClassName('card');
    var btnFeedbackPrev = document.getElementById('feedback-prev');
    var btnFeedbackNext = document.getElementById('feedback-next');

    var about = document.getElementById('about');
    var ratings = document.getElementById('ratings');
    var services = document.getElementById('services');
    var contact = document.getElementById('contact');


    var btnDropdownClicked = false;
    var navDropdownOpened = false;

    checkIfLogged();


    // ---------------CHECK IF LOGGED----------------
    // Check if user is logged
    function checkIfLogged() {
        $.ajax({
            url: 'login/get-login.php',
            method: 'POST',
            data: {
                functionName: 'checkCookies'
            },
            dataType: 'json',
            success: function (response) {
                if (response.status == "success") {
                    console.log("User is logged");
                    afterCookiesLogged();

                }
                else {
                    console.log("User is not logged");
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function afterCookiesLogged() {
        var navEnd = document.getElementById('navEnd');
        var navMidOptUl = document.getElementById('navMidOptions');
        var profilePic = document.getElementById('navProfileArea');

        // Creating cart navbar option
        var cartLink = document.createElement('a');
        var cartli = document.createElement('li');
        cartLink.href = "shopping/Cart.php";
        cartLink.style.cursor = "pointer";
        cartLink.textContent = "Cart";
        cartli.appendChild(cartLink);
        navMidOptUl.insertBefore(cartli, navMidOptUl.childNodes[2]); // Insert cart link to the navbar
        navMidOptUl.style.gridTemplateColumns = "repeat(6, 17%)";

        navEnd.removeChild(document.getElementById('link-btnLogin'));  // Remove login button
        navEnd.removeChild(document.getElementById('link-btnRegister')); // Remove register button

        profilePic.style.display = 'grid';

        // adding cart option for navDropdown
        var navDropdownUl = document.getElementById('navDropdownUl');
        var navDrpcrtli = cartli.cloneNode(true);
        navDropdownUl.insertBefore(navDrpcrtli, navDropdownUl.childNodes[2]);
    }





    // When resizing the window resize navbar and dropdown menu
    window.addEventListener('resize', function () {
        // If window width is greater than 950 or less than 660, dropdown bar will be hidden
        if (window.innerWidth >= 1080 || window.innerWidth < 660) {
            // If dropdown-menu was opened, it will be hidden temporarily
            if (navDropdownOpened == true) {
                navDropdown.classList.replace('show', 'hide');
            }
        }
        else {
            // If dropdown-menu was opened, it will be shown again
            if (navDropdownOpened == true) {
                navDropdown.classList.replace('hide', 'show');
            }
        }
    });



    // When scrolling the window, 
    // Promo video will stop at top,
    // Left bar will be fixed at the top,
    window.addEventListener('scroll', function () {
        var navBottom = nav.getBoundingClientRect().bottom;
        var footerTop = footer.getBoundingClientRect().top;
        var footerBottom = footer.getBoundingClientRect().bottom;

        // footerTop = leftBar.getBoundingClientRect.bottom + 0.1*window.innerHeight;
        // Set the left bar to be scrolled
        if (footerTop <= window.innerHeight) {
            leftBar.style.position = 'absolute';
            leftBar.style.alignSelf = 'flex-end';
            leftBar.style.marginBottom = "24px";
        }
        else {
            // leftBar.style.bottom = 0;
            leftBar.style.position = 'fixed';
            leftBar.style.alignSelf = 'normal';
        }

        // IF footer top goes up by crossing the navbar bottom, the promo video will be fixed at the bottom of the navbar
        if (navBottom >= footerTop) {
            promoVideo.style.position = 'fixed';
            promoVideo.style.top = navBottom + "px";
        }
        else // Reset the position of the promo video
        {
            promoVideo.style.position = 'absolute';
            promoVideo.style.top = "auto";
        }
    });




    // when click on prev and next button, the slider will be moved
    function slider() {
        // Set the scroller to the beginning
        coursel.scrollLeft = 0;

        // Slider effect for feddback section
        var courselWidth = coursel.getBoundingClientRect().width;
        var scrollAmount = parseFloat(courselWidth);
        btnFeedbackNext.onclick = function () {
            console.log("clicked next button");
            coursel.scrollLeft += scrollAmount;
        }
        btnFeedbackPrev.onclick = function () {
            console.log("clicked prev button");
            coursel.scrollLeft -= scrollAmount;
        }

    }
    slider();
    window.addEventListener('resize', slider);
    window.addEventListener('load', slider);


    // Navigate to the About when click on the navbar
    navAbout.forEach(navAbt => {
        navAbt.onclick = function () {
            var scrollAmount = about.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight * 0.065;
            console.log("ScrollAmountTo About " + scrollAmount);
            scrollBy({
                top: scrollAmount,
                behavior: "smooth"
            });
        }
    });


    // Navigate to the Ratings when click on the navbar
    navRatings.forEach(navRat => {
        navRat.onclick = function () {
            var scrollAmount = ratings.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight * 0.065;
            console.log("ScrollAmountTo Ratings " + scrollAmount);
            scrollBy({
                top: scrollAmount,
                behavior: "smooth"
            });
        }
    });


    // Navigate to the Services when click on the navbar
    navServices.forEach(navServ => {
        navServ.onclick = function () {
            var scrollAmount = services.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight * 0.065;
            console.log("ScrollAmountTo About " + scrollAmount);
            scrollBy({
                top: scrollAmount,
                behavior: "smooth"
            });
        }
    });


    // Navigate to the Contact when click on the navbar
    navContact.forEach(navContact => {
        navContact.onclick = function () {
            var scrollAmount = contact.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight * 0.065;
            console.log("ScrollAmountTo About " + scrollAmount);
            scrollBy({
                top: scrollAmount,
                behavior: "smooth"
            });
        }
    });





    // ---------------MOBILE VIEW Started---------------- *not tested nearly
    // Hide the left bar FOR MOBILE VIEW
    function hideLeftBar() {
        if (window.innerWidth <= 400) {
            leftBar.style.display = 'none';
            prodContainer.style.marginLeft = "-100px";
        }
    }
    function showLeftBar() {
        if (window.innerWidth <= 400) {
            leftBar.style.display = 'grid';
            prodContainer.style.marginLeft = "-8%";
        }
    }



    // Event listener to listen every click
    document.addEventListener('click', function (event) {
        var clickedElement = event.target;

        // If the clicked button is not the dropdown button
        if (clickedElement != btnDropdown) {
            if (navDropdown.classList.contains('show') == true) {
                showLeftBar();
                navDropdown.classList.replace('show', 'hide');
                navDropdownOpened = false;
            }
        }
        else {
            btnDropdownClicked = true;

            // If dropdown bar is not shown mode or hide mode, dropdown bar will be shown
            if (navDropdown.classList.contains('show') == false && navDropdown.classList.contains('hide') == false) {
                hideLeftBar();
                navDropdown.classList.add('show');
                navDropdownOpened = true;
            }

            else if (navDropdown.classList.contains('show') == true) // If dropdown bar is shown mode, replace it with hide mode
            {
                showLeftBar();
                navDropdown.classList.replace('show', 'hide');
                navDropdownOpened = false;
            }

            else if (navDropdown.classList.contains('hide') == true) //if dropdown bar is hide mode, replace it with show mode
            {
                hideLeftBar();
                navDropdown.classList.replace('hide', 'show');
                navDropdownOpened = true;
            }
        }
    });

    // ---------------MOBILE VIEW Ended----------------


});