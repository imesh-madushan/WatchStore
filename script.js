// This scripts only run after the document is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.getElementById('nav');
    var btnDropdown = document.getElementById('btnDropdown');
    var navDropdown = document.getElementById('navDropdown');
    var isDropdownClicked = false;

    btnDropdown.onclick = function(){
        isDropdownClicked = true;
        navDropdown.classList.toggle('show');
    }
    
    // When window resize, dropDown bar will be removed if enabled when width < 950
    window.addEventListener('resize', function(){
        if(window.innerWidth >= 950)
        {
            navDropdown.classList.remove('show');
        }
        else
        {
            if(isDropdownClicked == true)
            {
                navDropdown.classList.toggle('show');
            }
        }
    });
});