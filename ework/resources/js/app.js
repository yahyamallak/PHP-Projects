import './bootstrap';


const dropdownMenuUser = document.getElementById('dropdown-menu-user')


window.onclick = (e) => {

    if(e.target.id === 'user') {

        if(dropdownMenuUser.classList.contains("hidden")) {
            dropdownMenuUser.classList.remove("hidden");
        } else {
            dropdownMenuUser.classList.add("hidden");
        }

    } else {

        if(!dropdownMenuUser.classList.contains("hidden")) {
            dropdownMenuUser.classList.add("hidden");
        }
    }


}
