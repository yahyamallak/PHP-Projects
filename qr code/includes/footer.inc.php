</div>









<script>

    document.addEventListener("click", e => {

        if (e.target.matches('[data-dropdown-button]')) {
            toggleDropdownMenu(e);
       } else {
            closeAllOtherDropdownMenus(e);
        }

    })


    function toggleDropdownMenu(e) {

        const dropDown = e.target.closest('[data-dropdown]');

           if(dropDown) {
              dropDown.classList.toggle("active");
              closeAllOtherDropdownMenus(e);
           }
    }


    function closeAllOtherDropdownMenus(e) {

        const dropdowns = document.querySelectorAll("[data-dropdown].dropdown");

        dropdowns.forEach(dropdown => {

            if(dropdown !== e.target.closest('[data-dropdown]') && dropdown.classList.contains('active')) {
                dropdown.classList.remove("active");
            }

        })
    }



</script>
</body>
</html>
