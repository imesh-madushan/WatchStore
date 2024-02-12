// This scripts only run after the document is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.getElementById('nav');
    var btnDropdown = document.getElementById('btnDropdown');
    var navDropdown = document.getElementById('navDropdown');
    var btnDropdownClicked = false;
    var navDropdownOpened = false;
    
    btnDropdown.onclick = function()
    {   
        btnDropdownClicked = true;

        // If dropdown bar is not shown mode or hide mode, dropdown bar will be shown
        if(navDropdown.classList.contains('show') == false && navDropdown.classList.contains('hide') == false)
        {
            navDropdown.classList.add('show');
            navDropdownOpened = true;
        }
        // If dropdown bar is shown mode, replace it with hide mode
        else if(navDropdown.classList.contains('show') == true)
        {
            navDropdown.classList.replace('show', 'hide');
            navDropdownOpened = false;
        }
        //if dropdown bar is hide mode, replace it with show mode
        else if(navDropdown.classList.contains('hide') == true)
        {
            navDropdown.classList.replace('hide', 'show');
            navDropdownOpened = true;
        }
    }
    
    // When window resize, dropDown bar will be removed if enabled when width < 950
    window.addEventListener('resize', function(){
        // If window width is greater than 950
        if(window.innerWidth >= 950)
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
});