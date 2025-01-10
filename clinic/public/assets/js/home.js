document.addEventListener("click", function(e) {

    const target = e.target
    const popup =  target.closest('.doctor')?.querySelector('.book-doctor')
    const popups = document.querySelectorAll(".book-doctor")

    popups.forEach( popup=> {
        popup.classList.remove("show")
    })

    if(target.classList.contains('book-doctor-btn') || target.closest('.book-doctor')) {
        popup.classList.add("show")
    }
    
})


/* Load more doctors */

const doctorsSection = document.querySelector(".doctors")
let page = 2;

function loadDoctors() {

    const xhttp = new XMLHttpRequest()
    let formData = new FormData()
    formData.append("page", page)
    
    xhttp.onreadystatechange = function() {
    
        if(xhttp.readyState == 4 && xhttp.status == 200) {

            page = page + 1

            const data = JSON.parse(xhttp.responseText)
            
            data.forEach(doctor => {
                
                doctorsSection.innerHTML += `
            
                <div class="doctor">
                    <div class="title">
                        <h4>${doctor.name} -  <em>( ${doctor.specialization} )</em></h4>
                        <h5>Email : ${doctor.email}</h5>
                        <h5>Phone : ${doctor.phone}</h5>
                    </div>
                    <button class="book-doctor-btn" data-btn="${doctor.doctor_id}">Book</button>
                    <hr>
                    <div class="book-doctor book-doctor-${doctor.doctor_id}">
                        <form action="/bookDoctor" method="post">
                            <input type="hidden" value="${doctor.doctor_id}">
                            <input type="date" name="date">
                            <input type="time" name="time">
                            <button type="submit">Book</button>
                        </form>
                    </div>
                </div>
                `
            })
            
            
        }
    }
    xhttp.open("POST", "/getDoctors")
    xhttp.send(formData)
}

document.addEventListener("scroll", function(e) {

    const scroll = document.documentElement.scrollHeight - window.innerHeight;

    if(scroll == window.scrollY) {
        loadDoctors();
    }
});


/* Specializations select option */

const selectOption = document.getElementById("specializations")

selectOption.addEventListener("change", function(e) {

    const xhttp = new XMLHttpRequest()

    xhttp.onreadystatechange = function() {
    
        if(xhttp.readyState == 4 && xhttp.status == 200) {
           
            const data = JSON.parse(xhttp.responseText)
            
            doctorsSection.innerHTML = ''

            data.forEach(doctor => {
                
                doctorsSection.innerHTML += `
            
                <div class="doctor">
                    <div class="title">
                        <h4>${doctor.name} -  <em>( ${doctor.specialization} )</em></h4>
                        <h5>Email : ${doctor.email}</h5>
                        <h5>Phone : ${doctor.phone}</h5>
                    </div>
                    <button class="book-doctor-btn" data-btn="${doctor.doctor_id}">Book</button>
                    <hr>
                    <div class="book-doctor book-doctor-${doctor.doctor_id}">
                        <form action="/bookDoctor" method="post">
                            <input type="hidden" value="${doctor.doctor_id}">
                            <input type="date" name="date">
                            <input type="time" name="time">
                            <button type="submit">Book</button>
                        </form>
                    </div>
                </div>
                `
            })
        }
    }

    xhttp.open("get", "/searchDoctors?category="+e.target.value)
    xhttp.send()
})



/* Search doctors */


function searchDoctors(e) {

    const xhttp = new XMLHttpRequest()

    xhttp.onreadystatechange = function() {
    
        if(xhttp.readyState == 4 && xhttp.status == 200) {
           
            const data = JSON.parse(xhttp.responseText)
            
            doctorsSection.innerHTML = ''

            data.forEach(doctor => {
                
                doctorsSection.innerHTML += `
            
                <div class="doctor">
                    <div class="title">
                        <h4>${doctor.name} -  <em>( ${doctor.specialization} )</em></h4>
                        <h5>Email : ${doctor.email}</h5>
                        <h5>Phone : ${doctor.phone}</h5>
                    </div>
                    <button class="book-doctor-btn" data-btn="${doctor.doctor_id}">Book</button>
                    <hr>
                    <div class="book-doctor book-doctor-${doctor.doctor_id}">
                        <form action="/bookDoctor" method="post">
                            <input type="hidden" value="${doctor.doctor_id}">
                            <input type="date" name="date">
                            <input type="time" name="time">
                            <button type="submit">Book</button>
                        </form>
                    </div>
                </div>
                `
            })
        }
    }

    xhttp.open("get", "/searchDoctors?search="+e.target.value)
    xhttp.send()
}

const searchDoctorsInput = document.getElementById("search-doctors")

searchDoctorsInput.addEventListener("keyup", debounce(searchDoctors, 500))


/* Debounce */

function debounce(func, delay) {
    let timeout;

    return function (...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), delay);
    };
}