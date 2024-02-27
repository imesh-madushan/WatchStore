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
   
    var about = document.getElementById('about');
    var ratings = document.getElementById('ratings');
    var services = document.getElementById('services');
    var contact = document.getElementById('contact');


    var btnDropdownClicked = false;
    var navDropdownOpened = false;

    checkIfLogged();


// ---------------CHECK IF LOGGED----------------
    // Check if user is logged
    function checkIfLogged(){
        $.ajax({
            url: '../login/get-login.php',
            method: 'POST',
            data: {
                functionName: 'checkCookies'
            },
            dataType: 'json',
            success: function(response){
                if(response.status == "success"){
                    console.log("User is logged");
                    afterCookiesLogged();
                }
                else{
                    console.log("User is not logged");
                }
            },
            error: function(error){
                console.error(error);
            }
        });
    }

    function afterCookiesLogged(){
        var navEnd = document.getElementById('navEnd');
        var navMidOptUl = document.getElementById('navMidOptions');
        var profilePic = document.getElementById('navProfileArea');

        // Creating cart navbar option
        var cartLink = document.createElement('a'); 
        var cartli = document.createElement('li');
        cartLink.href = "shopping/Cart.php";
        cartLink.textContent = "Cart";
        cartli.appendChild(cartLink);
        navMidOptUl.insertBefore(cartli, navMidOptUl.childNodes[2]); // Insert cart link to the navbar
        navMidOptUl.style.gridTemplateColumns = "repeat(6, 17%)";

        navEnd.removeChild(document.getElementById('link-btnLogin'));  // Remove login button
        navEnd.removeChild(document.getElementById('link-btnRegister')); // Remove register button

        profilePic.style.display = 'grid';

        // adding created cart option for navDropdown
        var navDropdownUl = document.getElementById('navDropdownUl');
        navDropdownUl.insertBefore(cartli, navDropdownUl.childNodes[2]);
    }


    // When resizing the window resize navbar and dropdown menu
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

    });



    
    








    // Navigate to the About when click on the navbar
    navAbout.onclick = function(){
            var scrollAmount = about.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight*0.065;
            console.log("ScrollAmountTo About "+scrollAmount);
            scrollBy({
                top: scrollAmount,
                behavior: "smooth"
            });
    }
   
    // Navigate to the Ratings when click on the navbar
    navRatings.onclick = function(){
        var scrollAmount = ratings.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight*0.065;
        console.log("ScrollAmountTo Ratings "+scrollAmount);
        scrollBy({
            top: scrollAmount,
            behavior: "smooth"
        });
    }

    // Navigate to the Services when click on the navbar
    navServices.onclick = function(){
        var scrollAmount = services.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight*0.065;
        console.log("ScrollAmountTo About "+scrollAmount);
        scrollBy({
            top: scrollAmount,
            behavior: "smooth"
        });
    }   

    // Navigate to the Contact when click on the navbar
    navContact.onclick = function(){
        var scrollAmount = contact.getBoundingClientRect().top - nav.getBoundingClientRect().bottom - window.innerHeight*0.065;
        console.log("ScrollAmountTo About "+scrollAmount);
        scrollBy({
            top: scrollAmount,
            behavior: "smooth"
        });
    }


    
});