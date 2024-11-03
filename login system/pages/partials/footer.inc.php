

<script>

    document.addEventListener("click", e => {

        if(e.target.matches('[data-popup-form-button]')) {
            openPopupForm();
        } else if(e.target.matches('[data-popup-form-close]')) {
            closePopupForm();
        } else if(!e.target.closest('[data-popup-form]')) {
            closePopupForm();
        }
    });

    function openPopupForm() {
        document.querySelector("[data-popup-form].popup-form").classList.add("active");
        document.getElementById("overlay").classList.add("show");
    }

    function closePopupForm() {
        document.querySelector("[data-popup-form].popup-form").classList.remove("active");
        document.getElementById("overlay").classList.remove("show");
    }


</script>

</body>
</html>
